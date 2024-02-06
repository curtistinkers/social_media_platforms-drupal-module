<?php

declare(strict_types = 1);

namespace Drupal\social_media_platforms\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Social Media Platforms settings for this site.
 */
final class SettingsForm extends ConfigFormBase {

  const SOCIAL_PLATFORMS = [
    'facebook' => 'Facebook',
    'youtube' => 'Youtube',
    'linkedin' => 'Linkedin',
    'x' => 'X',
    'instagram' => 'Instagram',
  ];

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'social_media_platforms_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['social_media_platforms.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $config = $this->config('social_media_platforms.settings');

    foreach (self::SOCIAL_PLATFORMS as $key => $social_platform) {
      $form[$key . '_url'] = [
        '#type' => 'url',
        '#title' => $social_platform,
        '#default_value' => $config->get($key),
      ];
    }

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {

    $config = $this->configFactory()->getEditable('social_media_platforms.settings');

    foreach (self::SOCIAL_PLATFORMS as $key => $social_platform) {
      $value = $form_state->getValue($key . '_url');
      $config->set($key, $value);
    }

    $config->save();

    parent::submitForm($form, $form_state);
  }

}
