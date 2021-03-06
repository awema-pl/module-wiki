# Slide-up-down

This component is intended for the animated appearance/disappearance of the component content. Below you will see a visual presentation of such component.

![slide-up-down](/assets/awema-pl/wiki/img/docs/slide-up-down.gif)

## Components
- [Blade Components](./components.md)
- [Frame Navigation](./frame-nav.md)
- [Grid](./grid.md)
- [Content](./classes.md)
- **Slide Up Down**
- [Margins and paddings](./margins.md)
- [Icons](./icons.md)


## Example of use

```html
<button class="btn" @click="$refs.slide.toggle()">Toggle</button>

<slide-up-down ref="slide">
    <p>Text inside slide-up-down</p>
    <p>One more paragraph</p>
</slide-up-down>
```

<div class="vue-example">
<button class="btn" @click="$refs.slide.toggle()">Toggle</button>
<slide-up-down ref="slide">
    <p>Text inside slide-up-down</p>
    <p>One more paragraph</p>
</slide-up-down>
</div>


## Input parameters

| Name                  | Type        | Default      | Description                                   |
|-----------------------|:-----------:| -------------|-----------------------------------------------|
| `show`                | **Boolean** | `false`      | Show/hide content                             |
| `tag`                 | **String**  | `'div'`      | Tag for the template wrapper                  |
| `slide-up-duration`   | **Number**  | `250`        | **Closing** time in milliseconds             |
| `slide-down-duration` | **Number**  | `300`        | **Opening** time in milliseconds             |


## Component methods

All methods are called without parameters.

| Name     | Description                   |
|----------|-------------------------------|
| `open`   | Show content                  |
| `close`  | Hide content                  |
| `toggle` | Switch current state          |
