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

class Menu extends Page
{
	/**
	 * Construct plugin and include page settings
	 *
	 * @access public
	 * @param void
	 * @return {inherit}
	 */
	public function init()
	{
		$this->addMenuPage( __('Page example','VanilleNameSpace'), '[VanilleName]', 'manage_VanilleNameSpace', 'VanilleNameSpace', [$this,'index']);
	}
}
