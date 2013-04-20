=== Prestasho Saiyandev Widget ===
Contributors: jotraverso
Donate link: http://saiyandev.com/about/
Tags: Prestashop, REST, widget, eCommerce, slider, jcarrousell, jquery
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 0.1
License: GPL v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.txt

Provide a sidebar widget for getting content from Prestashop via the REST API, and show it with jcarrousell.

== Description ==

Provide a sidebar widget for getting content from Prestashop via the REST API and show it with jcarrousell lite.

== Installation ==

This plugin can be installed directly from your site.

1. Log in and navigate to Plugins → Add New.
2. Type "Prestashop Saiyandev Widget" into the Search input and click the "Search Widgets" button.
3. Locate the Prestashop Saiyandev Widget in the list of search results and click "Install Now".
4. Click the "Activate Plugin" link at the bottom of the install screen.
5. Navigate to Appearance → Widgets and [create a new instance](http://codex.wordpress.org/WordPress_Widgets#Activate_Widgets).

It can also be installed manually.

1. [Download](http://wordpress.org/extend/plugins/prestashop-saiyandev-widget/) the plugin from WordPress.org.
2. Unzip the package and move to your plugins directory.
3. Log into WordPress and navigate to the "Plugins" screen.
4. Locate "Prestashop Saiyandev Widget" in the list and click the "Activate" link.
5. Navigate to Appearance → Widgets and [create a new instance](http://codex.wordpress.org/WordPress_Widgets#Activate_Widgets).

== Frequently asked questions ==

= What does this widget? =

This widget takes a Prestashop REST query to make a HTTP request to Prestashop obtaining product information to at the sidebar.

== Screenshots ==

1. [Sample config](http://saiyandev.files.wordpress.com/2013/04/screenshot_1.jpg?w=302)

== Changelog ==

v 0.1 First Release

== Upgrade notice ==



== Configuration ==

The widget need a few integration and behavioural parameters:

1. Prestashop's web service authorization key. It should be generated from Prestashop's admin site.
2. REST query for products. The widget expects a full view result, so the query must include "display=full" parameter.
3. Prestashop base URL. The Prestashop location URL (without the last bar '/'), it's used when the widget build prestashop's links.
4. JCarrousell Lite easing effect. Labeled with "Efecto de transición (easing)", choose from a value from the dropdown menu.
5. JCarrousell Auto. Labeled with "Pausa (milisegundos)", milliseconds to keep every product.
6. JCarrousell Speed. Labeled with "Velocidad (milisegundos), Number of milliseconds, speed for the transition.