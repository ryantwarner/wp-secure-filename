<?php
/*
Plugin Name: WP Safe Filename
Description: Sanitizes uploaded file names and adds a Ymd datestamp.
Author: Ryan Warner
Version: 0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit;

function secure_filename($filename) {
	$info = pathinfo($filename);
	$ext  = empty($info['extension']) ? '' : '.' . $info['extension'];
	$name = basename($filename, $ext);
  $name = preg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $name);
  $name = preg_replace("([\.]{2,})", '', $name);
	return $name . "-" . date("Ymd") . $ext;
}
add_filter('sanitize_file_name', 'secure_filename', 10);
