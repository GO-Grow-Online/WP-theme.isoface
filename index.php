<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$context          = Timber::context();
$context['p'] = new Timber\Post();
$templates        = array( 'index.twig' );

if ( is_front_page() && !is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}else if (is_home()) {
	$context['archive'] = Timber::get_posts( array(
		'post_type' => get_post_type(),
		'posts_per_page' => -1,
	));
	
	array_unshift( $templates, 'archive.twig' );
}

Timber::render( $templates, $context );
