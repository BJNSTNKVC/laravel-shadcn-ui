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

Add the following to your `resources/css/app.css` file:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
	:root {
		--background: 0 0% 100%;
		--foreground: 240 10% 3.9%;
		--card: 0 0% 100%;
		--card-foreground: 240 10% 3.9%;
		--popover: 0 0% 100%;
		--popover-foreground: 240 10% 3.9%;
		--primary: 240 5.9% 10%;
		--primary-foreground: 0 0% 98%;
		--secondary: 240 4.8% 95.9%;
		--secondary-foreground: 240 5.9% 10%;
		--muted: 240 4.8% 95.9%;
		--muted-foreground: 240 3.8% 46.1%;
		--accent: 240 4.8% 95.9%;
		--accent-foreground: 240 5.9% 10%;
		--destructive: 0 72.22% 50.59%;
		--destructive-foreground: 0 0% 98%;
		--border: 240 5.9% 90%;
		--input: 240 5.9% 90%;
		--ring: 240 5% 64.9%;
		--radius: 0.5rem;
		--chart-1: 12 76% 61%;
		--chart-2: 173 58% 39%;
		--chart-3: 197 37% 24%;
		--chart-4: 43 74% 66%;
		--chart-5: 27 87% 67%;
		--sidebar-background: 0 0% 98%;
		--sidebar-foreground: 240 5.3% 26.1%;
		--sidebar-primary: 240 5.9% 10%;
		--sidebar-primary-foreground: 0 0% 98%;
		--sidebar-accent: 240 4.8% 95.9%;
		--sidebar-accent-foreground: 240 5.9% 10%;
		--sidebar-border: 220 13% 91%;
		--sidebar-ring: 240 5% 64.9%;
	}

	.dark {
		--background                 : 240 10% 3.9%;
		--foreground                 : 0 0% 98%;
		--card                       : 240 10% 3.9%;
		--card-foreground            : 0 0% 98%;
		--popover                    : 240 10% 3.9%;
		--popover-foreground         : 0 0% 98%;
		--primary                    : 0 0% 98%;
		--primary-foreground         : 240 5.9% 10%;
		--secondary                  : 240 3.7% 15.9%;
		--secondary-foreground       : 0 0% 98%;
		--muted                      : 240 3.7% 15.9%;
		--muted-foreground           : 240 5% 64.9%;
		--accent                     : 240 3.7% 15.9%;
		--accent-foreground          : 0 0% 98%;
		--destructive                : 0 62.8% 30.6%;
		--destructive-foreground     : 0 85.7% 97.3%;
		--border                     : 240 3.7% 15.9%;
		--input                      : 240 3.7% 15.9%;
		--ring                       : 240 4.9% 83.9%;
		--chart-1                    : 220 70% 50%;
		--chart-2                    : 160 60% 45%;
		--chart-3                    : 30 80% 55%;
		--chart-4                    : 280 65% 60%;
		--chart-5                    : 340 75% 55%;
		--sidebar-background         : 240 5.9% 10%;
		--sidebar-foreground         : 240 4.8% 95.9%;
		--sidebar-primary            : 224.3 76.3% 48%;
		--sidebar-primary-foreground : 0 0% 100%;
		--sidebar-accent             : 240 3.7% 15.9%;
		--sidebar-accent-foreground  : 240 4.8% 95.9%;
		--sidebar-border             : 240 3.7% 15.9%;
		--sidebar-ring               : 240 4.9% 83.9%;
	}
}
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
- [Alert](docs/alert.md)
- [Aspect Ratio](docs/aspect-ratio.md)
- [Avatar](docs/avatar.md)
- [Badge](docs/badge.md)
- [Breadcrumb](docs/breadcrumb.md)
- [Button](docs/button.md)