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

use \Twig_Loader_Filesystem as Loader;
use \Twig_Environment as Environment;
use \Twig_SimpleFunction as WPFunction;

class View
{
	/**
	 * @access protected
	 */
	public static $config;
	public static $extension = '.tpl';

	/**
	 * Assign data to view
	 *
	 * @param array $data, string $view
	 * @return {inherit}
	 */
	public static function assign($data = [], $view = 'default')
	{
		echo self::render($data, $view);
	}

	/**
	 * Render view
	 *
	 * @param array $data, string $view
	 * @return mixed
	 */
	public static function render($data, $view)
	{
		static::$config = new Config;

		// Set Loader path
		$path = WP_PLUGIN_DIR . static::$config->get('path')->view;

		// Set Environment cache path
		$cache = static::$config->get('path')->cache;
		if ($cache) $cache = WP_PLUGIN_DIR . $cache;

		// Set Environment settings
		$setting = [
		    'cache' => $cache,
		    'debug' => false
		];

		$loader = new Loader($path);

		// Set View environment
		$environment = new Environment($loader, $setting);

		// Add WordPress functions
        $environment->addFunction(
        	new WPFunction('settings_fields', function ($group){
            	settings_fields($group);
        	}
    	));
        $environment->addFunction(
        	new WPFunction('do_settings_sections', function ($group){
            	do_settings_sections($group);
        	}
    	));
        $environment->addFunction(
        	new WPFunction('get_option', function ($name){
            	return esc_attr( get_option($name) );
        	}
        ));
        $environment->addFunction(
        	new WPFunction('submit_button', function (){
            	submit_button();
        	}
        ));
        $environment->addFunction(
        	new WPFunction('translate', function ($string){
            	return __($string,static::$config->namespace);
        	}
        ));

        // Reurn rendered view
		$view = $environment->load($view . static::$extension);
		return $view->render($data);
	}
}
