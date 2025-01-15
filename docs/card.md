# Card

## Installation

In order to use the Card component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Card
```

## Usage

```html
<x-card>
	<x-card-header>
		<x-card-title>Card Title</x-card-title>
		<x-card-description>Card Description</x-card-description>
	</x-card-header>
	<x-card-content>
		<p>Card Content</p>
	</x-card-content>
	<x-card-footer>
		<p>Card Footer</p>
	</x-card-footer>
</x-card>
```

## Props

### Card

Contains all the parts of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                        |

### Header

Contains the header of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Title

Contains the title of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Description

Contains the description of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Content

Contains the content of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |

### Footer

Contains the footer of the card.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |
