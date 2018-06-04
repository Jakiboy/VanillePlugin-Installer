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

class Cache
{
	/**
	 * Adds data to the cache, if the cache key doesn’t already exist
	 *
	 * @category Plugin core
	 * @param int|string $key, mixed $data, string $group, int $expire
	 * @return bool
	 */
	public function add($key, $data, $group, $expire)
	{
		wp_cache_add($key,$data,$group,$expire);
	}

	/**
	 * Saves the data to the cache
	 *
	 * @category Plugin core
	 * @param int|string $key, mixed $data, string $group, int $expire
	 * @return bool
	 */
	public function set($key, $data, $group, $expire)
	{
		wp_cache_set( $key, $data, $group, $expire );
	}

	/**
	 * Retrieves the cache contents from the cache by key and group
	 *
	 * @category Plugin core
	 * @param int|string $key, mixed $data, string $group, int $expire
	 * @return bool
	 */
	public function get($key, $group = '', $force = false, $found = null)
	{
		wp_cache_get( $key, $group, $force, $found );
	}

	/**
	 * Clears data from the cache for the given key
	 *
	 * @category Plugin core
	 * @param $plugin
	 * @return bool
	 */
	public function delete($key, $data, $group, $expire)
	{
		wp_cache_set( $key, $data, $group, $expire );
	}

	/**
	 * Replaces the given cache if it exists
	 *
	 * @category Plugin core
	 * @param $plugin
	 * @return bool
	 */
	public function replace($key, $data, $group, $expire)
	{
		wp_cache_replace( $key, $data, $group, $expire );
	}

	/**
	 * Clears all cached data
	 *
	 * @category Plugin core
	 * @param $plugin
	 * @return bool
	 */
	public static function flush()
	{
		wp_cache_flush();
	}
}
