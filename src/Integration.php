<?php

class Pronamic_WP_Pay_Gateways_PayDutch_Integration extends Pronamic_WP_Pay_Gateways_AbstractIntegration {
	public function __construct() {
		$this->id            = 'paydutch';
		$this->name          = 'PayDutch';
		$this->url           = 'http://www.paydutch.nl/';
		$this->dashboard_url = 'https://www.paydutch.nl/paydutchmanager/';
		$this->provider      = 'paydutch';
	}

	public function get_config_factory_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_ConfigFactory';
	}

	public function get_config_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_Config';
	}

	public function get_settings_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_Settings';
	}

	public function get_gateway_class() {
		return 'Pronamic_WP_Pay_Gateways_PayDutch_Gateway';
	}
}
