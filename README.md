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

Zinc UI is a UI component library for your Livewire applications. It's built using [Tailwind CSS](https://tailwindcss.com/) and [Alpine Js](https://alpinejs.dev/).

## Documentation

Coming soon!

## Installation

This package is still on Alpha version, so you need to change `minimum-stability` to `dev`.
Open your composer json and add the following line:

```
{
    ...
    "minimum-stability": "dev",
    "prefer-stable": true
}
```

You can install the package via composer:

```bash
composer require arifbudimanar/zinc-ui
```

```bash
php artisan zinc:install
```

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
