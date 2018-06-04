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

use \VanilleNameSpace\core\system\libraries\Db;

final class Migrate
{
	public static function table()
	{
		self::prpare('install');
	}

	public static function rollback()
	{
		self::prpare('uninstall');
	}

	private static function prpare($action)
	{
		$db = new Db();
		$config = new Config($action);

		$replace = [
			'[DBPREFIX]' => $db->prefix,
			'[COLLATE]'  => $db->collate,
			'[PREFIX]'   => $config->prefix
		];

		$query = Text::replace($config->{"{$action}Sql"},$replace);
		$db->query($query);
	}
}
