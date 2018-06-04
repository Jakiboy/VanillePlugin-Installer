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

class Cron extends Wordpress
{
	/**
	* @access private
	*/
	private $interval;
	private $intervalName;
	private $intervalDesc;

	/**
	 * Define interval
	 *
	 * @access public
	 * @param int $val, string $name, string $desc
	 * @return void
	 */
	public function setInterval($val,$name,$desc)
	{
		$this->interval = $val;
		$this->intervalName = $name;
		$this->intervalDesc = $desc;
	}

	/**
	 * Add custom interval
	 *
	 * @access public
	 * @param array $schedules
	 * @return array
	 *
	 * filter : cron_schedules
	 */
	public function addInterval($schedules)
	{
	    $schedules[$this->intervalName] = [

	        'interval' => $this->interval,
	        'display'  => esc_html__( $this->intervalDesc )

	    ];
	    return $schedules;
	}

	/**
	 * Clean scheduled hook
	 *
	 * @access public
	 * @param string $name
	 * @return void
	 */
	public static function clean($name)
	{
		wp_clear_scheduled_hook($name);
	}

	/**
	 * Check scheduled waitlist
	 *
	 * @access public
	 * @param string $name
	 * @return boolean
	 */
	public static function next($name)
	{
		return wp_next_scheduled($name);
	}

	/**
	 * Check scheduled waitlist
	 *
	 * @access public
	 * @param string $interval, string $hook
	 * @return void
	 */
	public static function schedule($interval,$hook)
	{
		wp_schedule_event(time(), $interval, $hook);
	}
}
