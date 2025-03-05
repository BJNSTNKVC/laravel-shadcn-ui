# Alert

## Installation

In order to use the Alert component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Alert
```

## Usage

### Default 

```html
<x-alert>
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
	  class="h-4 w-4"
	>
		<polyline points="4 17 10 11 4 5" />
		<line x1="12" x2="20" y1="19" y2="19" />
	</svg>
	<x-alert-title>
		Heads up!
	</x-alert-title>
	<x-alert-description>
		You can add components to your app using the cli.
	</x-alert-description>
</x-alert>
```

### Destructive

```html
<x-alert type="destructive">
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
		class="lucide lucide-circle-alert h-4 w-4"
	>
		<circle cx="12" cy="12" r="10"></circle>
		<line x1="12" x2="12" y1="8" y2="12"></line>
		<line x1="12" x2="12.01" y1="16" y2="16"></line>
	</svg>
	<x-alert-title>
		Error
	</x-alert-title>
	<x-alert-description>
		Your session has expired. Please log in again.
	</x-alert-description>
</x-alert>
```

## Props

### Alert

Contains all the parts of the alert.

| Prop      | Description                                                                                          | Type     | Default   | Options                   |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York    |
| `variant` | The variant of the alert.                                                                            | `string` | `default` | default <br/> destructive |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                           |

### Title

Contains the main heading/title of the alert.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Description

Contains additional details of the alert.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |