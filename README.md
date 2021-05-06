# Inclind Panic Button Plugin

`inclind-panic-button` is a WordPress plugin that was developed for niche need of non-profit agencies to have a quick exit button available for special use cases such as information regarding abuse, assault, and more. This allows users to quickly hide what they were looking at even in the event of an internet disconnection or loss of cell service.

**ACF is not required for plugin operation, however it contains default config for frontend users.**

## Installation

For general WordPress installation:

1. Extract the zip release into the `wp-content/plugins/` folder.
2. Upload the release ZIP to the default WordPress plugin installer

## Usage

This plugin will generate a shortcode `[inclind-panic-button]` that can be placed via Elementor or other sources that is available to the frontend users. By default, clicking the button will clear the page, redirect the user, and clean up the browser history as best as possible.

## Configuration

There are a number of arguments that can be passed to the shortcode

### Text

Custom button text can be provided with:
```
[inclind-panic-button text="My Custom Button Text"]
```

### Redirect URL

To give a custom redirect url (default is Google)
```
[inclind-panic-button location="www.example.com"]
```

### Classes

Custom classes can be added:
```
[inclind-panic-button classes="btn btn-large"]
```

### Default Class

By default the button ships with `inclind-panic-button`. To remove that class:
```
[inclind-panic-button default_class="false"]
```