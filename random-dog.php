<?php
/*
Plugin Name: Random Dog
Plugin URI: https://github.com/seieric/random-dog
Description: This plugin adds widgets and shortcodes that show dogs randomly. Dogs are fetched from Dogs API(https://dog.ceo/dog-api/).
Version: 1.0
Author: seieric
Author URI: https://about.monolithon.net
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

function random_dog_js_tag() {
    $ep = RANDOM_DOG_EP;
    $tag = <<< TAG
<script>(function() {
const thisTag = document.currentScript;
fetch('{$ep}').then(r=>r.json()).then(d=>{
    const img = document.createElement('img');
    img.src = d.message;
    img.alt = 'A picture of a dog.';
    thisTag.parentNode.insertBefore(img, thisTag.nextSibling);
}).catch(e=>console.log(e))})();</script>
TAG;
    return $tag;
}

function random_dog_json_get( string $url ) {
    $res = wp_remote_get( $url );

    $http_code = wp_remote_retrieve_response_code( $res );
    if ($http_code !== 200) return null;

    $body = wp_remote_retrieve_body( $res );
    return json_decode( $body, true );
}

require_once dirname( __FILE__ ) . '/shortcode.php';
require_once dirname( __FILE__ ) . '/widget.php';
