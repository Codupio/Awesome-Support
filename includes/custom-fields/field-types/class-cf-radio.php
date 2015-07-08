<?php
/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WPAS_CF_Radio extends WPAS_Custom_Field {

	public $options = array();

	/**
	 * Return the field markup for the front-end.
	 *
	 * @return string Field markup
	 */
	public function display() {

		if ( ! isset( $this->field_args['options'] ) || empty( $this->field_args['options'] ) ) {
			return '<!-- No options declared -->';
		}

		$output        = sprintf( '<legend class="wpas-label-checkbox">%s</legend>', $this->get_field_title() );
		$this->options = $this->field_args['options'];

		foreach ( $this->options as $option_id => $option_label ) {
			$selected = $option_id === $this->populate() ? 'checked' : '';
			$output .= sprintf( "<div class='wpas-radio'><label><input type='radio' name='%s' value='%s' %s> %s</label></div>", $this->get_field_id(), $option_id, $selected, $option_label );
		}

		return $output;

	}

	/**
	 * Return the field markup for the admin.
	 *
	 * This method is only used if the current user
	 * has the capability to edit the field.
	 */
	public function display_admin() {
		return $this->display();
	}

	/**
	 * Return the field markup for the admin.
	 *
	 * This method is only used if the current user
	 * doesn't have the capability to edit the field.
	 */
	public function display_no_edit() {
		return sprintf( '<p id="%s-label">%s</p><p id="%s-value">%s</p>', $this->get_field_id(), $this->get_field_title(), $this->get_field_id(), $this->get_field_value() );
	}

}