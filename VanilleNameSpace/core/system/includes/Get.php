<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\includes;

class Get
{
	/**
	 * @param string|null $item
	 * @return array|string
	 */
	public static function catch($item = null)
	{
		if (isset($item)) return $_GET[$item];
		else return $_GET;
	}

	/**
	 * @param string|null $item
	 * @return boolean|null
	 */
	public static function isSet($item = null)
	{
		if (isset($_GET[$item])) return true;
	}
}
