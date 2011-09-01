<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| SCSS Cache URL
|--------------------------------------------------------------------------
|
| URL to your scss cache folder. Typically it will be relative to your base url.
|
| Default: $config['scss_cache_url'] = 'cache/css/';
|
*/
$config['scss_cache_url'] = 'static/css/';


/*
|--------------------------------------------------------------------------
| SCSS Cache Path
|--------------------------------------------------------------------------
|
| The system path to your scss cache folder. Typically it will be relative 
| to your Codeigniter root and end in the same folder as teh scss cache url.
|
| Default: $config['scss_cache_path'] = FCPATH.$config['scss_cache_url'];
|
*/
$config['scss_cache_path'] = FCPATH.$config['scss_cache_url'];

/* End of file scss.php */
/* Location: sparks/scss/../config/scss.php */