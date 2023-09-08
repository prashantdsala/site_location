## INTRODUCTION

The Site Location module is a used to display Site location and the current time for the location in a predefined format as a block.

The primary use case for this module is:

- Display Time for different timezones with city and country.

## REQUIREMENTS

1. Drupal core module config_translation.
2. Drupal core module locale.

## INSTALLATION

Install as you would normally install a contributed Drupal module.
See: https://www.drupal.org/node/895232 for further information.

## CONFIGURATION
- Go to /admin/config/system/site-location page
- Enter "Country", "City" and select timezone from the "Timezone" field.
- Save the configuration.
- Go to /admin/structure/block page
- Click on "Place block" in any of the listed theme regions.
- Search for "Site location" block in the search field.
- Place the block with your required configurations and "Save".

## MAINTAINERS

Current maintainers for Drupal 10:

- Prashan Chauhan (prashantc) - https://www.drupal.org/u/prashantc
