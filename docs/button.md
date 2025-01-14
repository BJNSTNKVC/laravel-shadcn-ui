# Button

## Installation

In order to use the Button component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Button
```

## Usage

```html
<x-button>Button</x-button>
```

## Props

### Button

Contains the content you want to constrain to a button.

| Prop      | Description                                                                                          | Type     | Default   | Options                                                                        |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|--------------------------------------------------------------------------------|
| `theme`   | The style theme of the component                                                                     | `string` | `default` | default <br/> New York                                                         |
| `variant` | The variant of the button.                                                                           | `string` | `default` | default <br/> destructive <br/> outline <br/> secondary <br/> ghost <br/> link |
| `size`    | The size of the button.                                                                              | `string` | `default` | default <br/> sm <br/> lg <br/> icon                                           |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                                                                                |