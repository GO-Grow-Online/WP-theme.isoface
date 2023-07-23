<?php
/* Template Name: Sections */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['p'] = $timber_post;

if (get_field('display_news') == true) {
    $context['news'] = Timber::get_posts( array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    ) );
}


Timber::render( 'page-section-repeater.twig' , $context );
