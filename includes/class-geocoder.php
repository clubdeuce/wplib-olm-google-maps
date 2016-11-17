<?php

namespace Clubdeuce\WPLib\Components\GoogleMaps;

/**
 * Class Geocoder
 * @package Clubdeuce\WPLib\Components\GoogleMaps
 */
class Geocoder {

    /**
     * @var string
     */
    protected $_api_key;

    /**
     * KSA_Geocoder constructor.
     *
     * @param array $args
     */
    function __construct( $args = array() ) {

        $args = wp_parse_args( $args, array(
            'api_key' => '',
        ) );

        $this->_api_key = $args['api_key'];

    }

    /**
     * @return string
     */
    function api_key() {

        return $this->_api_key;

    }

    /**
     * @param  string $address
     * @return Location|\WP_Error
     */
    function geocode( $address ) {

        $url = $this->_make_url( $address );

        $response = $this->_make_request( $url );

        return $this->_make_location( $response );

    }

    /**
     * @param  string $address
     * @return string
     */
    private function _make_url( $address ) {

        return sprintf(
            'https://maps.googleapis.com/maps/api/geocode/json?address=%1$s&key=%2$s',
            urlencode( filter_var( $address, FILTER_SANITIZE_STRING ) ),
            self::api_key()
        );

    }

    /**
     * Convert the response body into an a Location object
     *
     * @param  array $response
     * @return Location
     */
    private function _make_location( $response ) {

        return new Location( array(
            'address'           => $response['results'][0]['formatted_address'],
            'formatted_address' => $response['results'][0]['formatted_address'],
            'state'             => $response['results'][0]['address_components'][4]['short_name'],
            'latitude'          => $response['results'][0]['geometry']['location']['lat'],
            'longitude'         => $response['results'][0]['geometry']['location']['lng'],
            'place_id'          => $response['results'][0]['place_id'],
            'types'             => $response['results'][0]['types'],
            'viewport'          => $response['results'][0]['geometry']['viewport'],
        ) );

    }


    /**
     * @param $url
     * @return array|\WP_Error
     */
    private function _make_request( $url ) {

        $return = new \WP_Error( 1, 'Invalid URL', $url );

        if ( wp_http_validate_url( $url ) ) {
            $request = $this->_get_data( $url );

            $return = new \WP_Error( $request['response']['code'], $request['response']['message'] );

            if ( 200 == $request['response']['code'] ) {
                $return = json_decode( $request['body'], true );
            }

        }

        return $return;

    }

    /**
     * @param $url
     * @return array|\WP_Error
     */
    private function _get_data( $url ) {

        $cache_key = md5( serialize( $url ) );

        if ( ! $data = wp_cache_get( $cache_key ) ) {
            $data = wp_remote_get( $url );
            wp_cache_add( $cache_key, $data, 300 );
        }

        return $data;

    }

}
