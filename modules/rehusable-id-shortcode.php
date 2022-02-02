<?php

namespace oxy_functions;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Creates shortcode with reusable part ID [oxygen-template id="1234"]
 * credit: https://wpdevdesign.com/shortcode-for-displaying-oxygen-templates-and-reusable-parts/
 */

add_shortcode( 'oxygen-template', 'oxy_functions\func_oxygen_template' );
/**
 * Add a custom shortcode for displaying a Oxygen template/reusable part.
 *
 * Sample usage: [oxygen-template id="478"]
 *
 * @param array $atts Shortcode attributes.
 * @return string HTML output of the specified Oxygen template/reusable part.
 */
function func_oxygen_template( $atts ) {

    return do_shortcode( get_post_meta( $atts['id'], 'ct_builder_shortcodes', true ) );

}