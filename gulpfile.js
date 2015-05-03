var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('app.less');

    // Condense all Javascript Vendors
	mix.scriptsIn('public/vendor/js', 'public/output/vendor.js');

	// Condense the Javascript Vendor (condensed) with the rest of the JS
	mix.scripts([
		"output/vendor.js"
	], "public/output/final.js", 'public');
});

