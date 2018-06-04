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

use \VanilleNameSpace\core\system\libraries\Shortcode;

interface FrontInterface
{
	function __construct(ConfigInterface $config = null, Shortcode $shortcode = null);
}
