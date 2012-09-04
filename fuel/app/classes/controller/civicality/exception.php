<?php

namespace Civicality\Exception;

use Fuel\Core;

abstract class Civicality_Exception extends FuelException {
/**
	 * Must return a response object for the handle method
	 *
	 * @return  Response
	 */
	abstract protected function response();

	/**
	 * When this type of exception isn't caught this method is called by
	 * Error::exception_handler() to deal with the problem.
	 */
	public function handle()
	{
		$response = $this->response();
		\Event::shutdown();
		$response->send(true);
	}
}