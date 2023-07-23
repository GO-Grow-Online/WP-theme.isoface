<?php
/* Template Name: Service */
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array( 'page-service.twig' );

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();

Timber::render( $templates, $context );