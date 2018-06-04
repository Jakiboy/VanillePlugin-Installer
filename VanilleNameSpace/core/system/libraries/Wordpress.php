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

class Wordpress
{
	/**
	 * Register a shortcode handler.
	 *
	 * @see /reference/functions/add_shortcode/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @param string $name
	 * @param string $method
	 * @return mixed
	 */
	protected function addShortcode($name, $method)
	{
		add_shortcode($name, $method);
	}

	/**
	 * Search content for shortcodes and filter shortcodes through their hooks
	 *
	 * @see /reference/functions/do_shortcode/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @param string $tag
	 * @param boolean $ignore
	 * @return string
	 */
	protected function renderShortcode($tag)
	{
		echo do_shortcode($tag,false);
	}

	/**
	 * Search content for shortcodes and filter shortcodes through their hooks
	 *
	 * @see /reference/functions/do_shortcode/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @param string $tag
	 * @param boolean $ignore
	 * @return string
	 */
	protected function doShortcode($tag, $ignore = false)
	{
		return do_shortcode($tag, $ignore);
	}

	/**
	 * Remove hook for shortcode
	 *
	 * @see /reference/functions/remove_shortcode/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @param string $name
	 * @return void
	 */
	protected function removeShortcode($name)
	{
		remove_shortcode($name);
	}

	/**
	 * Remove hook for shortcode
	 *
	 * @see /reference/functions/remove_shortcode/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @param string $name
	 * @return void
	 * @todo shortcodeIn
	 */
	protected function shortcodeIn($tag)
	{
		// ...
	}

	/**
	 * Hook a method on a specific action
	 *
	 * @see /reference/functions/add_action/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $hook, callable $method, int $priority default 10, int $args default 1
	 * @return true
	 */
	protected function addAction($hook, $method, $priority = 10, $args = 1)
	{
		switch ($hook)
		{
			case 'head':
				add_action('wp_head', $method, $priority, $args);
				break;
			case 'footer':
				add_action('wp_footer', $method, $priority, $args);
				break;
			default:
				add_action($hook, $method, $priority, $args);
				break;
		}
	}

	/**
	 * Remove a method from a specified action hook
	 *
	 * @see /reference/functions/remove_action/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $target, callable  $method, int $priority default 10
	 * @return boolean
	 */
	protected function removeAction($target, $method, $priority = 10)
	{
		switch ($target)
		{
			case 'head':
				remove_action('wp_head', $method, $priority);
				break;
			case 'footer':
				remove_action('wp_footer', $method, $priority);
				break;
			default:
				remove_action($target, $method, $priority);
				break;
		}
	}

	/**
	 * Hook a function or method to a specific filter action
	 *
	 * @see /reference/functions/add_filter/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $hook, callable $method, int $priority default 10, int $args default 1
	 * @return true
	 */
	protected function addFilter($hook, $method, $priority = 10, $args = 1)
	{
		add_filter($hook,$method,$priority,$args);
	}

	/**
	 * Remove a function from a specified filter hook
	 *
	 * @see /reference/functions/remove_filter/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $hook, callable $method, int $priority default 10
	 * @return boolean
	 */
	protected function removeFilter($hook, $method, $priority = 10)
	{
		remove_filter($hook,$method,$priority,$args);
	}

	/**
	 * Call the functions added to a filter hook
	 *
	 * @see /reference/functions/apply_filters/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $hook, mixed $value, mixed $args
	 * @return mixed
	 */
	protected function applyFilter($hook, $value, $args = null)
	{
		apply_filters($hook,$value,$args);
	}

	/**
	 * Register and Enqueue a CSS stylesheet
	 *
	 * @see /reference/functions/wp_register_style/
	 * @see /reference/functions/wp_enqueue_style/
	 * @package WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $id, string $path, boolean $cdn, array $param, string $version
	 * @return boolean
	 */
	protected function addCSS($id, $path, $cdn = false, $param = [], $version = '', $media = 'all')
	{
		if (!$cdn) $path = plugins_url() . $path;

		wp_register_style($id, $path, $param, $version, $media);
		wp_enqueue_style($id);
	}

	/**
	 * Register and Enqueue a new script
	 *
	 * @see /reference/functions/wp_register_script/
	 * @see /reference/functions/wp_enqueue_script/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $id, string $path, boolean $cdn, array $param, string $version, boolean $footer
	 * @return void
	 */
	protected function addJS($id, $path, $cdn = false, $param = [], $version = '', $footer = true)
	{
		if (!$cdn) $path = plugins_url() . $path;

		wp_register_script($id, $path, $param, $version, $footer);
		wp_enqueue_script($id);
	}

	/**
	 * Remove a previously enqueued and registered CSS stylesheet
	 *
	 * @see /reference/functions/wp_dequeue_style/
	 * @see /reference/functions/wp_deregister_style/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $id 
	 * @return void
	 */
	protected function removeCSS($id)
	{
		wp_dequeue_style($id);
		wp_deregister_style($id);
	}

	/**
	 * Remove a previously enqueued and registered script
	 *
	 * @see /reference/functions/wp_dequeue_script/
	 * @see /reference/functions/wp_deregister_script/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $id 
	 * @return void
	 */
	protected function removeJS($id)
	{
		wp_dequeue_script($id);
		wp_deregister_script($id);
	}

	/**
	 * Localize a script
	 * Works on already added script
	 *
	 * @see /reference/functions/wp_deregister_script/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $id, string $object, array $data
	 * @return boolean
	 */
	protected function localizeJS($id, $object, $data = [])
	{
		wp_localize_script($id, $object, $data);
	}

	/**
	 * Set the activation hook for a plugin
	 *
	 * @see /reference/functions/register_activation_hook/
	 * @category WordPress Plugin
	 * @since 4.0.0
	 * @access protected
	 * @param string $file, callable $method
	 * @return void
	 */
	protected function registerActivation($file, $method)
	{
		register_activation_hook($file, $method);
	}

	/**
	 * Set the deactivation hook for a plugin
	 *
	 * @see /reference/functions/register_deactivation_hook/
	 * @category WordPress Plugin
	 * @since 4.0.0
	 * @access protected
	 * @param string $file, callable $method
	 * @return void
	 */
	protected function registerDeactivation($file, $method)
	{
		register_deactivation_hook($file, $method);
	}

	/**
	 * Set the uninstallation hook for a plugin
	 * use class name instead of $this
	 *
	 * @see /reference/functions/register_uninstall_hook/
	 * @category WordPress Plugin
	 * @since 4.0.0
	 * @access protected
	 * @param string $file, callable $method
	 * @return void
	 */
	protected function registerUninstall($file, $method)
	{
		register_uninstall_hook($file, $method);
	}

	/**
	 * Register a setting and its data
	 *
	 * @see /reference/functions/register_setting/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $group, string $name, null array $args 
	 * @param args[string $type, string $description
	 * @param callable $callback, boolean $api, mixed $default]
	 * @return void
	 */
	protected function addOption($group, $name, $args = null)
	{
		register_setting($group, $name, $args);
	}

	/**
	 * Retrieves an option value based on an option name
	 *
	 * @see /reference/functions/get_option/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $name, null string $default
	 * @return mixed
	 */
	protected function getOption($name, $default = null)
	{
		return get_option($name,$default);
	}

	/**
	 * Update the value of an option that was already added
	 *
	 * @see /reference/functions/update_option/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $name, mixed $value
	 * @return boolean
	 */
	protected function updateOption($name, $value)
	{
		return update_option($name,$value);
	}

	/**
	 * Update the value of an option that was already added
	 *
	 * @see /reference/functions/delete_option/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $name
	 * @return boolean
	 */
	protected function removeOption($name)
	{
		return delete_option($name);
	}

	/**
	 * Add a top-level menu page
	 *
	 * @see /reference/functions/add_menu_page/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $title, string $menuTitle, string $capability, string $slug, callable $method, string $icon default dashicons-warning, int $icon default 2
	 * @return string
	 */
	protected function addMenuPage($title, $menuTitle, $capability, $slug, $method, $icon = 'admin-plugins', $position = 2)
	{
		return add_menu_page($title,$menuTitle,$capability,$slug,$method,"dashicons-{$icon}",$position);
	}

	/**
	 * Add a top-level menu page
	 *
	 * @see /reference/functions/add_menu_page/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $title, string $menuTitle, string $capability, string $slug, callable $method
	 * @return string
	 */
	protected function addSubMenuPage($parent, $pageTitle, $menuTitle, $capability, $slug, $method)
	{
		return add_submenu_page( $parent, $pageTitle, $menuTitle, $capability, $slug, $method);
	}

	/**
	 * Add a top-level menu page
	 *
	 * @see /reference/functions/add_menu_page/
	 * @category WordPress Core
	 * @since 4.0.0
	 * @access protected
	 * @param string $title, string $menuTitle, string $capability, string $slug, callable $method
	 * @return string
	 */
	protected function addOptionPage($pageTitle, $menuTitle, $capability, $slug, $method)
	{
		return add_options_page($pageTitle,$menuTitle,$capability,$slug,$method);
	}

	/**
	 * Add Metabox
	 *
	 * @access protected
	 * @param string $type, array $args
	 * @return boolean
	 *
	 * action : add_meta_boxes
	 */
	protected function addMetabox($id, $title, $callback, $screen, $context = 'advanced', $priority = 'high', $callback_args = null)
	{
		add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args);
	}

	public function cleanAssetsUrl($url)
	{
		if( strpos($url,'?ver=') ) $url = remove_query_arg('ver',$url);
		return $url;
	}

	/**
	 * Check if is plugin namespace
	 *
	 * @category Admin
	 * @param void
	 * @return true|null
	 */
	public function isPluginAdmin()
	{
		$protocol = isset($_SERVER['HTTPS']) ? "https://" : "http://";
		$area = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$admin = strpos($area, admin_url('admin.php?page=VanilleNameSpace'));
		$ajax  = strpos($area, admin_url('admin-ajax.php'));

		if ( ($admin !== false || $ajax !== false ) && $this->isAdmin() ) return true;
	}

	/**
	 * Get plugin root path
	 *
	 * @category Admin
	 * @param null|string $path
	 * @return string
	 *
	 * @see plugin_dir_path
	 */
	protected function getRoot($path = null)
	{
		if (isset($path)) return WP_PLUGIN_DIR . $path;
		else return WP_PLUGIN_DIR;
	}

	/**
	 * Send notification
	 *
	 * @category Admin
	 * @param void
	 * @return string
	 */
	protected function isAdmin($url = null)
	{
		if (is_admin($url)) return true;
	}

	/**
	 * Send email
	 *
	 * @category Admin
	 * @param $to, $subject, $body, $header = []
	 * @return boolean
	 */
	protected function sendMail($to = null, $subject, $body, $header = null)
	{
		if ( is_null($header) ) $header = ['Content-Type:text/html;charset=UTF-8'];
		if ( is_null($to) || !$to ) $to = $this->getOption('admin_email');
		return wp_mail($to, $subject, $body, $header);
	}

	/**
	 * userExists
	 *
	 * @category Admin
	 * @param $to, $subject, $body, $header = []
	 * @return boolean
	 */
	protected function userExists($email)
	{
		return email_exists($email);
	}

	/**
	 * Get user role
	 *
	 * @category Admin
	 * @param void
	 * @return string | array
	 */
	protected function getRole($id = null)
	{
		if( is_null($id) || empty($id) )
		{
			$id = get_current_user_id();
		}

		$user = new \WP_User($id);

		if( !empty( $user->roles ) && is_array( $user->roles ) )
		{
		    foreach ( $user->roles as $role )
		    echo $role;
		}
	}

	/**
	 * Get user role
	 *
	 * @category Admin
	 * @param void
	 * @return object|null
	 */
	protected function addRole($role, $name = null, $capability = null)
	{
		if (is_null($name)) $name = $role;
		if (is_null($capability))
		{
			$capability = [

				'read' => true

			];
		}
		add_role($role,$name,$capability);
	}

	/**
	 * Remove user role
	 *
	 * @category Admin
	 * @param string $role
	 * @return void
	 */
	protected static function removeRole($role)
	{
		remove_role($role);
	}

	/**
	 * Get user role
	 *
	 * @category Admin
	 * @param void
	 * @return object|null
	 */
	protected function addCapability($role, $capability, $grant = true)
	{
		$role = get_role($role);
		$role->add_cap($capability,$grant);
	}

	/**
	 * Get user role
	 *
	 * @category Admin
	 * @param void
	 * @return object|null
	 */
	protected static function removeCapability($role, $capability)
	{
		$role = get_role($role);
		$role->remove_cap($capability);
	}

	/**
	 * Loads a plugin’s translated strings
	 *
	 * @category Html
	 * @param void
	 * @return void
	 *
	 * action : after_setup_theme
	 */
	public function translate()
	{
		load_plugin_textdomain( 'VanilleNameSpace', false, 'VanilleNameSpace/languages' ); 
	}

	/**
	 * Redirects to another page
	 *
	 * @category Http
	 * @param string $location, int $status
	 * @return void
	 */
	public function redirect($location, $status = 301)
	{
		wp_redirect($location, $status);
		exit();
	}

	/**
	 * Kill WordPress execution and display HTML message with error message
	 *
	 * @category System
	 * @param string $messsage, string $title, array $args
	 * @return void
	 */
	protected function except($message = '', $title = '', $args = [])
	{
		wp_die($message,$title,$args);
	}
}
