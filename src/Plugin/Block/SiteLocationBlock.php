<?php declare(strict_types = 1);

namespace Drupal\site_location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
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
   * Datetime format.
   *
   * @var string
   */
  const DATE_TIME_FORMAT = 'dS M Y - h:i A';

  /**
   * Date format.
   *
   * @var string
   */
  const DATE_FORMAT = 'custom';

  /**
   * Constructs the plugin instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    private readonly ConfigFactoryInterface $configFactory,
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
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $config = $this->configFactory->getEditable(self::SETTINGS);

    $build['content'] = [
      '#theme' => 'site_location_block',
      '#datetime' => \Drupal::service('date.formatter')->format(time(), static::DATE_FORMAT, static::DATE_TIME_FORMAT, $config->get('timezone')),
      '#cache' => [
        'tags' => ['config:site_location.adminsettings'],
      ],
    ];

    return $build;
  }

}
