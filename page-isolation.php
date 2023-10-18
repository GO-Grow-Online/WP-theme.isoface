<?php
/* Template Name: Isolation */

$context = Timber::context();

$timber_post = new Timber\Post();
$context['p'] = $timber_post;

if (get_field('display_news') == true) {
    $context['news'] = Timber::get_posts( array(
        'post_type' => 'post',
        'posts_per_page' => 3,
    ) );
}

$term = get_field('cat_to_display')[0]->slug;
if($term != null) {

    $context['products'] = Timber::get_posts(
        array(
            'post_type' => 'produits',
            'tax_query' => array(
                array(
                    'taxonomy' => 'type-de-produits',
                    'field' => 'slug',
                    'terms' => $term,
                ),
            ),
        )
    );

}


Timber::render( 'page-isolation.twig' , $context );
var_dump(get_field('cat_to_display'));
