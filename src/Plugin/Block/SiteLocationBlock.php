<?php

declare(strict_types = 1);

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\site_location\TimeService;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a site location block.
 *
 * @Block(
 *   id = "site_location_site_location",
 *   admin_label = @Translation("Site location"),
 *   category = @Translation("Custom"),
 * )
 */
final class SiteLocationBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'site_location.adminsettings';

  /**
   * Constructs the plugin instance.
   */
  public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        private readonly ConfigFactoryInterface $configFactory,
        private readonly TimeService $timeService,
    ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new self(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('config.factory'),
          $container->get('site_location.time'),
      );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $config = $this->configFactory->getEditable(self::SETTINGS);
    $response = $this->timeService->getLocationDateTime();
    $date = date('dS M Y - h:i A');
    $time = time();
    if (!empty($response['datetime'])) {
      $datetime = explode('-', $response['datetime']);
      $date = $datetime[0];
      $time = $datetime[1];
    }
    $build['content'] = [
      '#theme' => 'site_location_block',
      '#date' => $date,
      '#time' => $time,
      '#city' => $config->get('city'),
      '#timezone_city' => $response['timezone_city'],
      '#country' => $config->get('country'),
      '#cache' => [
        'tags' => ['config:site_location.adminsettings'],
      ],
      '#attached' => [
        'library' => ['site_location/site-location'],
      ],
    ];

    return $build;
  }

}
