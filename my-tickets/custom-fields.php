<?php
/*
Plugin Name: My Tickets: Custom Fields
Plugin URI: http://www.joedolson.com/my-tickets/
Description: Custom Fields in My Tickets
Version: 1.1.0
Author: Joseph Dolson
Author URI: http://www.joedolson.com/
*/
/*  Copyright 2014-2018  Joseph C Dolson  (email : plugins@joedolson.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter( 'mt_custom_fields', 'create_custom_fields', 10, 1 );
/**
 * Add custom fields to each add to cart form. 
 *
 * @param array $array All custom fields.
 *
 * @return array New array of custom fields.
 */
function create_custom_fields( $array ) {
	$array['test_event_data'] = array( 
		'title'             => 'Job Title', 
		'sanitize_callback' => 'custom_sanitize_callback', 
		'display_callback'  => 'custom_display_callback',
		'input_type'        => 'select',
		'input_values'      => array( 
			'Web Developer', 
			'Consultant', 
			'Marketer' 
		),
		'context'           => 'global', // Can be an event ID.
		'required'          => 'true',
	);
	/**
	 * Add a second custom field by adding more values to the array
	 */
	$array['choose_seats'] = array(
		'title'             => 'Seat(s) Selection:',
		'sanitize_callback' => 'sanitize_callback',
		'display_callback'  => 'display_callback',
		'input_type'        => 'text',
		'context'           => 'global'
	);
	
	return $array;
}

/**
 * This display callback is used to format the saved data. 
 *
 * @param mixed  $data Value of saved data.
 * @param string $context either 'payment' or 'cart'.
 * 
 * @return data passed.
 */
function custom_display_callback( $data, $context='payment' ) {
	return ( $data ) ? urldecode( $data ) : '';
}

/**
 * This sanitize callback is used to sanitize the data before it's saved to the DB 
 *
 * @param mixed $data Data supplied by user.
 *
 * @return sanitized value
 */
function custom_sanitize_callback( $data ) {
	return ( $data ) ? esc_html( $data ) : '';
}