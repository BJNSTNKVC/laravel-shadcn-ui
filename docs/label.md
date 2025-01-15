# Label

## Installation

In order to use the Label component, you need to add the component to your Laravel application using the following
command:

```bash
php artisan shadcn:add Label
```

## Usage

```html

<x-label for="email">Your email address</x-label>
```

## Props

### Label

Contains the content you want to constrain to the label.

| Prop      | Description                                                                                          | Type     | Default   | Options                |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`   | The style theme of the component.                                                                    | `string` | `default` | default <br/> New York |
| `for`     | The id of the element the label is associated with.                                                  | `string` | `null`    | default <br/> New York |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                        |

