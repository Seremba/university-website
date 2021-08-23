<?php

add_action('rest_api_init', 'universityRegisterSearch');

function universityRegisterSearch()
{
    //this takes three arguments; namespace like wp, 
    //for us we use university namespace, second argument 
    //is the route, third argument is the array
    register_rest_route('university/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE, //or GET
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults($data)
{
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'event', 'campus', 'program'),
        's' =>  sanitize_text_field($data['term'])
    ));
    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events'   => array(),
        'campuses' => array()
    );

    while ($mainQuery->have_posts()) {
        $mainQuery->the_post();
        if (get_post_type() === 'post' or get_post_type() === 'page') {
            // array push takes two arguments 
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }
        if (get_post_type() === 'professor') {
            // array push takes two arguments 
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        if (get_post_type() === 'program') {
            // array push takes two arguments 
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        if (get_post_type() === 'campus') {
            // array push takes two arguments 
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
        if (get_post_type() === 'event') {
            // array push takes two arguments 
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }
    }
    return $results;
}
