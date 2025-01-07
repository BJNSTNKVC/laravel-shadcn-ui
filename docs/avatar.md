# Avatar

## Installation

In order to use the Avatar component, you need to add the component to your Laravel application using the following command:

```bash
php artisan shadcn:add Avatar
```

Once the component is added, you should register the Alpine.js data in your `resources/js/app.js` file:

```js
import Alpine from 'alpinejs';
import avatar from './components/avatar.js';

Alpine.data('avatar', avatar);

Alpine.start();
```

## Usage

```html
<x-avatar>
	<x-avatar-image src="https://github.com/shadcn.png" alt="@shadcn" />
	<x-avatar-fallback>CN</x-avatar-fallback>
</x-avatar>
```

## Props

### Avatar

Contains all the parts of an avatar.

| Prop      | Description                                                                                          | Type     | Default   | Options                |
|-----------|------------------------------------------------------------------------------------------------------|----------|-----------|------------------------|
| `theme`   | The style theme of the component                                                                     | `string` | `default` | default <br/> New York |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool`   | `false`   |                        |

### Image

The image to render. By default, it will only render when it has loaded.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

### Fallback

An element that renders when the image hasn't loaded. This means whilst it's loading, or if there was an error. If you
notice a flash during loading, you can provide a `delay` prop to delay its rendering so it only renders for those with
slower connections.

| Prop      | Description                                                                                          | Type   | Default | Options |
|-----------|------------------------------------------------------------------------------------------------------|--------|---------|---------|
| `delay`   | Change                                                                                               | `int`  | `0`     |         |
| `asChild` | Change the default rendered element for the one passed as a child, merging their props and behavior. | `bool` | `false` |         |

## Events

When Avatar Image is loaded, the `loading-status-change` event handler is called, providing information about the loading status of the image. This is useful in case you want to control more precisely what to render as the image is loading.

If you are using `Alpine.js`, the handler is attached to the accordion element:

```html
<x-avatar>
	<x-avatar-image src="https://github.com/shadcn.png" alt="@shadcn" x-on:loading-status-change="console.log($event.detail.status)" />
	<x-avatar-fallback>CN</x-avatar-fallback>
</x-avatar>
```

Alternatively, you can attach the handler to the accordion item using vanilla JS:

```html
<x-avatar>
	<x-avatar-image id="image" src="https://github.com/shadcn.png" alt="@shadcn" />
	<x-avatar-fallback>CN</x-avatar-fallback>
</x-avatar>
```

```js
const image = document.getElementById('image');

image.addEventListener('loading-status-change', (event) => {
	console.log(event.detail.status);
})
```