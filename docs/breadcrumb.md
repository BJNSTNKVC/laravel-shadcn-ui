# Breadcrumb

## Installation

In order to use the Breadcrumb component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Breadcrumb
```

## Usage

### Default

```html
<x-breadcrumb>
	<x-breadcrumb-list>
		<x-breadcrumb-item>
			<x-breadcrumb-link href="/">Home</x-breadcrumb-link>
		</x-breadcrumb-item>
		<x-breadcrumb-separator />
		<x-breadcrumb-item>
			<x-breadcrumb-link href="/components">Components</x-breadcrumb-link>
		</x-breadcrumb-item>
		<x-breadcrumb-separator />
		<x-breadcrumb-separator />
		<x-breadcrumb-item>
			<x-breadcrumb-page>Breadcrumb</x-breadcrumb-page>
		</x-breadcrumb-item>
	</x-breadcrumb-list>
</x-breadcrumb>
```

### Custom Separator

Use a custom component as children for `<x-breadcrumb-separator />` to create a custom separator.

```html
<x-breadcrumb>
    <x-breadcrumb-list>
        <x-breadcrumb-item>
            <x-breadcrumb-link href="/">Home</x-breadcrumb-link>
        </x-breadcrumb-item>
        <x-breadcrumb-separator>
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
                <path d="M22 2 2 22" />
            </svg>
        </x-breadcrumb-separator>
        <x-breadcrumb-item>
            <x-breadcrumb-link href="/components">Components</x-breadcrumb-link>
        </x-breadcrumb-item>
        <x-breadcrumb-separator>
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
                <path d="M22 2 2 22" />
            </svg>
        </x-breadcrumb-separator>
        <x-breadcrumb-item>
            <x-breadcrumb-page>Breadcrumb</x-breadcrumb-page>
        </x-breadcrumb-item>
    </x-breadcrumb-list>
</x-breadcrumb>
```

### Collapsed

We provide a `<x-breadcrumb-ellipsis />` component to show a collapsed state when the breadcrumb is too long.

```html
<x-breadcrumb>
	<x-breadcrumb-list>
		<x-breadcrumb-item>
			<x-breadcrumb-link href="/">Home</x-breadcrumb-link>
		</x-breadcrumb-item>
		<x-breadcrumb-separator />
		<x-breadcrumb-item>
			<x-breadcrumb-link href="/components">Components</x-breadcrumb-link>
		</x-breadcrumb-item>
		<x-breadcrumb-separator />
		<x-breadcrumb-item>
			<x-breadcrumb-ellipsis />
		</x-breadcrumb-item>
		<x-breadcrumb-separator />
		<x-breadcrumb-item>
			<x-breadcrumb-page>Breadcrumb</x-breadcrumb-page>
		</x-breadcrumb-item>
	</x-breadcrumb-list>
</x-breadcrumb>
```

## Props

### Breadcrumb

Contains all the parts of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                        |

### List

Contains all the items of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Item

Contains a single item of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Link

Contains a single link of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Separator

Contains a single separator of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Ellipsis

Contains a single ellipsis of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Page

Contains a single page of the breadcrumb.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |