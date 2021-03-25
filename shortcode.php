<?php
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

function random_dog() {
    $dog = random_dog_json_get( RANDOM_DOG_EP );
    if ($dog) {
        return "<img src=\"{$dog["message"]}\" loading=\"lazy\" alt=\"A picture of a dog.\">";
    } else {
        return '<p>Dogs are sleeping.</p>';
    }
}

function random_dog_js() {
    return random_dog_js_tag();
}

add_shortcode( 'dog', 'random_dog' );
add_shortcode( 'dogjs', 'random_dog_js' );
