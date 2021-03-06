## Zero Function Plugin for the glFusion CMS



### OVERVIEW

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


### HOW TO USE

This plugin will install as-is, however it won't do much of anything.  To
customize this plugin for your own use, extract it, and then start by copying
the 'zero' plugin directory to a directory name that is appropriate for your
plugin.

Carefully browse all of the files provided to see how things work.  I also
recommend that you browse the glFusion development documentation, and also
become familiar with the glFusion plugin API.

Let's say you're building a plugin to manage recipes, and let's call it the
'Recipe Manager' plugin.  You will have to begin by looking for the following
strings, which of course have to be edited appropriately:

'zero'  the base name of the plugin  edit to: 'recipe'
'ZZ'    var/function name 'tag'      edit to: 'RM'

Now rename the following files (as a minimum):

/zero.php              =>  /recipe.php
/include/lib-zero.php  =>  /include/lib-recipe.php

Now start editing all of the files as needed for your plugin.  After you're
done, you *should* be able to install the plugin by zipping the files up into a
.zip file (preserve relative directory names of course), and then using the
glFusion plugin upload/auto-install function.

Having trouble?  Take a look at error.log to see what's going on.

Good luck!


### SYSTEM REQUIREMENTS

The Zero plugin has the following system requirements:

* PHP 4.3.3 and higher.
* MySQL v3.23 or newer
* glFusion v1.1.5 or newer


### INSTALLATION

The Zero Plugin uses the glFusion automated plugin installer.
Simply upload the distribution using the glFusion plugin installer located in
the Plugin Administration page.


### UPGRADING

The upgrade process is identical to the installation process, simply upload
the distribution from the Plugin Administration page.

### CONFIGURATION SETTINGS

The Zero Function plugin utilizes the glFusion configuration subsystem.  The
configurable values have, like the plugin, no actual meaning but are provided
as an example

Widgets Per Page?

    Set this to the number of widgets to display per page in the widget list.

Gadgets Per Page?

    Set this to the number of gadgets to display per page in the widget list.

These values are displayed when you retrieve the 'public' plugin page.


### USAGE

Well, since the Zero Plugin provides no function, there is no usage information,
but this is where you'd put it.


### RESTRICTING ACCESS TO THE ZERO PLUGIN

During the installation of the Zero plugin, a glFusion group called 'Zero Users'
is created.  The existing glFusion group 'Logged in Users' is automatically
added to the Zero Users group, allowing all logged in site members access to
the Zero plugin.

If you would like to restrict the use of the Zero plugin to a sub-set of your
users, you will need to remove the 'Logged In Users' group from the Zero Users
group.  This can be done in the glFusion Group Administration screen.

You will now need to add user individually to the Zero Users group, or add
another group on your site to the Zero Users group to grant the subset of users
access to the Zero plugin.


### LICENSE

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 2 of the License, or (at your option) any later
version.
