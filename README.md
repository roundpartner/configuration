[![Build Status](https://travis-ci.org/roundpartner/configuration.svg?branch=master)](https://travis-ci.org/roundpartner/configuration)

# Configuration
Configuration for webservices

## Post Installation

The configs folder needs to have write permissions for it to pull the configuration files.
A script is provided to allow setting the permissions automatically.

If the vendor folder is located in the current directory then the script can be run without arguments.
```bash
./bin/set_configs_permission.sh
```

If the vendor folder is located in a subdirectory then pass in the path to the directory as an argument.
```bash
./bin/set_configs_permission.sh src/
```

## Testing
```bash
phpunit
```

## Code Quality
```bash
./vendor/bin/phpcs --standard=psr2 ./src
./vendor/bin/phpcbf --standard=psr2 ./src
```
