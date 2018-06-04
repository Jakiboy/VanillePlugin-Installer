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

class Response
{
	/**
	 * @param string $state, 
	 * @return json
	 */
	public static function set($message = '', $state = 'success')
	{
		echo json_encode([
			'state'   => $state,
			'message' => $message
		]);
		die();
	}
}
