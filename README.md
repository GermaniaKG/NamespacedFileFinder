<img src="https://static.germania-kg.com/logos/ga-logo-2016-web.svgz" width="250px">

------



# Germania KG · NamespacedFileFinder


## Installation

```bash
$ composer require germania-kg/namespaced-filefinder
```



## Usage

The constructor requires a default directory to look in. An optional array with “namespaced” directories defines where to also have a look:

```php
<?php

use Germania\NamespacedFileFinder\NamespacedFileFinder;  

$finder = new NamespacedFileFinder("/path/configs", [
  "@custom" => "/path/to/custom/configs"
]);

$found = $finder("app.yaml");
$found = $finder("@custom/app.yaml");
```




## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

