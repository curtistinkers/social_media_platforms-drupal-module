<?php declare(strict_types = 1);

namespace Drupal\Tests\social_media_platforms\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test description.
 *
 * @group social_media_platforms
 */
final class SocialMediaPlatformsTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'claro';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'social_media_platforms',
    'node',
    'media',
    'block',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $admin_user = $this->drupalCreateUser([
     'administer site configuration',
     'access content',
     'access administration pages',
    ]);
    $this->drupalLogin($admin_user);
    $this->drupalGet('admin');
    $this->drupalPlaceBlock('social_media_platform_block');
    // Set up the test here.
  }

  /**
   * Test callback.
   */
  public function testLinksOrder(): void {

    $this->drupalGet('/admin/config/system/social-media-platforms');
    $this->assertSession()->pageTextContains('Social Media Platforms');
    $page = $this->getSession()->getPage();

    $page->checkField('edit-show-label');
    $page->fillField('edit-table-facebook-url', 'https://facebook.com/SimonElectricES/');
    $page->selectFieldOption('edit-table-facebook-weight', '10');
    $page->fillField('edit-table-youtube-url', 'https://www.youtube.com/');
    $page->selectFieldOption('edit-table-youtube-weight', '-10');

    $page->pressButton('edit-submit');

    $this->drupalGet('<front>');
    $assert_session = $this->assertSession();
    $assert_session->elementsCount('css', '.social-media-platforms__link', 2);
    $links = $page->findAll('css', 'a.social-media-platforms__link');
    $this->assertEquals('Youtube', $links[0]->getText());
    $this->assertEquals('Facebook', $links[1]->getText());

  }

  public function testEmptyConfiguration(): void {
    $this->drupalGet('<front>');
    $assert_session = $this->assertSession();
    $assert_session->elementsCount('css', '.social-media-platforms__link', 0);
    $assert_session->elementsCount('css', '.social-media-platforms__container', 1);
  }

}
