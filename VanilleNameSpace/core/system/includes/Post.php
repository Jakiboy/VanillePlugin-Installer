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

class Post
{
	/**
	 * @param string|null $item
	 * @return array|string
	 */
	public static function get($item = null)
	{
		if (isset($item)) return $_POST[$item];
		else return $_POST;
	}

	/**
	 * @param string|null $item
	 * @return boolean|null
	 */
	public static function isSet($item = null)
	{
		if (isset($_POST[$item])) return true;
	}
}
