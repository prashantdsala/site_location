<?php

declare(strict_types = 1);

namespace Drupal\site_location;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatterInterface;

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
    ) {
  }

  /**
   * Get current date time based on selected timezone.
   *
   * @return array
   *   Formatted date time and city name.
   */
  public function getLocationDateTime() {
    $config = $this->configFactory->getEditable(self::SETTINGS);
    if (empty($config->get('timezone'))) {
      return [];
    }
    $timezone_city = explode('/', $config->get('timezone'));

    return [
      'datetime' => $this->dateFormatter->format(time(), static::DATE_FORMAT, static::DATE_TIME_FORMAT, $config->get('timezone')),
      'timezone_city' => (is_array($timezone_city)) ? end($timezone_city) : $config->get('timezone'),
    ];
  }

}
