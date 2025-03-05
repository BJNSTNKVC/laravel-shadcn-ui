# Button

## Installation

In order to use the Button component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Button
```

## Usage

### Default

```html
<x-button>Button</x-button>
```

### Secondary

```html
<x-button variant="secondary">Secondary</x-button>
```

### Destructive

```html 
<x-button variant="destructive">Destructive</x-button>
```

### Outline

```html
<x-button variant="outline">Outline</x-button>
```

### Ghost

```html
<x-button variant="ghost">Ghost</x-button>
```

### Link

```html
<x-button variant="link">Link</x-button>
```

### Icon

```html
<x-button variant="outline" size="icon">
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
	>
		<path d="m9 18 6-6-6-6" />
	</svg>
</x-button>
```

### With Icon

```html
<x-button>
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
	>
		<rect width="20" height="16" x="2" y="4" rx="2" />
		<path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
	</svg>
	Login with Email
</x-button>
```

### Loading

```html
<x-button disabled>
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
		class="animate-spin"
	>
		<path d="M21 12a9 9 0 1 1-6.219-8.56" />
	</svg>
	Please wait
</x-button>
```

## Props

### Button

Contains the content you want to constrain to a button.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                                        |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|--------------------------------------------------------------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York                                                         |
| `variant` | The variant of the button.                                                                           | `string` | `default` | default <br/> destructive <br/> outline <br/> secondary <br/> ghost <br/> link |
| `size`    | The size of the button.                                                                              | `string` | `default` | default <br/> sm <br/> lg <br/> icon                                           |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                                                |