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

### Tailwind CSS v3:

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
		--background                 : 0 0% 100%;
		--foreground                 : 240 10% 3.9%;
		--card                       : 0 0% 100%;
		--card-foreground            : 240 10% 3.9%;
		--popover                    : 0 0% 100%;
		--popover-foreground         : 240 10% 3.9%;
		--primary                    : 240 5.9% 10%;
		--primary-foreground         : 0 0% 98%;
		--secondary                  : 240 4.8% 95.9%;
		--secondary-foreground       : 240 5.9% 10%;
		--muted                      : 240 4.8% 95.9%;
		--muted-foreground           : 240 3.8% 46.1%;
		--accent                     : 240 4.8% 95.9%;
		--accent-foreground          : 240 5.9% 10%;
		--destructive                : 0 72.22% 50.59%;
		--destructive-foreground     : 0 0% 98%;
		--border                     : 240 5.9% 90%;
		--input                      : 240 5.9% 90%;
		--ring                       : 240 5% 64.9%;
		--radius                     : 0.5rem;
		--chart-1                    : 12 76% 61%;
		--chart-2                    : 173 58% 39%;
		--chart-3                    : 197 37% 24%;
		--chart-4                    : 43 74% 66%;
		--chart-5                    : 27 87% 67%;
		--sidebar-background         : 0 0% 98%;
		--sidebar-foreground         : 240 5.3% 26.1%;
		--sidebar-primary            : 240 5.9% 10%;
		--sidebar-primary-foreground : 0 0% 98%;
		--sidebar-accent             : 240 4.8% 95.9%;
		--sidebar-accent-foreground  : 240 5.9% 10%;
		--sidebar-border             : 220 13% 91%;
		--sidebar-ring               : 240 5% 64.9%;
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

### Tailwind CSS v4:

```bash
npm install tailwindcss @tailwindcss/vite
```

Configure the Vite plugin:

```js
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        tailwindcss(),
    ],
})
```

Add the following to your resources/css/app.css file:

```css
@import "tailwindcss";

@custom-variant dark (&:is(.dark *));

:root {
	--card                       : oklch(1 0 0);
	--card-foreground            : oklch(0.145 0 0);
	--popover                    : oklch(1 0 0);
	--popover-foreground         : oklch(0.145 0 0);
	--primary                    : oklch(0.205 0 0);
	--primary-foreground         : oklch(0.985 0 0);
	--secondary                  : oklch(0.97 0 0);
	--secondary-foreground       : oklch(0.205 0 0);
	--muted                      : oklch(0.97 0 0);
	--muted-foreground           : oklch(0.556 0 0);
	--accent                     : oklch(0.97 0 0);
	--accent-foreground          : oklch(0.205 0 0);
	--destructive                : oklch(0.577 0.245 27.325);
	--destructive-foreground     : oklch(0.577 0.245 27.325);
	--border                     : oklch(0.922 0 0);
	--input                      : oklch(0.922 0 0);
	--ring                       : oklch(0.87 0 0);
	--chart-1                    : oklch(0.646 0.222 41.116);
	--chart-2                    : oklch(0.6 0.118 184.704);
	--chart-3                    : oklch(0.398 0.07 227.392);
	--chart-4                    : oklch(0.828 0.189 84.429);
	--chart-5                    : oklch(0.769 0.188 70.08);
	--radius                     : 0.625rem;
	--sidebar                    : oklch(0.985 0 0);
	--sidebar-foreground         : oklch(0.145 0 0);
	--sidebar-primary            : oklch(0.205 0 0);
	--sidebar-primary-foreground : oklch(0.985 0 0);
	--sidebar-accent             : oklch(0.97 0 0);
	--sidebar-accent-foreground  : oklch(0.205 0 0);
	--sidebar-border             : oklch(0.922 0 0);
	--sidebar-ring               : oklch(0.87 0 0);
	--background                 : oklch(1 0 0);
	--foreground                 : oklch(0.145 0 0);
}

.dark {
	--background                 : oklch(0.145 0 0);
	--foreground                 : oklch(0.985 0 0);
	--card                       : oklch(0.145 0 0);
	--card-foreground            : oklch(0.985 0 0);
	--popover                    : oklch(0.145 0 0);
	--popover-foreground         : oklch(0.985 0 0);
	--primary                    : oklch(0.985 0 0);
	--primary-foreground         : oklch(0.205 0 0);
	--secondary                  : oklch(0.269 0 0);
	--secondary-foreground       : oklch(0.985 0 0);
	--muted                      : oklch(0.269 0 0);
	--muted-foreground           : oklch(0.708 0 0);
	--accent                     : oklch(0.269 0 0);
	--accent-foreground          : oklch(0.985 0 0);
	--destructive                : oklch(0.396 0.141 25.723);
	--destructive-foreground     : oklch(0.637 0.237 25.331);
	--border                     : oklch(0.269 0 0);
	--input                      : oklch(0.269 0 0);
	--ring                       : oklch(0.439 0 0);
	--chart-1                    : oklch(0.488 0.243 264.376);
	--chart-2                    : oklch(0.696 0.17 162.48);
	--chart-3                    : oklch(0.769 0.188 70.08);
	--chart-4                    : oklch(0.627 0.265 303.9);
	--chart-5                    : oklch(0.645 0.246 16.439);
	--sidebar                    : oklch(0.205 0 0);
	--sidebar-foreground         : oklch(0.985 0 0);
	--sidebar-primary            : oklch(0.488 0.243 264.376);
	--sidebar-primary-foreground : oklch(0.985 0 0);
	--sidebar-accent             : oklch(0.269 0 0);
	--sidebar-accent-foreground  : oklch(0.985 0 0);
	--sidebar-border             : oklch(0.269 0 0);
	--sidebar-ring               : oklch(0.439 0 0);
}

@theme inline {
	--font-sans                        : var(--font-sans);
	--font-mono                        : var(--font-mono);
	--color-background                 : var(--background);
	--color-foreground                 : var(--foreground);
	--color-card                       : var(--card);
	--color-card-foreground            : var(--card-foreground);
	--color-popover                    : var(--popover);
	--color-popover-foreground         : var(--popover-foreground);
	--color-primary                    : var(--primary);
	--color-primary-foreground         : var(--primary-foreground);
	--color-secondary                  : var(--secondary);
	--color-secondary-foreground       : var(--secondary-foreground);
	--color-muted                      : var(--muted);
	--color-muted-foreground           : var(--muted-foreground);
	--color-accent                     : var(--accent);
	--color-accent-foreground          : var(--accent-foreground);
	--color-destructive                : var(--destructive);
	--color-destructive-foreground     : var(--destructive-foreground);
	--color-border                     : var(--border);
	--color-input                      : var(--input);
	--color-ring                       : var(--ring);
	--color-chart-1                    : var(--chart-1);
	--color-chart-2                    : var(--chart-2);
	--color-chart-3                    : var(--chart-3);
	--color-chart-4                    : var(--chart-4);
	--color-chart-5                    : var(--chart-5);
	--radius-sm                        : calc(var(--radius) - 4px);
	--radius-md                        : calc(var(--radius) - 2px);
	--radius-lg                        : var(--radius);
	--radius-xl                        : calc(var(--radius) + 4px);
	--color-sidebar                    : var(--sidebar);
	--color-sidebar-foreground         : var(--sidebar-foreground);
	--color-sidebar-primary            : var(--sidebar-primary);
	--color-sidebar-primary-foreground : var(--sidebar-primary-foreground);
	--color-sidebar-accent             : var(--sidebar-accent);
	--color-sidebar-accent-foreground  : var(--sidebar-accent-foreground);
	--color-sidebar-border             : var(--sidebar-border);
	--color-sidebar-ring               : var(--sidebar-ring);
	--animate-accordion-down           : accordion-down 0.2s ease-out;
	--animate-accordion-up             : accordion-up 0.2s ease-out;

	@keyframes accordion-down {
		from {
			height : 0;
		}
		to {
			height : var(--accordion-content-height);
		}
	}

	@keyframes accordion-up {
		from {
			height : var(--accordion-content-height);
		}
		to {
			height : 0;
		}
	}
}

@layer base {
	* {
		@apply border-border outline-ring/50;
	}

	body {
		@apply bg-background text-foreground;
	}

	button:not(:disabled),
	[role="button"]:not(:disabled) {
		cursor : pointer;
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
- [Card](docs/card.md)
- [Carousel](docs/carousel.md)
- [Checkbox](docs/checkbox.md)
- [Collapsible](docs/collapsible.md)
- [Input](docs/input.md)
- [Label](docs/label.md)
- [Radio Group](docs/radio-group.md)