# WordPress "Read More" Mobile Button Plugin

This plugin will enable a WordPress site to truncate its posts with a "Read More" button in mobile. No shortcodes are used.
It will truncate the *article* tag on a post.

The amount of content that will be visible is determined by the "height of visible content" option. Instead of using pixels, it uses
a multiple of the devices' viewport height. The default value is 2. In this case, if you are using a mobile device with a height of 700px, the button will be 1400px down from the top of the page. If you want the button to be immediately seen at the bottom of the page,
you would set this value to 1.

You can also change the text of the button in the "Read More Button" admin page, which is found in the settings menu.

## Installation
Place the root folder of this repo in the plugins folder of your WordPress installation. The plugin folder must be named `wp-mobile-read-more-button`.

