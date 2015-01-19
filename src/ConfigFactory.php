<?php

class Pronamic_WP_Pay_Gateways_PayDutch_ConfigFactory extends Pronamic_WP_Pay_GatewayConfigFactory {
	public function get_config( $post_id ) {
		$config = new Pronamic_WP_Pay_Gateways_PayDutch_Config();

		$config->username = get_post_meta( $post_id, '_pronamic_gateway_paydutch_username', true );
		$config->password = get_post_meta( $post_id, '_pronamic_gateway_paydutch_password', true );
		$config->mode     = get_post_meta( $post_id, '_pronamic_gateway_mode', true );

		return $config;
	}
}
