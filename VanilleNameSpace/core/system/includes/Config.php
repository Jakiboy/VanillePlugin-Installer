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

use \VanilleNameSpace\core\system\libraries\interfaces\ConfigInterface;

class Config implements ConfigInterface
{
	/**
	 * @access public
	 */
	public $root = '/VanilleNameSpace';
	public $baseUri;
	public $ajaxUrl;
	public $pluginName;
	public $namespace;
	public $prefix;
	public $path;
	public $installSql;
	public $uninstallSql;

	/**
	 * @access protected
	 */
	protected $file;
	protected $global;

	/**
	 * {{inherit}}
	 *
	 * @param string|null $action
	 * @return void
	 */
	public function __construct($action = null)
	{
		self::init($action);
	}

	/**
	 * Config getter
	 *
	 * @param string|null $action
	 * @return void
	 */
	public function __get($property)
	{
		return $this->$property;
	}

	/**
	 * Config setter
	 *
	 * @param string $property, mixed $value
	 * @return void
	 */
	public function __set($property,$value)
	{
		$this->$property = $value;
		return $this;
	}

	/**
	 * get global option
	 *
	 * @param string|null $action
	 * @return void
	 */
	public function get($name)
	{
		return $this->global->$name;
	}

	/**
	 * init configuration
	 *
	 * @param string $action
	 * @return void
	 */
	private function init($action)
	{
		$this->ajaxUrl = admin_url('admin-ajax.php');
		$this->baseUri = WP_PLUGIN_URL . $this->root;
		$this->root = WP_PLUGIN_DIR . $this->root;
		$this->file = new Json("{$this->root}/core/storage/config/global.json");
		$this->global = $this->file->parse(true);
		$this->pluginName = $this->global->name;
		$this->namespace = $this->global->namespace;
		$this->prefix = $this->global->prefix;
		$this->path = $this->global->path;

		if ($action == 'install')
		{
			$this->file = new File("{$this->root}/core/storage/migrate/install.sql");
			$this->file->read();
			$this->installSql = $this->file->content;
			$this->file->close();
		}
		elseif ($action == 'uninstall')
		{
			$this->file = new File("{$this->root}/core/storage/migrate/uninstall.sql");
			$this->file->read();
			$this->uninstallSql = $this->file->content;
			$this->file->close();
		}
	}
}
