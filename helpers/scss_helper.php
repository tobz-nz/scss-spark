<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * scss
 *
 * Takes a .scss file, renders a css file to disk and returns the url to the css file. 
 *
 * @access	public
 * @param	string 	path to scss relative to index.php
 * @return	string
 */
if (!function_exists('cache_scss')) {
	function scss($path) {

		// make sure the path is relative, so we know our final url will be correct
		$path = FCPATH.$path;
		
		// get the real system path
		$dir = realpath(dirname($path));

		// get all scss fiel in the same folder and create a hash we can use to detect changes to any of the files.
		// we can't just use the current file as scss can include other files
		$d = dir($dir);
		$files = '';
		while (false !== ($file = $d->read())) {
			if (preg_match('/(\.scss)$/u', $file)) {
				$file_info = get_file_info($dir.'/'.$file, 'date');
				$files .= $file_info['date'];
			}
		}
		$d->close();

		// has to detect file changes
		$files_date_hash = md5($files);
		// hash the filename - this will make sure browsers don't load old cached css
		$cache_file_name = md5($path.$files_date_hash).'.css';
		$cache_file = config_item('scss_cache_path').$cache_file_name;

		// if the file exists, then no changes were made, skip the rendering process
		if (!file_exists($cache_file)) {
			$css = render_scss($path, $cache_file);
		}

		// return full url to the cached css file
		return base_url(config_item('scss_cache_url').$cache_file_name);

	}
}

// ------------------------------------------------------------------------

/**
 * render_scss
 *
 * Renders .css from the given .scss file.  First param is the path to the scss file relative to index.php.
 * Second param is the relative path to output the css file. And the third param is the scss parameters (default --style compresed)
 *
 * @access	public
 * @param	string 	path to scss
 * @param	string 	path to output css
 * @param	string 	scss options
 * @return	string
 */

if (!function_exists('render_scss')) {
	function render_scss($scss_file, $output_file=false, $scss_parameters='--style compressed') {
		
		// check the output folder exists and create it if needed
		if ($output_file) {
			$dir = dirname($output_file);
			if (!file_exists($dir)) {
				mkdir($dir, 0777, TRUE);
			}
		}
		
		// escape our scss command for safety
		$cmd = escapeshellcmd("sass $scss_parameters $scss_file $output_file");

		// run the scss compiler and return the results
		return shell_exec($cmd);
	}
}

/* End of file scss_helper.php */
/* Location: sparks/scss/../helpers/scss_helper.php */