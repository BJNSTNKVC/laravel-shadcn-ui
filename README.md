# Laravel shadcn/ui

Port of [shadcn/ui](https://ui.shadcn.com) for Laravel: A collection of reusable Blade components inspired by shadcn/ui,
designed to simplify the integration of modern, accessible, and customizable UI elements into Laravel applications.

## Installation

You can install the package via composer:

```bash
composer require bjnstnkvc/shadcn-ui --dev
```

The package will automatically register its service provider.

## Usage

This library utilizes [Tailwind CSS](https://tailwindcss.com/) for styling and [Alpine.js](https://alpinejs.dev/) for
JavaScript functionality. It provides a collection of reusable components that can be used in your Laravel applications.

In order to install the dependencies, run the following command:

### Install Tailwind CSS:

```bash
npm install -D tailwindcss
npx tailwindcss init
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag=shadcn-ui-tailwind-config
```

### Install Alpine.js:

```bash
npm install alpinejs
```

Import Alpine into your bundle and initialize it in your `resources/js/app.js` file, like so:

```js
import Alpine from 'alpinejs';

Alpine.start();
```

In order to bootstrap the components, add the following line to your `AppServiceProvider` boot method:

```php
use Bjnstnkvc\ShadcnUi\ShadcnUiServiceProvider;

/**
 * Bootstrap any application services.
 */
public function boot(): void
{
    ShadcnUiServiceProvider::components();
}
```

## Components

The package provides a collection of reusable components that can be used in your Laravel applications. Here's a list of
the available components:

- [Accordion](docs/accordion.md)