# Analog Logging for Slim Framework

This repository adds support for logging to [Analog](https://github.com/jbroadway/analog/) to the [Slim Framework](http://www.slimframework.com/).

Ported from the [Slim-Monolog](https://github.com/Flynsarmy/Slim-Monolog) project.

# Installation

AnalogWriter takes a handler in its constructor.

```php
$logger = new \Adosaiguas\SlimAnalog\Log\AnalogWriter(
	\Analog\Handler\Threshold::init (
		\Analog\Handler\File::init ($log_path),
		\Analog::DEBUG
	)
);

$app = new \Slim\Slim(array(
    'log.writer' => $logger,
));
```

This example assumes you are autoloading dependencies using [Composer](http://getcomposer.org/). If you are not
using Composer, you must manually `require` the log writer class before instantiating it.

# License

The Slim-Analog is released under the MIT public license.
