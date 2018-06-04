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

use \VanilleNameSpace\core\system\includes\Config;
use \VanilleNameSpace\core\system\libraries\interfaces\DatabaseInterface;

final class Db implements DatabaseInterface
{
	/**
	 * @access public
	 */
	public $prefix;
	public $collate;
	public $tablePrefix;
	
	/**
	 * @access private
	 */
	private $db;

	/**
	 * init Db object
	 *
	 * @param void
	 * @return object Db
	 */
	public function __construct()
	{
		self::init(new Config);
	}

	/**
	 * Wrapp Wordpress database object
	 *
	 * @access public
	 * @param void
	 * @return void
	 */
	private function init($config = null)
	{
		global $wpdb;
		
		$this->db = $wpdb;
		$this->prefix  = $this->db->prefix;
		$this->collate = $this->db->collate;
		$this->tablePrefix = $config->prefix;
	}

	/**
	 * Execute SQL query usin worpdress upgrade function
	 *
	 * @see /Class_Reference/wpdb#query
	 * @access public
	 * @param string $sql
	 * @return array
	 *
	 * @deprecated use insert and select instead
	 */
	public function query($sql = '')
	{
		return $this->db->query($sql);
	}

	/**
	 * Insert data to table
	 *
	 * @see /Class_Reference/wpdb#INSERT_row
	 * @access public
	 * @param string $table, array $data, null string $format 
	 * @return string|int
	 */
	public function insert($table, $data = [], $format = null)
	{
		$this->db->insert($this->prefix.$this->tablePrefix.$table, $data, $format);
		return $this->db->insert_id;
	}

	/**
	 * Execute SQL query
	 *
	 * @see /Class_Reference/wpdb#SELECT_Generic_Results
	 * @access public
	 * @param string $table, array $data, null string $format 
	 * @return array|object
	 */
	public function select($sql = '', $response = ARRAY_A)
	{
		if ($response == 'single') return $this->db->get_var($sql);
		else return $this->db->get_results($sql, $response);
	}

	/**
	 * Execute SQL query
	 *
	 * @see /Class_Reference/wpdb#DELETE_Rows
	 * @access public
	 * @param string $table, array $data, null string $format 
	 * @return array|object
	 */
	public function delete($table, $where = [], $whereFormat = null)
	{
		return $this->db->delete($this->prefix.$table, $where, $whereFormat);
	}
}
