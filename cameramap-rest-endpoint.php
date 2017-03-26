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
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'cameramap_get_around_items',
    ));
}

function cameramap_get_around_items( WP_REST_Request $request ){
    $data = $request->get_json_params();
    return new WP_REST_Response( $data );
}
