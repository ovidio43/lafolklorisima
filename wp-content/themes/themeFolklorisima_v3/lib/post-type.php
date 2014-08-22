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
// create taxonomy
add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
    $taxonomies = array(
        array("name_tax" => "musica-categoria", "related_tax" => "musica", "name" => "Categoria Musica", "add_new_item" => "Agregar Nueva Categoria", "new_item_name" => "Nueva Categoria"),
        array("name_tax" => "musica-grupo", "related_tax" => "musica", "name" => "Agrupacion", "add_new_item" => "Agregar Nueva Agrupacion", "new_item_name" => "Nueva Agrupacion")
    );
    foreach ($taxonomies as $tax) {
        register_taxonomy(
            $tax["name_tax"],
            $tax["related_tax"],
            array(
                'labels' => array(
                    'name' => $tax["name"],
                    'add_new_item' => $tax["add_new_item"],
                    'new_item_name' => $tax["new_item_name"]
                ),
                'show_ui' => true,
                'show_tagcloud' => false,
                'hierarchical' => true
            )
        );
    }
}