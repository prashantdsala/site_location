<?php

declare(strict_types = 1);

namespace Drupal\Tests\site_location\Functional;

use Drupal\Tests\BrowserTestBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Test description.
 *
 * @group site_location
 */
final class ConfigPageTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'claro';

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['site_location', 'user'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
  }

  /**
   * Test site_location configuration page access.
   */
  public function testConfigPageAccess(): void {
    // Create a user with permission to administer site configurations.
    $this->drupalLogin($this->drupalCreateUser(['administer site configuration']));
    $this->drupalGet('admin/config/system/site-location');
    $this->assertSession()->statusCodeEquals(Response::HTTP_OK);
  }

}
