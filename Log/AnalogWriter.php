<?php
/**
 * Analog Log File Writer
 *
 * Use this custom log writer to output log messages
 * to analog.
 *
 * USAGE
 *
 * $app = new \Slim\Slim(array(
 *	 'log.writer' => new \Adosaiguas\SlimAnalog\Log\AnalogWriter(
 *		\Analog\Handler\Threshold::init (
 *			\Analog\Handler\File::init ($log_path),
 *			\Analog::DEBUG
 *		)
 *	);
 *
 * SETTINGS
 *
 * You may customize this log writer by passing an Analog handler
 * into the class constructor. 
 *
 * @author Agusti Dosaiguas <agusti@dosaiguas.net>
 * @copyright 2014 Agusti Dosaiguas
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Adosaiguas\SlimAnalog\Log;

class AnalogWriter
{
	/**
	 * @var logger
	 */
	protected $logger;

	/**
	 * Converts Slim log level to Analog log level
	 * @var array
	 */
	protected $log_level = array(
		\Slim\Log::EMERGENCY => \Analog::URGENT,
		\Slim\Log::ALERT => \Analog::ALERT,
		\Slim\Log::CRITICAL => \Analog::CRITICAL,
		\Slim\Log::ERROR => \Analog::ERROR,
		\Slim\Log::WARN => \Analog::WARNING,
		\Slim\Log::NOTICE => \Analog::NOTICE,
		\Slim\Log::INFO => \Analog::INFO,
		\Slim\Log::DEBUG => \Analog::DEBUG,
	);

	/**
	 * Constructor
	 *
	 * Prepare this log writer.
	 *
	 * @param   $hanlder The Analog handler
	 * @return  void
	 */
	public function __construct($handler)
	{
		$this->logger = new \Analog\Logger();
		$this->logger->handler($handler);
	}

	/**
	 * Write to log
	 *
	 * @param   mixed $object
	 * @param   int   $level
	 * @return  void
	 */
	public function write($object, $level)
	{
		$this->logger->log(
			$this->get_log_level($level, \Analog::WARNING),
			$object
		);
	}

	/**
	 * Converts Slim log level to Analog log level
	 *
	 * @param  int $slim_log_level   Slim log level we're converting from
	 * @param  int $default_level    Analog log level to use if $slim_log_level not found
	 * @return int                   Analog log level
	 */
	protected function get_log_level( $slim_log_level, $default_analog_log_level )
	{
		return isset($this->log_level[$slim_log_level]) ?
			$this->log_level[$slim_log_level] :
			$default_analog_log_level;
	}
}
