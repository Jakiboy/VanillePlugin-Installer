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

use \VanilleNameSpace\core\system\libraries\Shortcode;
use \VanilleNameSpace\core\system\libraries\interfaces\FrontInterface;
use \VanilleNameSpace\core\system\libraries\interfaces\ConfigInterface;

class Front extends Wordpress implements FrontInterface
{
	/**
	 * @access private
	 */
	private $shortcode;
	private $config;
	private $asset;
	private $namespace;

	/**
	 * Other plugin and theme front hooks
	 * @access private
	 */
	private $pluginHook;
	private $themeHook;

	/**
	 * Construct front
	 *
	 * @param Shortcode $shortcode, ConfigInterface $config
	 * @return void
	 *
	 * Front::construct() inisialize front assets,
	 * and construct other classes
	 */
	public function __construct(ConfigInterface $config = null, Shortcode $shortcode = null)
	{
		if ( !$this->isAdmin() )
		{
			// Set shortcode object
			$this->shortcode = $shortcode;

			// Set plugins object
			$this->pluginHook = [];

			// Set theme object
			$this->themeHook = [];

			if ($config)
			{
				// Set config object
				$this->config = $config;

				// define global vars
				$this->asset = $this->config->path->asset;
				$this->namespace = $this->config->namespace;
			}

			// Construct front
			$this->init();
		}
	}

	/**
	 * {inherit}
	 *
	 * @access private
	 * @param void
	 * @return void
	 */
	private function init()
	{
		/**
		 * Remove meta generator
		 * @see initCSS@self
		 */
		$this->addAction('wp_enqueue_scripts',[$this,'initCSS']);

		/**
		 * Change author slug
		 * @see initJS@self
		 */
		$this->addAction('wp_enqueue_scripts',[$this,'initJS']);

		// initialize shortcodes
		if ($this->shortcode) $this->initShortcode();
		
		// initialize plugins hooks
		if ($this->pluginHook) $this->initPluginHook();

		// initialize theme
		if ($this->themeHook) $this->initThemeHook();
	}

	/**
	 * Add shortcodes
	 *
	 * @access private
	 * @param void
	 * @return {inherit}
	 */
	private function initShortcode()
	{
		/**
		 * Add example shortcode
		 * @see example@Shortcode
		 */
		$this->addShortcode('example',[$this->shortcode,'exampleInit']);
	}

	/**
	 * Set plugins front hooks
	 *
	 * @access private
	 * @param void
	 * @return {inherit}
	 */
	private function initPluginHook()
	{
		// ...
	}

	/**
	 * Set theme front hooks
	 *
	 * @access private
	 * @param void
	 * @return {inherit}
	 */
	private function initThemeHook()
	{
		// ...
	}

	/**
	 * Add front CSS
	 *
	 * @access public
	 * @param void
	 * @var string $this->namespace
	 * @var string $this->asset
	 * @return {inherit}
	 *
	 * action : wp_enqueue_scripts
	 */
	public function initCSS()
	{
		// Add Plugin Front CSS
		$this->addCSS("{$this->namespace}-css", "{$this->asset}/front/css/style.css");
	}

	/**
	 * Add front JS
	 *
	 * @access public
	 * @param void
	 * @var string $this->namespace
	 * @var string $this->asset
	 * @return {inherit}
	 *
	 * action : wp_enqueue_scripts
	 */
	public function initJS()
	{
		// Add Plugin JS
		$this->addJS("{$this->namespace}-css", "{$this->asset}/front/js/main.js");
	}
}
