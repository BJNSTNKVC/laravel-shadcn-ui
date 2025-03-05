# Checkbox

## Installation

In order to use the Checkbox component, you need to add the component to your Laravel application using the following
command:

```bash
php artisan shadcn:add Checkbox
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import checkbox from './components/checkbox.js';

Alpine.data('checkbox', checkbox);

Alpine.start();
```

## Usage

### Default

```html
<div class="flex items-center space-x-2">
	<x-checkbox id="terms" />
	<label
	  for="terms"
	  class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
	>
		Accept terms and conditions
	</label>
</div>
```

### With text

```html
<div class="flex items-top space-x-2">
	<x-checkbox id="terms" />
	<div class="grid gap-1.5 leading-none">
		<label
			for="terms"
			class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
		>
			Accept terms and conditions
		</label>
		<p class="text-sm text-muted-foreground">
			You agree to our Terms of Service and Privacy Policy.
		</p>
	</div>
</div>
```

### Disabled

```html
<div class="flex items-center space-x-2">
	<x-checkbox id="terms" disabled />
	<label
	  for="terms"
	  class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70"
	>
		Accept terms and conditions
	</label>
</div>
```
## Props

### Checkbox

Contains all the parts of a checkbox. An input will also render when used within a form to ensure events propagate
correctly.

| Prop       | Description                                                                                           | Type                         | Default   | Options                |
|------------|-------------------------------------------------------------------------------------------------------|------------------------------|-----------|------------------------|
| `theme`    | The style theme of the component.                                                                     | `string`                     | `default` | default <br/> New York |
| `checked`  | The controlled checked state of the checkbox.                                                         | `boolean`\|`'indeterminate'` | `null`    |                        |
| `disabled` | When `true`, prevents the user from interacting with the checkbox.                                    | `bool`                       | `false`   |                        |
| `required` | When `true`, indicates that the user must check the checkbox before the owning form can be submitted. | `bool`                       | `false`   |                        |
| `value`    | The value given as data when submitted with a `name`.                                                 | `string`                     | `on`      |                        |
| `asChild`  | Change the default rendered element for the one passed as a child, merging their props and behavior.  | `bool`                       | `false`   |                        |

### Indicator

Renders when the checkbox is in a checked or indeterminate state.

| Prop       | Description                                                                                          | Type     | Default | Options |
|------------|------------------------------------------------------------------------------------------------------|----------|---------|---------|
| `asChild`  | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false` |         |

## Events

When Checkbox is interacted with, the `check-change` event handler is called. The event handler receives the checked state of the checkbox.

If you are using `Alpine.js`, the handler is attached to the accordion element:

```html
<x-checkbox x-on:check-change="console.log($event.detail.checked)">
	...
</x-checkbox>
```

Alternatively, you can attach the handler to the accordion item using vanilla JS:

```html
<x-checkbox id="checkbox">
	...
</x-checkbox>
```

```js
const checkbox = document.getElementById('checkbox');

checkbox.addEventListener('check-change', (event) => {
	console.log(event.detail.checked);
})
```

## Accessibility

The Checkbox component follows the [WAI-ARIA Design Pattern](https://www.w3.org/TR/wai-aria/#accordion).

### Keyboard Interactions

| Key     | 	Description                  |
|---------|-------------------------------|
| `Space` | Checks/unchecks the checkbox. |