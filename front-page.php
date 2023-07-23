<?php
/**
 * Third party plugins that hijack the theme will call wp_head() to get the header template.
 * We use this to start our output buffer and render into the view/page-plugin.twig template in footer.php
 *
 * If you're not using a plugin that requries this behavior (ones that do include Events Calendar Pro and
 * WooCommerce) you can delete this file and footer.php
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context = Timber::context();

// services custom post

$timber_post     = new Timber\Post();
/*
$context['products_types'] = Timber::get_terms([
    'taxonomy' => 'type-de-pierre',
    'hide_empty' => false,
    'parent' => 0
]);
*/

$context['projects'] = Timber::get_posts( array(
    'post_type' => 'projet',
    'posts_per_page' => 5,
) );

$context['news'] = Timber::get_posts( array(
    'post_type' => 'post',
    'posts_per_page' => 3,
) );



$context['p'] = $timber_post;
Timber::render( 'front-page.twig' , $context );