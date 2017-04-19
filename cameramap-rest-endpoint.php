<?php
/**
 * @package CameraMap_Rest_Endpoint
 * @version 0.1
 */
/*
Plugin Name: CameraMap Rest Endpoint
Plugin URI:
Description: Custom endpoint API Rest for CameraMap.
Author: Fran Rodríguez
Version: 0.1
Author URI:
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('rest_api_init', 'cameramap_register_routes');

function cameramap_register_routes() {
    register_rest_route( 'cameramap/v1', '/list', array(
       'methods' => 'GET',
       'callback' => 'cameramap_get_around_items',
    ));
}

function cameramap_get_around_items( $request ){
    $radius_query = new WP_Query( array(
       'posts_per_page' => -1,
       'post_status' => 'publish',
       'geo_mashup_query' => array(
          'near_lat' => $request->get_param('lat'),
          'near_lng' => $request->get_param('lng'),
          'radius_km' => 2,
       ),
    ) );

    return new WP_REST_Response( $radius_query->query() );
}
