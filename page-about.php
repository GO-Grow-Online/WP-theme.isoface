<?php
/* Template Name: About */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['p'] = $timber_post;

$context['news'] = Timber::get_posts( array(
    'post_type' => 'post',
    'posts_per_page' => 3,
) );

Timber::render( 'page-about.twig' , $context );
