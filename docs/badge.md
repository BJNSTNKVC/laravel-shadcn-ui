# Aspect Ratio

## Installation

In order to use the Badge component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Badge
```

## Usage

### Default

```html
<x-badge>Badge</x-badge>
```

### Secondary

```html
<x-badge variant="secondary">Secondary</x-badge>
```

### Outline

```html
<x-badge variant="outline">Outline</x-badge>
```

### Destructive

```html
<x-badge variant="destructive">Destructive</x-badge>
```

## Props

### Badge

Contains the content you want to constrain to a badge.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                 |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|---------------------------------------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York                                  |
| `variant` | The variant of the badge.                                                                            | `string` | `default` | default <br/> destructive <br/> outline <br/> secondary |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                         |