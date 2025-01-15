# Accordion

## Installation

In order to use the Accordion component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Accordion
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import accordion from './components/accordion.js';

Alpine.data('accordion', accordion);

Alpine.start();
```

## Usage

```html
<x-accordion class="w-full">
	<x-accordion-item value="item-1">
		<x-accordion-trigger>
			Is it accessible?
		</x-accordion-trigger>
		<x-accordion-content>
			Yes. It adheres to the WAI-ARIA design pattern.
		</x-accordion-content>
	</x-accordion-item>
	<x-accordion-item value="item-2">
		<x-accordion-trigger>
			Is it styled?
		</x-accordion-trigger>
		<x-accordion-content>
			Yes. It comes with default styles that matches the other components' aesthetic.
		</x-accordion-content>
	</x-accordion-item>
	<x-accordion-item value="item-3">
		<x-accordion-trigger>
			<div>Is it animated?</div>
		</x-accordion-trigger>
		<x-accordion-content>
			Yes. It's animated by default, but you can disable it if you prefer.
		</x-accordion-content>
	</x-accordion-item>
</x-accordion>
```

## Props

### Accordion

Contains all the parts of an accordion.

| Prop          | Description                                                                                                   | Type                      | Default    | Options                   |
|---------------|---------------------------------------------------------------------------------------------------------------|---------------------------|------------|---------------------------|
| `theme`       | The style theme of the component.                                                                             | `string`                  | `default`  | default <br/> New York    |
| `type`        | Determines whether one or multiple items can be opened at the same time.                                      | `string`                  | `single`   | single <br/> multiple     |
| `value`       | The value of the item to expand when initially rendered.                                                      | `string`\|`array`\|`null` | `null`     |                           |
| `collapsible` | When type is `single`, allows closing content when clicking trigger for an open item.                         | `bool`                    | `false`    |                           |
| `disabled`    | When `true`, prevents the user from interacting with the accordion and all its items.                         | `bool`                    | `false`    |                           |
| `direction`   | The reading direction of the accordion when applicable. If omitted, assumes LTR (left-to-right) reading mode. | `string`                  | `ltr`      | ltr <br/> rtl             |
| `orientation` | The orientation of the accordion.                                                                             | `string`                  | `vertical` | vertical <br/> horizontal |
| `asChild`     | Change the default rendered element for the one passed as a child, merging their props and behavior.          | `bool`                    | `false`    |                           |

### Item

Contains all the parts of a collapsible section.

| Prop       | Description                                                                                          | Type     | Default | Options |
|------------|------------------------------------------------------------------------------------------------------|----------|---------|---------|
| `value`    | The value of the item to expand when initially rendered.                                             | `string` | `null`  |         |
| `disabled` | When `true`, prevents the user from interacting with the accordion item.                             | `bool`   | `false` |         |
| `asChild`  | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false` |         |

### Trigger

Toggles the collapsed state of its associated item.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Content

Contains the collapsible content for an item.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

## Events

When Accordion Item is expanded or collapsed, the `value-change` event handler is called. The event handler receives the value/values of the expanded item.

If you are using `Alpine.js`, the handler is attached to the accordion element:

```html
<x-accordion x-on:value-change="console.log($event.detail.value)">
    ...
</x-accordion>
```

Alternatively, you can attach the handler to the accordion item using vanilla JS:

```html
<x-accordion id="accordion">
    ...
</x-accordion>
```

```js
const accordion = document.getElementById('accordion');

accordion.addEventListener('value-change', (event) => {
    console.log(event.detail.value);
})
```

## Accessibility

The Accordion component follows the [WAI-ARIA Design Pattern](https://www.w3.org/TR/wai-aria/#accordion).

### Keyboard Interactions

| Key           | 	Description                                                                       |
|---------------|------------------------------------------------------------------------------------|
| `Space`       | When focus is on an Accordion Trigger of a collapsed section, expands the section. |
| `Enter`       | When focus is on an Accordion Trigger of a collapsed section, expands the section. |
| `Tab`         | Moves focus to the next focusable element.                                         |
| `Shift + Tab` | Moves focus to the previous focusable element.                                     |
| `Arrow Down`  | Moves focus to the next Accordion Trigger when orientation is vertical.            |
| `Arrow Up`    | Moves focus to the previous Accordion Trigger when orientation is vertical.        |
| `Arrow Right` | Moves focus to the next Accordion Trigger when orientation is horizontal.          |
| `Arrow Left`  | Moves focus to the previous Accordion Trigger when orientation is horizontal.      |
| `Home`        | When focus is on an Accordion Trigger, moves focus to the first Accordion Trigger. |
| `End`         | When focus is on an Accordion Trigger, moves focus to the last Accordion Trigger.  |