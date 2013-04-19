Prestashop Saiyandev Widget
===========================
Contributors: Jorge Ortega Traverso
Contributor link: http://saiyandev.com
Tags: prestashop, ecommerce, REST, widget
Requires at least: don't know
Tested with to: 3.5
Version: 0.1 - 2013-04-19
License: GPL v3.0

Widget para la barra lateral que obtiene contenido de Prestashop mediante la API REST presentándolo con jcarrousell.
Probado con Prestashop 1.5
Provide a sidebar widget for getting content from Prestashop via the REST API, and show it with jcarrousell.
Teste with Prestashop 1.5

== Description ==
Provide a sidebar widget for getting content from Prestashop via the REST API and show it with jcarrousell lite.

== Installation ==

This plugin can be installed directly from your site.

1. Log in and navigate to Plugins &rarr; Add New.
2. Type "Prestashop Saiyandev Widget" into the Search input and click the "Search Widgets" button.
3. Locate the Prestashop Saiyandev Widget in the list of search results and click "Install Now".
4. Click the "Activate Plugin" link at the bottom of the install screen.
5. Navigate to Appearance &rarr; Widgets and [create a new instance](http://codex.wordpress.org/WordPress_Widgets#Activate_Widgets).

It can also be installed manually.

1. [Download](http://wordpress.org/extend/plugins/prestashop-saiyandev-widget/) the plugin from WordPress.org.
2. Unzip the package and move to your plugins directory.
3. Log into WordPress and navigate to the "Plugins" screen.
4. Locate "Prestashop Saiyandev Widget" in the list and click the "Activate" link.
5. Navigate to Appearance &rarr; Widgets and [create a new instance](http://codex.wordpress.org/WordPress_Widgets#Activate_Widgets).

== Configuration ==
The widget need a few integration and behavioural parameters:

1. Prestashop's web service authorization key. It should be generated from Prestashop's admin site.
2. REST query for products. The widget expects a full view result, so the query must include "display=full" parameter.
3. Prestashop base URL. The Prestashop location URL (without the last bar '/'), it's used when the widget build prestashop's links.
4. JCarrousell Lite easing effect. Labeled with "Efecto de transición (easing)", choose from a value from the dropdown menu.
5. JCarrousell Auto. Labeled with "Pausa (milisegundos)", milliseconds to keep every product.
6. JCarrousell Speed. Labeled with "Velocidad (milisegundos), Number of milliseconds, speed for the transition.
