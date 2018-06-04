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

use \VanilleNameSpace\core\system\libraries\interfaces\SettingInterface;
use \VanilleNameSpace\core\system\includes\Response;
use \VanilleNameSpace\core\system\includes\Post;
use \VanilleNameSpace\core\system\includes\Get;

class Setting extends Wordpress implements SettingInterface
{
	/**
	* @todo use configuration
	*/

	/**
	 * Settings wrapper for Page
	 *
	 * @access protected
	 * @var array $content
	 */
	protected $content = [];

	/**
	 * Add plugin settings
	 *
	 * @access public
	 * @param void
	 * @return {inherit}
	 * @todo replace VanilleNameSpace
	 *
	 * Template usage : {{ settings_fields('group') }}
	 * Template usage : {{ do_settings_sections('group') }}
	 * Template usage : {{ get_option('name') }}
	 */
	public function init()
	{
		$this->addOption('VanilleNameSpace-option','VanilleNameSpace-example');
	}

	/**
	 * ajaxCallback react as Ajax Controller
	 *
	 * @access public
	 * @param void
	 * @return void
	 *
	 * use isAction to separate actions
	 * require settings_fields()
	 *
	 * action : wp_ajax_{name}, wp_ajax_nopriv_{name}
	 */
	public function ajaxCallback()
	{
		// Save action
		if ( $this->isAction('save') )
		{
			$this->updateOption('VanilleNameSpace-example', Post::get('example'));
			Response::set( __('Settings saved','VanilleNameSpace') );
		}
	}

	/**
	 * Get data from database usin Db object
	 *
	 * @access protected
	 * @param string $data, $table
	 * @var string $db->prefix
	 * @return array|string
	 */
	protected function get($table, $data = '*')
	{
		$db = new Db();
		$sql = "SELECT {$data} FROM `{$db->prefix}{$db->tablePrefix}{$table}`";
		return $db->select($sql);
	}

	/**
	 * Get settings from database usin Db object
	 *
	 * @access protected
	 * @param void
	 * @var array $this->content
	 * @return array|string
	 */
	protected function add($table, $data)
	{
		$db = new Db();
		return $db->insert($table, $data);
	}

	/**
	 * Get settings from database usin Db object
	 *
	 * @access protected
	 * @param void
	 * @var array $this->content
	 * @return array|string
	 */
	protected function remove($table, $where = [])
	{
		$db = new Db();
		$db->delete("{$db->tablePrefix}{$table}", $where);
	}

	/**
	 * Remove plugin settings
	 *
	 * @access public
	 * @param void
	 * @return void
	 */
	public function removeSettings()
	{
		parent::removeOption('VanilleNameSpace-example');
	}

	/**
	 * Check requested action
	 *
	 * @access public
	 * @param string $action
	 * @return boolean
	 */
	public function isAction($action)
	{
		if ( Post::get('nonce') == null ) return;
		if ( Post::get('action') == "VanilleNameSpace{$action}" ) return true;
	}

	/**
	 * Setting saved without JS
	 *
	 * @access protected
	 * @param void
	 * @return boolean
	 */
	protected function saved()
	{
		if ( Get::isSet('settings-updated') && Get::catch('settings-updated') == 'true' )
		{
			return true;
		}
	}
}
