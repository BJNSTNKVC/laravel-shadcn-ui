# Carousel

## Installation

In order to use the Carousel component, you need to add the component to your Laravel application using the following
command:

```bash
php artisan shadcn:add Carousel
```

The Carousel component is built using the [Embla Carousel](https://embla-carousel.com/) library. To use it, run the
following command:

```bash
npm install embla-carousel --save
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import carousel from './components/carousel.js';

Alpine.data('carousel', carousel);

Alpine.start();
```

## Usage

```html
<x-carousel class="w-full max-w-xs">
	<x-carousel-content>
		@for ($i = 0; $i < 5; $i++)
		<x-carousel-item>
			<div class="p-1">
				<div class="rounded-xl border bg-card text-card-foreground shadow">
					<div class="flex aspect-square items-center justify-center p-6">
						<span class="text-4xl font-semibold">{{ $i + 1 }}</span>
					</div>
				</div>
			</div>
		</x-carousel-item>
		@endfor
	</x-carousel-content>
	<x-carousel-previous />
	<x-carousel-next />
</x-carousel>
```

## Props

### Carousel

Contains all the parts of a carousel.

| Prop          | Description                                                                                                               | Type     | Default      | Options                   |
|---------------|---------------------------------------------------------------------------------------------------------------------------|----------|--------------|---------------------------|
| `theme`       | The style theme of the component.                                                                                         | `string` | `default`    | default <br/> New York    |
| `orientation` | The orientation of the carousel.                                                                                          | `string` | `horizontal` | horizontal <br/> vertical |
| `options`     | The options of the carousel. List of all options can be found [here](https://www.embla-carousel.com/api/options/).        | `array`  | `[]`         |                           |
| `plugins`     | The plugins of the carousel. Currently only supports [Autoplay](https://www.embla-carousel.com/plugins/autoplay/) plugin. | `array`  | `[]`         |                           |
| `asChild`     | Change the default rendered element for the one passed as a child, merging their props and behavior.                      | `bool`   | `false`      |                           |

### Content

The component that contains the carousel content.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Item

The component that contains the carousel item.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Next / Previous

The component that contains the next / previous buttons.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

## Accessibility

The Carousel component follows the [WAI-ARIA Design Pattern](https://www.w3.org/TR/wai-aria/#accordion).

### Keyboard Interactions

| Key           | 	Description                            |
|---------------|-----------------------------------------|
| `Arrow Right` | Move the carousel to the next item.     |
| `Arrow Left`  | Move the carousel to the previous item. |

> **Note:** The focus has to be on Carousel buttons to interact with the carousel.
