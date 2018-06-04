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

class Json extends File
{
	/**
	 * @param inherit
	 * @return object File
	 */
	public function __construct($path = null, $mode = 'r')
	{
		parent::__construct($path,$mode);
		$this->read();
	}

	/**
	 * @param boolean $object
	 * @return array|object
	 */
	public function parse($object = false)
	{
		if($object) return json_decode($this->content, false);
		else return json_decode($this->content, true);
	}

	/**
	 * format json to be valid into wordpress
	 * using htmlspecialchars
	 *
	 * @param mixen $data
	 * @return json
	 *
	 * pip : JSON_PRETTY_PRINT
	 */
	public static function format($data, $type = null)
	{
		if ($type == 'html')
		return htmlspecialchars(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
		else
		return json_encode($data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
	}
}
