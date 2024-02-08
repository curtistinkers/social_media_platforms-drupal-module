<?php

declare(strict_types = 1);

namespace Drupal\Tests\social_media_platforms\Kernel;

use Drupal\Core\Template\Attribute;
use Drupal\KernelTests\KernelTestBase;

/**
 * Test description.
 *
 * @group social_media_platforms
 */
final class SocialMediaPlatformsBlockTest extends KernelTestBase {

  /**
   * The renderer.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * The path resolver.
   *
   * @var \Drupal\Core\Extension\ExtensionPathResolver
   */
  protected $pathResolver;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'system',
    'user',
    'social_media_platforms',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->container->get('theme_installer')->install(['stark']);
    $this->container->get('cache.render')->deleteAll();
    $this->renderer = $this->container->get('renderer');
    $this->pathResolver = $this->container->get('extension.path.resolver');
  }

  /**
   * Helper function to get the links attribute value.
   *
   * @return array
   *   The links values array.
   */
  protected function getLinksValue(): array {

    $links = [];

    $path = $this->pathResolver->getPath('module', 'social_media_platforms');

    $links['youtube'] = [
      'link_url' => 'https://www.youtube.com',
      'title' => 'Youtube',
      'image_url' => "/$path/images/youtube.png",
      'attributes' => new Attribute(),
    ];

    return $links;

  }

  /**
   * Test the social_media_platforms_links theme with empty variables.
   */
  public function testEmptyLinksTheme(): void {

    $content = [
      '#theme' => 'social_media_platforms_links',
    ];

    $output = $this->renderer->renderRoot($content);
    $this->setRawContent($output);
    $this->assertText('');
  }

  /**
   * Tests the social_media_platforms_links theme with icon and no title.
   */
  public function testLinksIconsNoLabel(): void {

    $links = $this->getLinksValue();

    $content = [
      '#theme' => 'social_media_platforms_links',
      '#links' => $links,
      '#show_icon' => TRUE,
      '#show_label' => FALSE,
    ];

    $output = $this->renderer->renderRoot($content);
    $this->setRawContent($output);
    $this->assertText('');
    $this->assertLinkByHref($links['youtube']['link_url']);
    $img = $this->cssSelect('a.social-media-platforms__link--youtube > img');
    $this->assertCount(1, $img);
  }

  /**
   * Tests the theme with label and no icon.
   */
  public function testLinksLabelNoIcon(): void {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  /**
   * Tests the theme with label and icon.
   */
  public function testLinksLabelAndIcon(): void {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  /**
   * Tests the theme target blank for the links.
   */
  public function testLinksTargetBlankLabel(): void {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  /**
   * Tests adding global attributes to the theme container.
   */
  public function testLinksGlobalAttributes(): void {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

  /**
   * Tests adding link attributes to the individual links.
   */
  public function testLinksAttributes(): void {
    $this->markTestIncomplete(
      'This test has not been implemented yet.'
    );
  }

}
