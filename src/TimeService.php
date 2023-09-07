<?php

declare(strict_types = 1);

namespace Drupal\site_location;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * @todo Add class description.
 */
final class TimeService {

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
   * Constructs a TimeService object.
   */
  public function __construct(
    private readonly DateFormatterInterface $dateFormatter,
    private readonly ConfigFactoryInterface $configFactory,
  ) {}

  /**
   * Get current date time based on selected timezone.
   *
   * @return string
   *   Formatted date time.
   */
  public function getLocationDateTime() {
    $config = $this->configFactory->getEditable(self::SETTINGS);
    if (empty($config->get('timezone'))) {
      return;
    }

    return $this->dateFormatter->format(time(), static::DATE_FORMAT, static::DATE_TIME_FORMAT, $config->get('timezone'));
  }

}
