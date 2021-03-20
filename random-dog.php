<?php
/*
Plugin Name: Random Dog
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin adds a widget and a shortcode that shows dogs randomly. Dogs are fetched from Dogs API(https://dog.ceo/dog-api/).
Version: 1.0
Author: seieric
Author URI: https://seieric.github.io/
License: GPLv2
*/

/*  Copyright 2021 seieric (email : opensource@yaseiblog.org)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if( !defined( 'ABSPATH' ) ) exit;

define( 'RANDOM_DOG_EP', 'https://dog.ceo/api/breeds/image/random' );

function get( string $url ) {
    $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 3,
    ];
    $curl = curl_init( $url );
    curl_setopt_array( $curl, $options );

    $res = curl_exec( $curl );
    $info = curl_getinfo( $curl );
    $errno = curl_errno( $curl );
    curl_close( $curl );

    if ($errno !== CURLE_OK || $info['http_code'] !== 200) return null;
    return json_decode( $res, true );
}

require_once dirname( __FILE__ ) . '/shortcode.php';
require_once dirname( __FILE__ ) . '/widget.php';
