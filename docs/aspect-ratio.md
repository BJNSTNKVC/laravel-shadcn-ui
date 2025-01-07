# Aspect Ratio

## Installation

In order to use the Aspect Ratio component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add AspectRatio
```

## Usage

```html
<x-aspect-ratio :ratio="16 / 9">
	<img
	  class="size-full object-cover"
	  src="https://images.unsplash.com/photo-1535025183041-0991a977e25b?w=300&dpr=2&q=80"
	  alt="Landscape photograph by Tobias Tullius"
	/>
</x-aspect-ratio>
```

## Props

### AspectRatio

Contains the content you want to constrain to a given ratio.

| Prop      | Description                                                                                          | Type            | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|-----------------|---------|---------|
| `ratio`   | The desired ratio.                                                                                   | `int` / `float` | `1`     |         |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`          | `false` |         |