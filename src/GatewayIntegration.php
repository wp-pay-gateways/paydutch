<?php

class Pronamic_WP_Pay_Gateways_PayDutch_GatewayIntegration {
	public function __construct() {
		$this->id = 'paydutch';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_Config';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_Gateway';
	}
}
