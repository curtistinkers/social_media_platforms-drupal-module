<?php

namespace Drupal\social_media_platforms\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Extension\ExtensionPathResolver;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Template\Attribute;
use Drupal\Core\Theme\ThemeManager;
use Drupal\social_media_platforms\Form\SettingsForm;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Social Media Links block.
 *
 * @Block(
 *   id = "social_media_platform_block",
 *   admin_label = @Translation("Social Media Platform Links"),
 *   category = @Translation("Social Media Platforms"),
 * )
 */
final class SocialMediaBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs a Drupalist object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Theme\ThemeManager $themeManager
   *   The theme manager.
   * @param \Drupal\Core\Extension\ExtensionPathResolver $pathResolver
   *   The path resolver.
   * @param \Drupal\Core\Config\ConfigFactory $config
   *   The config factory.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    protected ThemeManager $themeManager,
    protected ExtensionPathResolver $pathResolver,
    protected ConfigFactory $config
  ) {
    parent::__construct($configuration,
    $plugin_id,
    $plugin_definition,
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new self(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('theme.manager'),
      $container->get('extension.path.resolver'),
      $container->get('config.factory'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->config->get('social_media_platforms.settings')->get();
    $tags = $this->config->get('social_media_platforms.settings')->getCacheTags();
    $output = [];
    $links = [];
    $path = $this->pathResolver->getPath('module', 'social_media_platforms');

    $configLinks = array_intersect_key($config, SettingsForm::SOCIAL_PLATFORMS);

    foreach ($configLinks as $key => $value) {
      $imagePath = '/' . $path . '/images/' . $key . '.png';
      $links[$key] = [
        'link_url' => $value,
        'image_url' => $imagePath,
        'attributes' => new Attribute(),
        'title' => SettingsForm::SOCIAL_PLATFORMS[$key],
      ];
    }

    $this->themeManager->alter('social_media_platforms', $links);

    $output['links'] = [
      '#attributes' => new Attribute(),
      '#theme' => 'social_media_platforms_links',
      '#links' => $links,
      '#show_icon' => $config['show_icon'] ?? FALSE,
      '#show_label' => $config['show_label'] ?? FALSE,
      '#target_blank' => $config['target_blank'] ?? FALSE,
    ];

    $output['#cache']['tags'] = $tags;
    return $output;
  }

}
