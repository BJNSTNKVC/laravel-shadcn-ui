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

### Default

```html
<x-carousel class="w-full max-w-xs">
	<x-carousel-content>
		@for ($i = 0; $i < 5; $i++)
		<x-carousel-item>
			<x-card>
				<x-card-content class="flex aspect-square items-center justify-center !p-6">
					<span class="text-4xl font-semibold">{{ $i + 1 }}</span>
				</x-card-content>
			</x-card>
		</x-carousel-item>
		@endfor
	</x-carousel-content>
	<x-carousel-previous />
	<x-carousel-next />
</x-carousel>
```
> Note: Example above uses [Card](card.md) component.

### Sizes

To set the size of the items, you can use the basis utility class on the `<x-carousel-item />`.

```html
<x-carousel :options="['align' => 'start']" class="w-full max-w-xs">
	<x-carousel-content>
		@for ($i = 0; $i < 5; $i++)
		<x-carousel-item class="md:basis-1/2 lg:basis-1/3">
			<x-card>
				<x-card-content class="flex aspect-square items-center justify-center !p-6">
					<span class="text-4xl font-semibold">{{ $i + 1 }}</span>
				</x-card-content>
			</x-card>
		</x-carousel-item>
		@endfor
	</x-carousel-content>
	<x-carousel-previous />
	<x-carousel-next />
</x-carousel>
```
> Note: Example above uses [Card](card.md) component.

### Orientation

Use the orientation prop to set the orientation of the carousel.

```html
<x-carousel :options="['align' => 'start']" orientation="vertical" class="w-full max-w-xs">
	<x-carousel-content class="-mt-1 h-[200px]">
		@for ($i = 0; $i < 5; $i++)
		<x-carousel-item class="pt-1 md:basis-1/2">
			<x-card>
				<x-card-content class="flex items-center justify-center !p-6">
					<span class="text-3xl font-semibold">{{ $i + 1 }}</span>
				</x-card-content>
			</x-card>
		</x-carousel-item>
		@endfor
	</x-carousel-content>
	<x-carousel-previous />
	<x-carousel-next />
</x-carousel>
```
> Note: Example above uses [Card](card.md) component.

### API

Use [x-init](https://alpinejs.dev/directives/init) and `$api` to get an instance of the carousel API.

```html
<x-carousel
	class="w-full max-w-xs"
	x-init="
        $props.current = $api.selectedScrollSnap() + 1;
        $props.count = 5;
        $api.on('select', (api) => $props.current = api.selectedScrollSnap() + 1})
    "
>
	<x-carousel-content>
		@for ($i = 0; $i < 5; $i++)
		<x-carousel-item>
			<x-card>
				<x-card-content class="flex aspect-square items-center justify-center !p-6">
					<span class="text-4xl font-semibold">{{ $i + 1 }}</span>
				</x-card-content>
			</x-card>
		</x-carousel-item>
		@endfor
	</x-carousel-content>
	<x-carousel-previous />
	<x-carousel-next />
	<div class="py-2 text-center text-sm text-muted-foreground" x-text="`Slide ${$props.current} of ${$props.count}`" />
</x-carousel>
```
> Note: Example above uses [Card](card.md) component.

### Plugins

You can use the `plugins` prop to add plugins to the carousel.

```html
<x-carousel class="w-full max-w-xs" :plugins="['autoplay' => ['delay' => 3000]]">
    <x-carousel-content>
        @for ($i = 0; $i < 5; $i++)
            <x-carousel-item>
                <x-card>
                    <x-card-content class="flex aspect-square items-center justify-center !p-6">
                        <span class="text-4xl font-semibold">{{ $i + 1 }}</span>
                    </x-card-content>
                </x-card>
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
