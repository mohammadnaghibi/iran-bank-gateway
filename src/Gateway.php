<?php

namespace mohammadnaghibi\Gateway;

use Illuminate\Support\Facades\Facade;

/**
 * @see \mohammadnaghibi\Gateway\GatewayResolver
 */
class Gateway extends Facade
{
	/**
	 * The name of the binding in the IoC container.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'gateway';
	}
}
