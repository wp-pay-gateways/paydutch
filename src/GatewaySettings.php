<?php

/**
 * Title: PayDutch gateway settings
 * Description:
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.1.0
 * @since 1.1.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_GatewaySettings extends Pronamic_WP_Pay_Admin_GatewaySettings {
	public function __construct() {
		add_filter( 'pronamic_pay_gateway_sections', array( $this, 'sections' ) );
		add_filter( 'pronamic_pay_gateway_fields', array( $this, 'fields' ) );
	}

	public function sections( array $sections ) {
		// iDEAL
		$sections['paydutch'] = array(
			'title'   => __( 'PayDutch', 'pronamic_ideal' ),
			'methods' => array( 'paydutch' ),
		);

		// Return
		return $sections;
	}

	public function fields( array $fields ) {
		// Hash Key
		$fields[] = array(
			'section'     => 'paydutch',
			'meta_key'    => '_pronamic_gateway_paydutch_username',
			'title'       => __( 'Username', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'code' ),
		);

		$fields[] = array(
			'section'     => 'paydutch',
			'meta_key'    => '_pronamic_gateway_paydutch_password',
			'title'       => __( 'Password', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'code' ),
		);

		$fields[] = array(
			'section'     => 'paydutch',
			'title'       => __( 'Success CallbackURL', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'large-text', 'code' ),
			'value'       => add_query_arg( 'paydutch_callback', '', home_url( '/' ) ),
			'readonly'    => true,
		);

		$fields[] = array(
			'section'     => 'paydutch',
			'title'       => __( 'Fail CallbackURL', 'pronamic_ideal' ),
			'type'        => 'text',
			'classes'     => array( 'large-text', 'code' ),
			'value'       => add_query_arg( 'paydutch_callback', '', home_url( '/' ) ),
			'readonly'    => true,
		);

		// Return
		return $fields;
	}
}
