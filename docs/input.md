# Input

## Installation

In order to use the Input component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Input
```

## Usage

### Default

```html
<x-input type="email" placeholder="Email" /> 
```

### File

```html
<div class="grid w-full max-w-sm items-center gap-1.5">
	<x-label for="picture">Picture</x-label>
	<x-input id="picture" type="file" />
</div>
```
> Note: Example above uses [Label](label.md) component.

### Disabled

```html
<x-input type="email" placeholder="Email" disabled />
```

### With Button

```html
<div class="flex w-full max-w-sm items-center space-x-2">
	<x-input type="email" placeholder="Email" />
	<x-button type="submit">Subscribe</x-button>
</div>
```
> Note: Example above uses [Button](button.md) component.



## Props

### Input

Contains the content you want to constrain to an input.

| Prop    | Description                       | Type     | Default   | Options                |
|---------|-----------------------------------|----------|-----------|------------------------|
| `theme` | The style theme of the component. | `string` | `default` | default <br/> New York |
