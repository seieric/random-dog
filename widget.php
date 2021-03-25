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

class Random_Dog_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'random_dog_widget',
            'Random Dog',
            array( 'description' => 'Show dogs randomly. If you enable caching, use JavaScipt widget instead.' )
        );
    }

    public function widget( $args, $instance ) {
        $dog = random_dog_json_get( RANDOM_DOG_EP );
        echo $args['before_widget'];
        if ($dog) {
            echo "<img src=\"{$dog["message"]}\" loading=\"lazy\" alt=\"A picture of a dog.\">";
        } else {
            echo '<p>Dogs are sleeping.</p>';
        }
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>This widget shows dogs randomly.</p>';
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
}

class Random_Dog_JS_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'random_dog_js_widget',
            'Random Dog(JavaScript)',
            array( 'description' => 'Show dogs randomly. This works even if caching is enabled.' )
        );
    }

    public function widget( $args, $instance ) {
        $ep = RANDOM_DOG_EP;
        echo $args['before_widget'];
        echo random_dog_js_tag();
        echo $args['after_widget'];
    }

    public function form( $instance ) {
        echo '<p>This widget shows dogs randomly.</p>';
    }

    public function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
}

function register_random_dog_widgets() {
	register_widget( 'Random_Dog_Widget' );
    register_widget( 'Random_Dog_JS_Widget' );
}

add_action( 'widgets_init', 'register_random_dog_widgets' );
