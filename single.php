<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['p'] = $timber_post;

if (get_post_type() == 'produits') {

	$terms = wp_get_post_terms($timber_post->ID, 'type-de-produits', array('fields' => 'ids'));

	$context['other_products'] = Timber::get_posts( array(
		'post_type' => 'produits',
		'posts_per_page' => 3,
		'post__not_in'   => array(get_the_ID()),
		'orderby'        => 'rand',
		'tax_query' => array(
            array(
                'taxonomy' => 'type-de-produits',
                'field' => 'id',
                'terms' => $terms,
            ),
        ),
	) );
}

if (get_post_type() == 'projet') {
	$context['other_projects'] = Timber::get_posts( array(
		'post_type' => 'projet',
		'posts_per_page' => 3,
		'post__not_in'   => array(get_the_ID()),
		'orderby'        => 'rand',
	) );
}

if (get_post_type() == 'post') {
	$context['news'] = Timber::get_posts( array(
		'post_type' => 'post',
		'posts_per_page' => 3,
		'post__not_in' => array(get_the_ID()),
	) );
}





if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig' ), $context );
}
