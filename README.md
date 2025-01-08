<p align="center">
    <picture>
        <source srcset="/art/logo-light.svg" media="(prefers-color-scheme: light)">
        <source srcset="/art/logo-dark.svg" media="(prefers-color-scheme: dark)">
        <img src="/art/logo-light.svg" alt="Logo Zinc UI">
    </picture>
</p>

<p align="center">
    <a href="https://packagist.org/packages/arifbudimanar/zinc-ui"><img src="https://img.shields.io/packagist/v/arifbudimanar/zinc-ui.svg?style=flat-square" alt="Latest Version on Packagist"></a>
    <a href="https://packagist.org/packages/arifbudimanar/zinc-ui"><img src="https://img.shields.io/github/actions/workflow/status/arifbudimanar/zinc-ui/run-tests.yml?branch=main&label=tests&style=flat-square" alt="GitHub Tests Action Status"></a>
    <a href="https://packagist.org/packages/arifbudimanar/zinc-ui"><img src="https://img.shields.io/github/actions/workflow/status/arifbudimanar/zinc-ui/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square" alt="GitHub Code Style Action Status"></a>
    <a href="https://packagist.org/packages/arifbudimanar/zinc-ui"><img src="https://img.shields.io/packagist/dt/arifbudimanar/zinc-ui.svg?style=flat-square" alt="Total Downloads"></a>
</p>

## Introduction

**Zinc UI** is a UI component library designed for your Livewire applications. It is built with [Tailwind CSS](https://tailwindcss.com/) and [Alpine.js](https://alpinejs.dev/).

## Documentation

Documentation is currently in development. Stay tuned!

## Installation

Since this package is in its Alpha stage, you need to adjust the `minimum-stability` setting in your `composer.json` file. Add the following lines:

```json
{
    ...
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

Install the package via Composer:

```bash
composer require arifbudimanar/zinc-ui
```

Run the installer:

```bash
php artisan zinc:install
```

Publish components:

```bash
php artisan zinc:publish
```

## Compile Assets

After completing the installation steps, compile the frontend assets using:

```bash
npm run dev
```

## Example

### Create a Livewire Component

Generate a new Livewire component with the following command:

```bash
php artisan make:livewire Home
```

### Update `Home.php`

Add the following code to your Home.php file:

```php
#[Layout('layouts.sidebar-header')]
#[Title('Home')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}
```

### Layout Options

Zinc UI provides built-in layout options suited for different use cases:

-   `without-header` : For authentication pages like login and register.
-   `header` : For public pages like home and about.
-   `header-sidebar` : For user pages like dashboards and profiles.
-   `sidebar` : For admin pages like admin dashboards.
-   `sidebar-header` : Also for admin pages like admin dashboards.

### Update `web.php`

Add the following route to your web.php file:

```php
Route::get('/', Home::class);
```

Visit your application's URL to see Zinc UI in action!

## Testing

Coming soon!

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Arif Budiman Arrosyid](https://github.com/arifbudimanar)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
