<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} elseif ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} elseif ( is_post_type_archive() ) {
	
	$img_slug = get_post_type().'_img';
	$title_slug = get_post_type().'_t';
	
	$context['p']['title'] = get_field($title_slug, 'options') != '' ? get_field($title_slug, 'option') : post_type_archive_title( '', false );

	$context['p']['heading_img'] = get_field($img_slug, 'options') ? get_field($img_slug, 'option') : null;
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
} elseif (is_tax('type-de-produits')) {

	$context['title'] = get_the_title();
	$context['p'] = new Timber\Term();

	/* $context['subTax'] = Timber::get_terms(array(
		'taxonomy' => $context['p']['slug'],
		'parent' => $context['p']['id'],
	));*/ 

	$context['projects'] = get_field('projects_rel');

	$templates = array( 'archive-type-de-produits.twig' );
}

$context['post_type'] = get_post_type();
$context['archive'] = Timber::get_posts( array(
	'post_type' => get_post_type(),
	'posts_per_page' => -1,
));


Timber::render( $templates, $context );

echo 'taxonomy slug' . $context['p']['slug'];
echo 'parent id' . $context['p']['id'];