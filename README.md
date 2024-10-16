# Chip Laravel Package

[![Latest Version](https://img.shields.io/github/v/tag/syahrinseth/chip-laravel)](https://github.com/syahrinseth/chip-laravel/releases)
[![License](https://img.shields.io/github/license/syahrinseth/chip-laravel)](LICENSE)

`syahrinseth/chip-laravel` is a Laravel wrapper for the [CHIP API](https://chip.my), making it easier to interact with CHIP's payment gateway in Laravel applications.

## Features

- Simplifies integration with CHIP API in Laravel projects.
- Handles creating purchases, redirecting users to CHIP checkout, and handling callbacks.

## Requirements

- PHP 8.2 or higher
- Laravel 9.0 or higher
- [CHIP SDK for PHP](https://github.com/CHIPAsia/chip-php-sdk)

## Installation

1. First, make sure you add the CHIP SDK & Chip Laravel repository to your **Laravel project's** `composer.json`:

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/CHIPAsia/chip-php-sdk.git"
    },
    {
        "type": "vcs",
        "url": "https://github.com/syahrinseth/chip-laravel.git"
    },
],
"require": {
    "syahrinseth/chip-laravel": "dev-main"
}
```

2. Run `composer install`.
```bash
composer install
```

## Configuration

### Publish the configuration file using the command:

```bash
php artisan vendor:publish --provider="SyahrinSeth\ChipLaravel\ChipServiceProvider" --tag="config"
```

This will create a config/chip.php file where you can set your CHIP brand_id, api_key, and endpoint.

### Update your `.env` file with your CHIP credentials:
```
CHIP_BRAND_ID=your_chip_brand_id
CHIP_API_KEY=your_chip_api_key
CHIP_ENDPOINT=https://gate.chip-in.asia/api/v1
```

## Usage Example

### Here’s an example of how to create a new purchase using the Chip Laravel package:

```php
use SyahrinSeth\ChipLaravel\ChipService;
use Chip\Model\Product;

public function createPurchase(Request $request)
{
    $chipService = new ChipService();
    $product = new Product();
    $product->name = 'Test Product';
    $product->price = 100;
    
    $checkoutUrl = $chipService->createPurchase(
        'test@example.com',
        [
            $product
        ]
        'https://yourdomain.com/redirect.php?success=1',
        'https://yourdomain.com/redirect.php?success=0',
        'https://yourdomain.com/callback.php?success=0'
    );
    
    return redirect($checkoutUrl);
}
```
# License
### This package is open-sourced software licensed under the MIT license.

```md

### Explanation of the Structure:

1. Badges: The badges at the top give a visual representation of the latest version and license.
2. Features: This section lists what the package does and why it's useful.
3. Requirements: This lists the required versions of PHP, Laravel, and any other dependencies.
4. Installation: Details on how to install the package, including adding the CHIP SDK repository & Package to the project's `composer.json`.
5. Configuration: Explains how to publish and configure the package for use in a Laravel project.
6. Usage Example: Provides a code snippet to demonstrate how to use the package in a Laravel project.
7. License: States that the package uses the MIT license.
```