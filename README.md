# Zero Function Plugin for the glFusion CMS
Version: 1.1.0

## Overview
Every good plugin deserves a README page!  Here is where you can communicate
basic (and perhaps critically needed) information to the system administrator
that is attempting to install your plugin.

This plugin adds, just as the name implies, zero function to your glFusion
CMS, however it is provided as a heavily-commented 'skeleton' upon which you
can build a plugin for your glFusion CMS

The zero plugin example code was based upon code taken from several glFusion
core plugins which are maintained by Mark R. Evans.  My thanks to Mark and his
extended team for all of the great suport they have lent to me and other users
of the glFusion CMS.


# How to Use
This plugin will install as-is, however it won't do much of anything. To
customize this plugin for your own use, extract it, and then start by copying
the 'zero' plugin directory to a directory name that is appropriate for your
plugin.

Carefully browse all of the files provided to see how things work. I also
recommend that you browse the glFusion development documentation, and also
become familiar with the glFusion plugin API.

Let's say you're building a plugin to manage recipes, and let's call it the
'Recipe Manager' plugin. You will have to begin by looking for the following
strings, which of course have to be edited appropriately:
* `zero` - the base name of the plugin, edit to: 'recipe'
* `ZZ` - var/function name 'tag', edit to: 'RM'

Now rename the following files (as a minimum):
* `/zero.php` => `/recipe.php`

Now start editing all of the files as needed for your plugin. After you're
done, you *should* be able to install the plugin by zipping the files up into a
.zip file (preserve relative directory names of course), and then using the
glFusion plugin upload/auto-install function.

Having trouble? Take a look at error.log to see what's going on.

Good luck!


## System Requirements
The Zero plugin has the following system requirements:
* PHP 7.4.0 and higher.
* glFusion v2.0.0 or newer


## Installation
The Zero Plugin uses the glFusion automated plugin installer.
Simply upload the distribution using the glFusion plugin installer located in
the Plugin Administration page.


## Upgrading
The upgrade process is identical to the installation process, simply upload
the distribution from the Plugin Administration page.

## Configuration
The Zero Function plugin utilizes the glFusion configuration subsystem.  The
configurable values have, like the plugin, no actual meaning but are provided
as an example

<dl>
<dt>Widgets Per Page</dt>
<dd>Set this to the number of widgets to display per page in the widget list.</dd>
<dt>Gadgets Per Page?</dt>
<dd>Set this to the number of gadgets to display per page in the widget list.</dd>
</dl>
These values are displayed when you retrieve the 'public' plugin page.

# Usage
Well, since the Zero Plugin provides no function, there is no usage information,
but this is where you'd put it.

## Access Control
During installation the Zero plugin creates new Features for admin and user access
and maps them to the Root and Logged-In Users groups respectively.

To change user access, use the Features or Groups console in Command and Control
and remove these feature mappings, and add mappings to other groups as needed.

## License
This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 2 of the License, or (at your option) any later
version.
