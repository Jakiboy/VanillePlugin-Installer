<?php
/**
 * Plugin Name: [VanilleName]
 * Version: 1.0.0
 * Plugin URI: https://jakiboy.github.io/VanillePlugin
 * Description: [VanilleDescription] | Powered by <strong>VanillePlugin</strong>(c)
 * Author: JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 * Author URI: https://info.jihadsinnaour.com
 * License: MIT
 * Requires at least: 4.0
 * Tested up to: 4.9.6
 *
 * Text Domain: VanilleNameSpace
 * Domain Path: /languages

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

/**
 * @package VanillePlugin
 * @author JIHAD SINNAOUR
 * @copyright (c) 2018 JIHAD SINNAOUR <j.sinnaour.official@gmail.com>
 */

include('core/Framework.php');
\VanilleNameSpace\core\Framework::init();
\VanilleNameSpace\core\system\Plugin::start();