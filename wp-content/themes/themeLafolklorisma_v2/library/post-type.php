<?php

function custom_post_type_init() {
    $post_types = array(
        array("slug" => "eventos", "plural" => "Eventos", "singular" => "Evento", "rewrite" => "eventos", "public" => true, "archive" => true, "supports" => array('title', 'editor', 'thumbnail')),
        array("slug" => "musica", "plural" => "Musicas", "singular" => "Musica", "rewrite" => "musica", "public" => true, "archive" => true, "supports" => array('title', 'editor', 'thumbnail')),
        array("slug" => "videos", "plural" => "Videos", "singular" => "Video", "rewrite" => "videos", "public" => true, "archive" => true, "supports" => array('title', 'editor', 'thumbnail')),
        array("slug" => "fotos", "plural" => "Fotos", "singular" => "Foto", "rewrite" => "fotos", "public" => true, "archive" => true, "supports" => array('title', 'editor', 'thumbnail')),
        array("slug" => "danzas_bolivianas", "plural" => "Danzas Bolivianas", "singular" => "Danza Boliviana", "rewrite" => "danzas_bolivianas", "public" => true, "archive" => true, "supports" => array('title', 'editor', 'thumbnail'))
    );

    foreach ($post_types as $pt) {

        $supports = array('title', 'editor', 'post_tags', 'thumbnail', 'excerpt', "comments");
        $public = isset($pt['public']) ? $pt['public'] : false;
        register_post_type($pt["slug"], array(
            'labels' => array(
                'name' => $pt["plural"],
                'singular_name' => $pt["singular"]
            ),
            'show_ui' => true,
            'publicly_queryable' => isset($pt["publicly_queryable"]) ? $pt["publicly_queryable"] : $public,
            'public' => isset($pt['public']) ? $pt['public'] : false,
            'has_archive' => isset($pt['archive']) ? $pt['archive'] : true,
            'rewrite' => array('hierarchical' => true, 'with_front' => true, 'slug' => isset($pt["rewrite"]) ? $pt["rewrite"] : $pt["slug"]),
            'supports' => isset($pt['supports']) ? $pt['supports'] : $supports,
            'taxonomies' => isset($pt['taxonomies']) ? $pt['taxonomies'] : array('post_tag'),
            'hierarchical' => false
                )
        );
    }
}

add_action('init', 'custom_post_type_init');
//Defines custom image sizes used on the katy perry site.