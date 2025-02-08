# Contributing to Zinc UI

Thank you for your interest in contributing to Zinc UI! Follow these steps to get started.

## Getting Started

1. **Fork the repository** on GitHub.
2. **Create a new Laravel project**:
    ```sh
    laravel new my-project
    ```
3. **Create a folder for the package** inside your Laravel project:
    ```sh
    mkdir -p packages/yourname/
    ```
4. **Clone your forked repository** into the package directory:
    ```sh
    git clone https://github.com/YOUR_GITHUB_USERNAME/zinc-ui.git packages/yourname/zinc-ui
    ```
5. **Add the package to `composer.json`** in your Laravel project:
    ```json
    "repositories": {
        "zinc-ui": {
            "type": "path",
            "url": "packages/yourname/zinc-ui",
            "options": {
                "symlink": true
            }
        }
    }
    ```
6. **Require the package in your Laravel project**:
    ```sh
    composer install
    ```
7. **Start contributing!**

## Submitting Changes

1. Create a new branch for your feature or fix:
    ```sh
    git checkout -b feature-or-fix-name
    ```
2. Commit your changes with a meaningful message:
    ```sh
    git commit -m "Describe your changes"
    ```
3. Push to your fork:
    ```sh
    git push origin feature-or-fix-name
    ```
4. Open a pull request on GitHub.

Thank you for contributing! 🎉
