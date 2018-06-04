<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

namespace VanilleNameSpace\core\system\libraries\interfaces;

interface DatabaseInterface
{
	public $prefix;
	public $collate;
	public $tablePrefix;
	public function __construct();
	public function query($sql = '');
	public function insert($table, $data = [], $format = null);
	public function select($sql = '', $response = ARRAY_A);
	public function delete($table, $where = [], $whereFormat = null);
}
