> Elasticsearch DevTools is an Elasticsearch ODM and mapper for PHP. It renders the developer experience more enjoyable while using Elasticsearch queries similarly as you normally would.

[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/ulex/elasticsearch-dev-tools)

> Created using Elasticsearch v7.x

# Installation

First, install the package via Composer:
```bash
composer require ulex/elasticsearch-dev-tools
```
<h2> Service Provider </h2>
<h3>For Laravel</h3>
You should publish the RepositoriesServiceProvider:

```php
php artisan vendor:publish --provider="Ulex\ElasticsearchDevTools\ElasticsearchDevToolsServiceProvider" --tag=config
```

Optional: The service provider will automatically get registered. Or you may manually add the service provider in your config/app.php file:
```php
'providers' => [
// ...
Ulex\ElasticsearchDevTools\ElasticsearchDevToolsServiceProvider::class,
```

<h3>For Lumen</h3>

In your `bootstrap/app.php` add this:
```
$app->register(Ulex\ElasticsearchDevTools\ElasticsearchDevToolsServiceProvider::class);
```
---------------

<h2> Config </h2>

If config file `elasticsearch-dev-tools.php` was not published copy it to config folder with:
```
cp vendor/ulex/elasticsearch-dev-tools/config/elasticsearch-dev-tools.php config/elasticsearch-dev-tools.php
```

# Usage
