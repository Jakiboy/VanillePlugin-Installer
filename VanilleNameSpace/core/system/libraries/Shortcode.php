<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\libraries;

class Shortcode
{
	/**
	 * Example shortcode
	 *
	 * @access public
	 * @param void
	 * @return string
	 */
	public function exampleInit()
	{
		return __('This is a shortcode example','VanilleNameSpace');
	}
}
