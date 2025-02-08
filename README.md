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

**Zinc UI** is A UI component library for [Livewire](https://livewire.laravel.com/) , built with [Tailwind CSS](https://tailwindcss.com/) and [Alpine.js](https://alpinejs.dev/).

## Documentation

You can find the documentation [here](https://zinc.arifcode.dev/).

## Installation

> **Package Status: Alpha Stage**

### Configure `composer.json`

Since Zinc UI is in its Alpha version, you need to modify the composer.json file. Open the file and ensure the following lines are present:

```json
{
    "minimum-stability": "dev"
}
```

### Install Zinc UI

Run the following command to add Zinc UI to your project:

```sh
composer require arifbudimanar/zinc-ui
```

### Set up Zinc UI

After installation, initialize the package by running:

```sh
php artisan zinc:install
```

<!-- ### Publishing components (optional)

If you want to customize the components, you can publish them using this command:

```sh
php artisan zinc:publish
``` -->

### Check installed version

To check the version of Zinc UI installed, run:

```sh
php artisan zinc:version
```

### Create a Livewire Component

Generate a Livewire component by running:

```sh
php artisan make:livewire Home
```

Update the `Home.php` file with this content:

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

Zinc UI includes several layouts tailored to different page types:

-   `header` : For public pages like home and about.
-   `header-sidebar` : For user-facing pages like dashboards and profiles.
-   `without-header` : For authentication pages like login and register.
-   `sidebar` : For admin pages like admin dashboards.
-   `sidebar-header` : Another option for admin dashboards.

### Update routes

Open the web.php file and define a route for your component:

```php
use App\Livewire\Home;

Route::get('/', Home::class);
```

## Run the application

Start the development server and compile the assets using:

```sh
composer run dev
```

Visit http://localhost:8000 to see Zinc UI in action.

## Testing

```sh
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
