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

class Dashboard extends Page
{
	/**
	 * @todo multiple widgets
	 */

	/**
	 * Template content rendering
	 *
	 * @access public
	 * @param void
	 * @var array $this->content
	 * @return string
	 */
	public function __construct()
	{
		$this->addAction( 'wp_dashboard_setup', [$this,'build'] );
	}

	/**
	 * Template content rendering
	 *
	 * @access public
	 * @param void
	 * @var array $this->content
	 * @return string
	 */
	public function build()
	{
		wp_add_dashboard_widget( 'VanilleNameSpace', __('[VanilleName] : Widget example','VanilleNameSpace'), [$this,'index']);
	}

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

			'widgetText' => __('This is a widget example','VanilleNameSpace'),
			'configBtn'  => __('Settings'),
			'configLink' => 'admin.php?page=VanilleNameSpace',
		];

		View::assign($this->content,'admin/dashboard');
	}
}
