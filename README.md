# Social Media Platforms module

Provides a block that allows to display a set of links to several social
network profiles.

This module differs from Social Media Links Block and Field in the fact
that the social network configuration does not live in the block, but in a
separate settings form.

This module works nicely with Domain submodule Domain Config, which allows 
to override the configuration forms for each individual domain and language, 
and then, place a single block for all the domains.

## Table of contents

- Requirements
- Recommended modules
- Installation
- Configuration
- Maintainers

## Requirements

This module requires the block core module.

## Recommended modules

This module is recommended to be used in combination with domain_config
submodule from domain.

## Features 

+ Configurable social media platforms order
+ Customize the label names
+ Configure the display ( icons, label, icons + label )
+ Add your own icons via preprocess hook in the theme
+ If using domain and domain_config, configure different social media platforms for each one, with one single block.

## Supported social media platforms

+ Facebook
+ Youtube
+ LinkedIn
+ X ( Twitter )
+ Instagram
+ Pinterest
+ TikTok
+ Bluesky
+ Threads

## Icons

The default module icons can be easily overridden implementing a preprocess function for the 'social_media_platform_links' theme element.

The module contains a css library social_media_platforms.theme, which can be overridden in the theme.

## Installation

Install as you would normally install a contributed Drupal module.
For further information, see [Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).

## Configuration

The module configuration is available under
'admin/config/services/social-media-platforms' path.

## Maintainers

- [Guiu Rocafort Ferrer] - [guiu.rocafort.ferrer](https://www.drupal.org/u/guiu.rocafort.ferrer)
- [Ekaterina Shoshina] - [shoshina.ekaterina](https://www.drupal.org/u/shoshinaekaterina)
