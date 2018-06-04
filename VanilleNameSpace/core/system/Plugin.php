<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system;

use \VanilleNameSpace\core\system\includes\Config;
use \VanilleNameSpace\core\system\includes\Migrate;
use \VanilleNameSpace\core\system\libraries\Wordpress;
use \VanilleNameSpace\core\system\libraries\Admin;
use \VanilleNameSpace\core\system\libraries\Menu;
use \VanilleNameSpace\core\system\libraries\Setting;
use \VanilleNameSpace\core\system\libraries\Front;
use \VanilleNameSpace\core\system\libraries\Shortcode;
use \VanilleNameSpace\core\system\libraries\interfaces\PluginInterface;

class Plugin extends Wordpress implements PluginInterface
{
	/**
	 * Plugin configuration base
	 *
	 * @access private
	 */
	private $config;

	/**
	 * Plugin object
	 *
	 * @param void
	 * @return void
	 */
	public function __construct()
	{
		// Init plugin
		$this->init();

		// Construct plugin admin and pass config throw it
		new Admin($this->config, new Menu, new Setting);

		// Construct plugin front and pass config throw it
		new Front($this->config, new Shortcode);
	}

	/**
	 * Prepare base actions
	 *
	 * @access private
	 * @param void
	 * @var object $this->config
	 * @return void
	 */
	private function init()
	{
		// Get Configuration
		$this->config = new Config();

		// Define Plugin DIR and Plugin Name : plugin/plugin
		$const = "{$this->config->namespace}/{$this->config->namespace}";

		// Define plugin main file
		$root = $this->getRoot("/{$const}.php");

		// Hook plugin activation
		$this->registerActivation($root, [$this,'activate']);

		// Hook plugin deactivation
		$this->registerDeactivation($root, [$this,'deactivate']);

		// Hook plugin uninstall : using class name instead of $this
		$this->registerUninstall($root, ['Plugin','uninstall']);

		// Hook plugin translation
		$this->addAction( 'plugins_loaded', [$this,'translate'] );

		// Hook plugin add links
		$this->addFilter( "plugin_action_links_{$const}.php", [$this,'addLink'] );
	}

	/**
	 * Start plugin by returning new plugin object
	 *
	 * @access public
	 * @param void
	 * @return object Plugin
	 */
	public static function start()
	{
		return new self;
	}

	/**
	 * Plugin activation method
	 *
	 * @access public
	 * @param void
	 * @var object $this->config
	 * @return void
	 */
	public function activate()
	{
		// Create Plugin tables
		# Migrate::table();

		// Create new role
		$this->addRole('manager','Manager',['read' => true]);

		// Apply role
		$this->addCapability( 'administrator', "manage_{$this->config->namespace}" );
		$this->addCapability( 'manager', "manage_{$this->config->namespace}" );
	}

	/**
	 * Plugin deactivation method
	 *
	 * @access public
	 * @param void
	 * @var object $this->config
	 * @return void
	 */
	public function deactivate()
	{
		// Remove role from users
		$this->removeCapability( 'administrator', "manage_{$this->config->namespace}" );
		$this->removeCapability( 'manager', "manage_{$this->config->namespace}" );
	}

	/**
	 * Plugin uninstall method
	 *
	 * @access public
	 * @param void
	 * @return void
	 */
	public static function uninstall()
	{
		// Remove plugin tables
		# Migrate::rollback();
		
		// Remove plugin role
		self::removeRole('manager');
	}

	/**
	 * Add plugin links
	 *
	 * @access public
	 * @param array $links
	 * @var object $this->config
	 * @return string
	 */
	public function addLink($links)
	{
    	$push = '<a href="admin.php?page='. $this->config->namespace .'">' . __( 'Settings' ) . '</a>';
    	array_push( $links, $push );
  		return $links;
	}
}
