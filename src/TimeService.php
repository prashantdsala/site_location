<?php declare(strict_types = 1);

namespace Drupal\site_location;

use Drupal\Core\Datetime\DateFormatterInterface;

/**
 * @todo Add class description.
 */
final class TimeService {

  /**
   * Constructs a TimeService object.
   */
  public function __construct(
    private readonly DateFormatterInterface $dateFormatter,
  ) {}

  /**
   * @todo Add method description.
   */
  public function doSomething(): void {
    // @todo Place your code here.
  }

}
