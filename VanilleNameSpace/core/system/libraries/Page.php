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

use \VanilleNameSpace\core\system\includes\View;

class Page extends Setting
{
	/**
	 * Template content rendering
	 *
	 * @access public
	 * @param void
	 * @var array $this->content
	 * @return string
	 */
	public function index()
	{
		// Set page content vars
		$this->content = [

			'string' => [

				'settingTab'   => __('Settings','VanilleNameSpace'),
				'settingTitle' => __('[VanilleName] Option page','VanilleNameSpace'),
				'settingDesc'  => __('Options page example','VanilleNameSpace'),
				'aboutTab'	   => __('About','VanilleNameSpace'),
				'aboutTitle'   => __('About VanillePlugin','VanilleNameSpace'),
				'saved'    	   => __('Settings saved','VanilleNameSpace'),
				'save'		   => __('Save')
			],
			'config' => [

				'saved' => $this->saved()
			]
		];
		
		// Render view
		View::assign($this->content,'admin');
	}
}
