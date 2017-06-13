
CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Use Cases
 * Features
 * Usage Examples
 * Requirements
 * Installation
 * Similar Modules
 * Notes


INTRODUCTION
------------

The Menu filter module is an input filter that allows menu links to be inserted
into text as a list or dropdown.

The Menu filter module is designed to give content editors the ability to
implement custom menus within any text in situations where the default menu
system and/or menu blocks doesn't work.

This module also includes a Ctools content-type for Panels that allows users to
insert custom menus within a Panel display.

There are plenty of menu related modules for Drupal and this module is just a
very simple approach to displaying menus on a website.

Supported formats include:
- Tree (hierachical list)
- Link title and descriptions (list)
- Link title (list)
- Dropdown (Ctools jumpmenu support optional)
- Teasers


USE CASES
---------

- Building a multi-column super-footer or mega menu that is just repeating menu
  links from different sections of a website.

- Adding a node's lower level menu items title and description below the node's
  body content.

- Adding a dropdown (jump-menu) to a panel display.


FEATURES
--------

- Support for Ctools jump menu.

- Includes Ctools content-type for displaying menu links within a Panel page.

- Easy to style and override theme functions


USAGE EXAMPLES
--------------

<h3>Tree</h3>
<p>[menu-tree:menu_name=main-menu]</p>

<h3>Links</h3>
<p>[menu-links:menu_name=main-menu]</p>

<h3>Descriptions</h3>
<p>[menu-descriptions:menu_name=main-menu]</p>

<h3>Dropdown</h3>
<p>[menu-dropdown:menu_name=main-menu]</p>

<h3>Teasers</h3>
<p>[menu-teasers:menu_name=main-menu]</p>


REQUIREMENTS
------------

[Recommended]

- Chaos tool suite (ctools): A library of helpful tools by Merlin of Chaos.
  http://drupal.org/project/ctools

- Panels: Allows a site administrator to create customized layouts for multiple uses
  http://drupal.org/project/panels


INSTALLATION
------------

1. Copy/upload the menu_filter.module to the sites/all/modules directory
   of your Drupal installation.

2. Enable the 'Menu filter' module in 'Modules' (admin/modules).

3. Visit the 'Configuration > [Content authoring] Text formats'
   (admin/config/content/formats). Click "configure" next to the input format you want
   to enable the Menu filter.

4. Enable (check) the 'Inline menus' under the list of filters and save
   the configuration.

5. (optional) Visit the 'Configuration > [Content authoring] Menu filter'
   (admin/settings/menu_filter).


SIMILAR MODULES
---------------

- Menu Block: Provides configurable blocks of menu items. [RECOMMENDED]
  http://drupal.org/project/menu_block

- Submenu Tree: For nodes which are menu items, this module adds a listing of
  any submenu items below it.
  http://drupal.org/project/submenutree


NOTES
-----

- Only menu links visible to anonymous users will be rendered because this
  filter's output is cached and visible to all users. Ofcourse this filter's
  output could not be cached which would result in a major performance hit.

- A reasonable attempt is made to clear the filter cache when a menu item is
  created, updated, or deleted but admins may have to "clear the cache" if major
  changes are made to a web-site's menu.

- This module could be merged with another menu module that provides similar
  functionality but does not include input filter integration.


AUTHOR/MAINTAINER
-----------------

- Jacob Rockowitz
  http://drupal.org/user/371407
