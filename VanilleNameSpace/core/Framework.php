<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core;

final class Framework
{
	/**
	 * Register plugin autoloader,
	 * And include composer packages
	 *
	 * @param void
	 * @return object Framework
	 */
	public function __construct()
	{
		// WordPress Security Basic
		if (!defined( 'ABSPATH' )) die('forbidden');

		// Include composer packages
		include('vendor/autoload.php');
		
		// init self autoloader
		$this->register();
	}

	/**
	 * Register autoloader
	 * MUST be before any include
	 *
	 * @access protected
	 * @param void
	 * @return boolean
	 */
	protected function register()
	{
	    spl_autoload_register([__CLASS__, 'autoload']);
	}

	/**
	 * Unregister autoloader
	 *
	 * @access public
	 * @param void
	 * @return boolean
	 */
	public function unregister()
	{
		spl_autoload_unregister([__CLASS__, 'autoload']);
	}

	/**
	 * Autoloader method
	 * 
	 * @access protected
	 * @param string $class __CLASS__
	 * @return void
	 */
	protected function autoload($class)
	{
	    if (strpos($class, __NAMESPACE__ . '\\') === 0)
	    {
	        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
	        $class = str_replace('\\', '/', $class);
	        $namespace = str_replace('\\', '/', __NAMESPACE__); // Fix namespace
	        require_once(ABSPATH . 'wp-content/plugins/' . $namespace . '/' . $class . '.php');
	    }
	}

	/**
	 * @access public
	 * @param void
	 * @return {inherit}
	 */
	public static function init()
	{
		return new self;
	}
}
