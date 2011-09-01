# SCSS Spark

This Spark enables easy rendering & caching of scss files.
*This spark **requires sass to be installed** on the host machine*.

## Usage:

In your controller, simply load the spark:

```php

class App extends CI_Controller {

	public function index()	{

		$this->load->spark('scss/[version]');
		$this->load->view('homepage');

	}

}
```


Then in you view:

```html
<link rel="stylesheet" href="<?=scss('static/scss/layout.scss')?>" />
```

You can also get the render css as a string and do whatever you want with it:

```php

class App extends CI_Controller {

	public function index()	{

		$this->load->spark('scss/[version]');
		$css = render_scss('static/scss/layout.scss');

	}

}
```