<?php
/**
 * Plugin name: PHP System Info
 * Description: Plugin is for demo purpose for Awesomemotive. It will show basic php system info. go to tool section in WordPress admin.
 * Author: 1naveengiri
 * Version: 0.2
 * Text Domain: php_sys_info
 *
 * @package Php_System_Info
 */

require_once __DIR__.'/vendor/autoload.php';
use PhpSystemInfo;
$instance = Php_Info::get_instance();