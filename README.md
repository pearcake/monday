# Monday

Simple Wordpress starter theme with Webpack and ES5, ES6 and ES7 JS support (transpiled by Babel and polyfilled in IE via polyfill.io CDN)

# Requirements

This project requires Node.js v8.x.x to be installed on your machine. Please be aware that you might encounter problems with the installation if you are using the most current Node version (bleeding edge) with all the latest features.

## Quickstart

### 1. Clone the repository and install with npm
```bash
$ cd my-wordpress-folder/wp-content/themes/
$ git clone https://github.com/pearcake/monday.git
$ cd monday
$ npm install
```

### 2. Configuration

#### Browsersync setup

Create livereload.json in your theme folder (added to .gitignore by default) with "url" and "port" parameters that will be used to proxy your local Wordpress server during development. Example:

```json
{
    "url": "http://localhost/wordpress",
    "port": 3000
}
```

#### Theme textdomain
If you want to use custom textdomain you can change it globally on line 5 in ``functions.php``:

```php
define('THEME_TEXTDOMAIN', 'yourcustomtextdomain');
```
and use it like this:
```php
<?php _e('Text that needs translation', THEME_TEXTDOMAIN); ?>
```

### 3. Get started

```bash
$ npm run watch
```

### 4. Compile assets for production

When building for production, the CSS and JS will be minified. To compile and minify the assets in your `/assets/dist` folder, run

```bash
$ npm run build
```