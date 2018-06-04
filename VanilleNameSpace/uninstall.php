<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : VanillePlugin
 * @version   : 1.0.0
 * @copyright : (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * @link      : https://jakiboy.github.io/VanillePlugin/
 * @license   : MIT
 */

// WordPress Security Basic
if (!defined( 'WP_UNINSTALL_PLUGIN' )) die('forbidden');

include('core/Framework.php');
\VanilleNameSpace\core\Framework::init();
\VanilleNameSpace\core\system\Plugin::uninstall();