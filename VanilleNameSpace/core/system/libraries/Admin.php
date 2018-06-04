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

use \VanilleNameSpace\core\system\libraries\interfaces\AdminInterface;
use \VanilleNameSpace\core\system\libraries\interfaces\ConfigInterface;

class Admin extends Wordpress implements AdminInterface
{
	/**
	 * @access private
	 */
	private $menu;
	private $setting;
	private $config;
	private $asset;
	private $namespace;

	/**
	 * Other plugin and theme admin hooks
	 * @access private
	 */
	private $pluginHook;
	private $themeHook;
	
	/**
	 * Admin object
	 *
	 * @param ConfigInterface $config, Menu $menu, Setting $setting
	 * @return void
	 *
	 * check admin to reduce charges : isAdmin()
	 */
	public function __construct(ConfigInterface $config, Menu $menu = null, Setting $setting = null)
	{
		if ( $this->isAdmin() )
		{
			// Create dashboard widget
			new Dashboard;

			// Set plugins object
			$this->pluginHook = [];

			// Set theme object
			$this->themeHook = [];

			// Set Menu and Setting objects
			$this->menu = $menu;
			$this->setting = $setting;

			// Set config object
			$this->config = $config;

			// Set short config vars
			$this->asset = $this->config->path->asset;
			$this->namespace = $this->config->namespace;

			// Construct admin
			$this->init();
		}
	}

	/**
	 * Construct admin elements
	 *
	 * @access protected
	 * @param void
	 * @return void
	 *
	 * init Settings : $this->addAction('admin_init', [$this->setting,'init']);
	 * init Menu     : $this->addAction('admin_menu', [$this->menu,'init']);
	 * ajax callback : $this->addAction('wp_ajax_{example}', [$this->setting,'ajaxCallback']);
	 * ajax callback : $this->addAction('wp_ajax_nopriv_{example}', [$this->setting,'ajaxCallback']);
	 * plugin admin  : $this->isPluginAdmin()
	 */
	protected function init()
	{
		/**
		 * Initialize Plugin settings
		 * @see init@Setting
		 */
		if ($this->setting)
		{
			$this->addAction('admin_init', [$this->setting,'init']);
		}

		/**
		 * Initialize Plugin menu (menu will build page)
		 * @see init@Menu
		 */
		if ($this->menu)
		{
			$this->addAction('admin_menu', [$this->menu,'init']);
		}

		// initialize plugins hooks
		if ($this->pluginHook) $this->initPluginHook();

		// initialize theme
		if ($this->themeHook) $this->initThemeHook();

		// Add actions on plugin admin only
		if ( $this->isPluginAdmin() )
		{
			/**
			 * Remove WordPress about and version
			 * @see copyright@self
			 */
			$this->addAction('admin_init',[$this,'copyright']);
			
			// Add admin assets
			$this->addAction('admin_enqueue_scripts', [$this,'initCSS']);
			$this->addAction('admin_enqueue_scripts', [$this,'initJS']);

			// Remove version from assets to enable cache
			$this->addFilter('style_loader_src', [$this,'cleanAssetsUrl'], 10, 2);
			$this->addFilter('script_loader_src', [$this,'cleanAssetsUrl'], 10, 2);

			// Define ajax Action & Callback
			if ($this->setting)
			{
				$this->addAction("wp_ajax_{$this->namespace}save", [$this->setting,'ajaxCallback']);
				$this->addAction("wp_ajax_nopriv_{$this->namespace}save", [$this->setting,'ajaxCallback']);
			}
		}
	}


	/**
	 * Set plugins admin hooks
	 *
	 * @access private
	 * @param void
	 * @return void
	 */
	private function initPluginHook()
	{
		// ...
	}

	/**
	 * Set theme admin hooks
	 *
	 * @access private
	 * @param void
	 * @return void
	 */
	private function initThemeHook()
	{
		// ...
	}

	/**
	 * Add admin CSS
	 *
	 * @access public
	 * @param void
	 * @return void
	 *
	 * @var sting $this->namespace
	 * @var string $this->asset
	 * @var object $this->config
	 *
	 * action : admin_enqueue_scripts
	 */
	public function initCSS()
	{
		// add vendor css
		$this->addCSS('bootstrap-css',"{$this->asset}/vendor/bootstrap/css/bootstrap.min.css");
		$this->addCSS('material-css',"{$this->asset}/vendor/material/css/material.min.css");
		$this->addCSS('icons-css',"{$this->asset}/vendor/simple-line-icons/css/simple-line-icons.css");
		$this->addCSS('font-css',"{$this->asset}/font/roboto.css");

		// add plugin css
		$this->addCSS("{$this->namespace}-css","{$this->asset}/admin/css/style.css");
	}

	/**
	 * Add admin JS
	 *
	 * @access public
	 * @param void
	 * @return void
	 *
	 * @var sting $this->namespace
	 * @var string $this->asset
	 * @var object $this->config
	 *
	 * Remove script : $this->removeJS('{ID}');
	 * Add script : $this->addJS('{ID}', '/path/to/{example}.js');
	 * Add javascript settings : $this->localizeJS('{ID}', '{vanillePlugin}', []);
	 *
	 * action : admin_enqueue_scripts
	 */
	public function initJS()
	{
		// Remove default version of jquery
		$this->removeJS('jquery');

		// Add new version of jquery (3.2.1)
		$this->addJS("{$this->namespace}-jquery", "{$this->asset}/vendor/jquery/jquery-3.2.1.min.js");

		// Add Vendor JS
		$this->addJS('bootstrap-js', "{$this->asset}/vendor/bootstrap/js/bootstrap.bundle.min.js");
		$this->addJS('material-js', "{$this->asset}/vendor/material/js/material.min.js");
		$this->addJS('sweetalert-js', "{$this->asset}/vendor/sweetalert/sweetalert.min.js");

		// Add Plugin JS
		$this->addJS("{$this->namespace}-js", "{$this->asset}/admin/js/main.js");

		// Setup Plugin Ajax & JS settings
		$this->localizeJS("{$this->namespace}-js", 'vanillePlugin',
		[
			'ajaxurl'    => $this->config->ajaxUrl,
			'pluginName' => $this->config->pluginName,
			'namespace'  => $this->config->namespace,
			'baseUri'    => $this->config->baseUri,
			'errorMsg'   => __('Error while saving configuration','VanilleNameSpace')
		]);
	}

	/**
	 * Remove WordPress : about and version
	 * in admin footer
	 *
	 * @access public
	 * @category Appearance
	 * @param void
	 * @return void
	 *
	 * action : admin_init
	 */
	public function copyright()
	{
		$this->addFilter( 'admin_footer_text', [$this,'about'], 22 );
		$this->addFilter( 'update_footer', [$this,'version'], 22 );
	}

	/**
	 * Change wordpress about text from footer
	 *
	 * @access public
	 * @category Appearance
	 * @param void
	 * @return void
	 *
	 * filter : admin_footer_text
	 * return : __return_empty_string
	 */
	public function about()
	{
		return $this->config->get('description') . $this->config->get('author');
	}

	/**
	 * Change wordpress about version from footer
	 *
	 * @access public
	 * @category Appearance
	 * @param void
	 * @return void
	 *
	 * filter : update_footer
	 * return : __return_empty_string
	 */
	public function version()
	{
		return $this->config->get('version');
	}
}
