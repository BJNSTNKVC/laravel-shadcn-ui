# Radio Group

## Installation

In order to use the Radio Group component, you need to add the component to your Laravel application using the following
command:

```bash
php artisan shadcn:add RadioGroup
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import radiogroup from './components/radio-group.js';

Alpine.data('radiogroup', radiogroup);

Alpine.start();
```

## Usage

```html

<x-radio-group value="comfortable">
	<div class="flex items-center space-x-2">
		<x-radio-group-item value="default" id="r1" />
		<x-label for="r1">Default</x-label>
	</div>
	<div class="flex items-center space-x-2">
		<x-radio-group-item value="comfortable" id="r2" />
		<x-label for="r2">Comfortable</x-label>
	</div>
	<div class="flex items-center space-x-2">
		<x-radio-group-item value="compact" id="r3" />
		<x-label for="r3">Compact</x-label>
	</div>
</x-radio-group>
```

## Props

### Radio Group

Contains all the parts of a radio group.

| Prop          | Description                                                                                           | Type     | Default   | Options                |
|---------------|-------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`       | The style theme of the component.                                                                     | `string` | `default` | default <br/> New York |
| `disabled`    | When `true`, prevents the user from interacting with the radio items.                                 | `bool`   | `false`   |                        |
| `required`    | When `true`, indicates that the user must check a radio item before the owning form can be submitted. | `bool`   | `false`   |                        |
| `value`       | The controlled value of the radio item to check.                                                      | `string` | `on`      |                        |
| `orientation` | The orientation of the component.                                                                     | `string` | `on`      |                        |
| `direction`   | The reading direction of the radio group. If omitted, assumes LTR (left-to-right) reading mode.       | `string` | `on`      |                        |
| `loop`        | When `true`, keyboard navigation will loop from last item to first, and vice versa.                   | `string` | `on`      |                        |
| `asChild`     | Change the default rendered element for the one passed as a child, merging their props and behavior.  | `bool`   | `false`   |                        |

### Item

An item in the group that can be checked. An input will also render when used within a form to ensure events propagate
correctly.

| Prop       | Description                                                                                             | Type               | Default | Options |
|------------|---------------------------------------------------------------------------------------------------------|--------------------|---------|---------|
| `disabled` | When `true`, prevents the user from interacting with the radio item.                                    | `bool`             | `false` |         |
| `required` | When `true`, indicates that the user must check the radio item before the owning form can be submitted. | `bool`             | `false` |         |
| `value`    | The value given as data when submitted with a `name`.                                                   | `null` \| `string` | `null`  |         |
| `asChild`  | Change the default rendered element for the one passed as a child, merging their props and behavior.    | `bool`             | `false` |         |

### Indicator

Renders when the radio item is in a checked state. You can style this element directly, or you can use it as a wrapper
to put an icon into, or both.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

## Events

When Radio Group is interacted with, the `value-change` event handler is called. The event handler receives the checked
state of the checkbox.

If you are using `Alpine.js`, the handler is attached to the accordion element:

```html

<x-radio-group x-on:value-change="console.log($event.detail.checked)">
	...
</x-radio-group>
```

Alternatively, you can attach the handler to the accordion item using vanilla JS:

```html

<x-radio-group id="group">
	...
</x-radio-group>
```

```js
const group = document.getElementById('group');

group.addEventListener('value-change', (event) => {
	console.log(event.detail.value);
})
```

## Accessibility

The Radio Group component follows the [WAI-ARIA Design Pattern](https://www.w3.org/TR/wai-aria/#accordion) and uses [roving tabindex](https://www.w3.org/WAI/ARIA/apg/patterns/radio/examples/radio/) to manage focus movement among radio items.

### Keyboard Interactions

| Key           | 	Description                                                                       |
|---------------|------------------------------------------------------------------------------------|
| `Tab`         | Moves focus to either the checked radio item or the first radio item in the group. |
| `Space`       | When focus is on an unchecked radio item, checks it.                               |
| `Arrow Down`  | Moves focus and checks the next radio item in the group.                           |
| `Arrow Right` | Moves focus and checks the next radio item in the group.                           |
| `Arrow Up`    | Moves focus to the previous radio item in the group.                               |
| `Arrow Left`  | Moves focus to the previous radio item in the group.                               |
