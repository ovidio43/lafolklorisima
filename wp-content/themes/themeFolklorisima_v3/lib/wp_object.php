<?php

class WP_Object {

    static $_post_type = '';
    protected $_object = array();

    function __construct($post) {
        if ($post) {
            foreach ($post as $field => $value) {
                $this->$field = (string) $value;
            }
        }
    }

    function __get($column) {
        $correspondences = array(
            'title' => 'post_title',
            'id' => 'ID',
        );
        if ($column == "image") {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($this->ID), "thumb-med");
            return $img_src[0];
        } else if (array_key_exists($column, $this->_object))
            return $this->_object[$column];
        else if (array_key_exists($column, $correspondences))
            return $this->_object[$correspondences[$column]];
        else
            return get_field($column, $this->ID); //get_post_meta($this->ID, $column, true);
    }

    function __set($column, $value) {
        $this->_object[$column] = $value;
    }

    static function find($id) {
        $objects = get_posts(array(
            'post_type' => static::$_post_type,
            'post_status' => 'any',
            'numberposts' => -1,
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'event_date',
                    'value' => $id,
                    'type' => 'CHAR',
                    'compare' => 'like'
                ),
                array(
                    'key' => 'city_country',
                    'value' => $id,
                    'compare' => 'like'
                )
            )            
        ));
        //echo $id;
        //print_r($objects);
        //exit();
        //return new static($objects[0]); original code
        return self::from_wp_array($objects);
    }

    static function find_all() {
        $raw = get_posts(array(
            'post_type' => static::$_post_type,
            'post_status' => 'publish',
            'numberposts' => -1
        ));

        return self::from_wp_array($raw);
    }

    protected static function from_wp_array($array) {
        $converted = array();

        foreach ($array as $post) {
            $converted[] = new static($post);
        }

        return $converted;
    }

    function get_permalink() {
        return get_permalink($this->ID);
    }

    function the_permalink() {
        echo $this->get_permalink();
    }

    function the_excerpt($after = null) {
        echo apply_filters('the_excerpt', $this->post_excerpt . $after); //won't get the default excerpt though
    }

    function the_content() {
        $content = apply_filters('the_content', $this->post_content);
        $content = str_replace(']]>', ']]&gt;', $content);

        return $content;
    }

    function the_thumbnail() {
        echo get_the_post_thumbnail($this->ID);
    }

}
