<?php

namespace oxyfunctions\acf_location;

defined( 'ABSPATH' ) || exit;

/**
 * Description: Allows to chose Oxygen template in ACF location rules
 * Credit: https://anthonyskelton.com/2021/acf-custom-location-rules-based-on-block-settings/
 */

if ( class_exists('\ACF_Location')){

	function register_oxy_template_location() {

		if ( function_exists( 'acf_register_location_type' ) ) {
			
			acf_register_location_type( 'oxyfunctions\acf_location\acf_oxy_template_location' );
		}
	}

	add_action( 'acf/init', 'oxyfunctions\acf_location\register_oxy_template_location' );



	class acf_oxy_template_location extends \ACF_Location {

		public function initialize() {
			$this->name = 'oxygen_template';
			$this->label = __( 'Oxygen template' );
			$this->category = 'Oxygen';
		}

		private function get_oxy_templates_names(){

			global $wpdb;

			$sql_query = "SELECT post_title,ID FROM {$wpdb->prefix}posts WHERE post_type = 'ct_template' AND post_status = 'publish'"; 

			$sql_results = $wpdb->get_results($sql_query,ARRAY_N);

			$result = array();

			foreach ($sql_results as $template_name) {

				$template_id = $template_name[1];

				$result[$template_id] = $template_name[0];
			
			}

			return $result;

		}

		//ACF group location settings
		public function get_values( $rule ): array {

			return $this->get_oxy_templates_names();        

		}


		/**
		 * Match location criteria for ACF group
		 * 
		 * $rule = Array
		 *		[param] => oxygen_template
		 *		[operator] => ==
	 	 *		[value] => 11 //template ID
		 *	
		 *  $screen =Array
		 *		[lang] => 
		 *		[ajax] => 
		 *		[post_id] => 59
		 *		[post_type] => post
 		 *
		 **/
		public function match( $rule, $screen, $field_group ): bool {

			$is_operator_equals = $rule['operator'] === '==';

			if( $this->has_post_oxy_template( $rule, $screen ) ) return $is_operator_equals;

			if ( $this->has_this_post_type_template( $rule, $screen )) return $is_operator_equals;

			return !$is_operator_equals;
		}

		private function has_this_post_type_template( $rule, $screen ){

			return $screen['post_type'] == get_post_meta( $rule['value'],'ct_template_post_types' )[0][0];
			
		}

		private function has_post_oxy_template( $rule, $screen ){

			return $rule['value'] == get_post_meta($screen['post_id'],'ct_other_template')[0];
		}

	}
}