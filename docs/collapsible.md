# Collapsible

## Installation

In order to use the Collapsible component, you need to add the component to your Laravel application using the following
command:

```bash
php artisan shadcn:add Collapsible
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import collapsible from './components/collapsible.js';

Alpine.data('collapsible', collapsible);

Alpine.start();
```

## Usage

```html
<x-collapsible class="w-[350px] space-y-2">
	<div class="flex items-center justify-between space-x-4">
		<h4 class="text-sm font-semibold">
			@peduarte starred 3 repositories
		</h4>
		<x-collapsible-trigger as-child>
			<x-button variant="ghost" size="sm" className="w-9 p-0">
				<svg
					xmlns="http://www.w3.org/2000/svg"
					width="24"
					height="24"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round"
					class="h-4 w-4 shrink-0 "
				>
					<path d="m7 15 5 5 5-5" />
					<path d="m7 9 5-5 5 5" />
				</svg>
				<span class="sr-only">Toggle</span>
			</x-button>
		</x-collapsible-trigger>
	</div>
	<div class="rounded-md border px-4 py-3 font-mono text-sm">
		@radix-ui/primitives
	</div>
	<x-collapsible-content class="space-y-2">
		<div class="rounded-md border px-4 py-3 font-mono text-sm">
			@radix-ui/colors
		</div>
		<div class="rounded-md border px-4 py-3 font-mono text-sm">
			@stitches/react
		</div>
	</x-collapsible-content>
</x-collapsible>
```
> Note: Example above uses [Button](button.md) component.

## Props

### Collapsible

Contains all the parts of a collapsible.

| Prop       | Description                                                                                          | Type     | Default   | Options                |
|------------|------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`    | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York |
| `open`     | The controlled open state of the collapsible.                                                        | `bool`   | `false`   |                        |
| `disabled` | When `true`, prevents the user from interacting with the accordion and all its items.                | `bool`   | `false`   |                        |
| `asChild`  | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                        |

### Trigger

The button that toggles the collapsible.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Content

The component that contains the collapsible content.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

## Events

When Collapsible Item is expanded or collapsed, the `open-change` event handler is called. The event handler receives the checked state of the collapsible. 

If you are using `Alpine.js`, the handler is attached to the accordion element:

```html
<x-collapsible x-on:open-change="console.log($event.detail.open)">
	...
</x-collapsible>
```

Alternatively, you can attach the handler to the accordion item using vanilla JS:

```html

<x-collapsible id="collapsible">
	...
</x-collapsible>
```

```js
const collapsible = document.getElementById('collapsible');

collapsible.addEventListener('open-change', (event) => {
	console.log(event.detail.open);
})
```

## Accessibility

The Collapsible component follows the [WAI-ARIA Design Pattern](https://www.w3.org/TR/wai-aria/#accordion).

### Keyboard Interactions

| Key           | 	Description                  |
|---------------|-------------------------------|
| `Space`       | Opens/closes the collapsible. |
| `Enter`       | Opens/closes the collapsible. |
