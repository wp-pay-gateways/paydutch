<?php

/**
 * Title: PayDutch
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_Client {
	/**
	 * Mollie API endpoint URL
	 *
	 * @var string
	 */
	const API_URL = 'https://www.paydutch.nl/api/processreq.aspx';

	/////////////////////////////////////////////////

	/**
	 * PayDutch username
	 *
	 * @var string
	 */
	private $username;

	/**
	 * PayDutch password
	 *
	 * @var string
	 */
	private $password;

	/////////////////////////////////////////////////

	/**
	 * Test flag
	 *
	 * @var boolean
	 */
	private $test;

	/////////////////////////////////////////////////

	/**
	 * Error
	 *
	 * @var WP_Error
	 */
	private $error;

	/////////////////////////////////////////////////

	/**
	 * Constructs and initializes an Mollie client object
	 *
	 * @param string $username
	 * @param string $password
	 */
	public function __construct( $username, $password ) {
		$this->username = $username;
		$this->password = $password;

		$this->test = false;
	}

	/////////////////////////////////////////////////

	/**
	 * Error
	 *
	 * @return WP_Error
	 */
	public function get_error() {
		return $this->error;
	}

	/////////////////////////////////////////////////

	/**
	 * Set test
	 *
	 * @param boolean $test
	 */
	public function set_test( $test ) {
		$this->test = $test;
	}

	/////////////////////////////////////////////////

	/**
	 * Request the specified message
	 *
	 * @param Pronamic_WP_Pay_Gateways_PayDutch_XML_RequestMessage $message
	 */
	private function request( Pronamic_WP_Pay_Gateways_PayDutch_XML_RequestMessage $message ) {
		return Pronamic_WP_Util::remote_get_body( self::API_URL, 200, array(
			'method'    => 'POST',
			'sslverify' => false,
			'headers'   => array( 'Content-Type' => 'text/xml' ),
			'body'      => (string) $message,
		) );
	}

	/////////////////////////////////////////////////

	/**
	 * Get payment methods
	 */
	public function get_payment_methods() {
		$merchant = new Pronamic_WP_Pay_Gateways_PayDutch_Merchant( $this->username, $this->password );
		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_ListMethodRequestMessage( $merchant );

		$result = $this->request( $message );

		if ( is_wp_error( $result ) ) {
			$this->error = $result;
		} else {
			$xml = Pronamic_WP_Util::simplexml_load_string( $result );

			if ( is_wp_error( $xml ) ) {
				$this->error = $xml;
			}
		}
	}

	/**
	 * Get bank list
	 */
	public function get_bank_list() {
		$list = null;

		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_RetrieveBankListRequestMessage( Pronamic_WP_Pay_Gateways_PayDutch_Methods::WEDEAL, $this->test );

		$result = $this->request( $message );

		if ( is_wp_error( $result ) ) {
			$this->error = $result;
		} else {
			$xml = Pronamic_WP_Util::simplexml_load_string( $result );

			if ( is_wp_error( $xml ) ) {
				$this->error = $xml;
			} else {
				$list = Pronamic_WP_Pay_Gateways_PayDutch_XML_BankListParser::parse( $xml );
			}
		}

		return $list;
	}

	/**
	 * Get an transaction request
	 *
	 * @return Pronamic_WP_Pay_Gateways_PayDutch_TransactionRequest
	 */
	public function get_transaction_request() {
		$transaction_request = new Pronamic_WP_Pay_Gateways_PayDutch_TransactionRequest( $this->username, $this->password );

		return $transaction_request;
	}

	/**
	 * Transaction
	 */
	public function request_transaction( $transaction_request ) {
		$result = null;

		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_TransactionRequestMessage( $transaction_request );

		$response = $this->request( $message );

		if ( is_wp_error( $response ) ) {
			$this->error = $response;
		} else {
			$url = filter_var( $response, FILTER_VALIDATE_URL );

			if ( false !== $url ) {
				$result = new stdClass();

				$query = parse_url( $url, PHP_URL_QUERY );
				$query = parse_str( $query, $data );

				$transaction_id = null;
				if ( isset( $data['ID'] ) ) {
					$transaction_id = $data['ID'];
				}

				$result->url = $url;
				$result->id  = $transaction_id;
			} else {
				$this->error = new WP_Error( 'paydutch_error', (string) $response, $response );
			}
		}

		return $result;
	}

	public function get_payment_status( $reference ) {
		$result = null;

		$merchant = new Pronamic_WP_Pay_Gateways_PayDutch_Merchant( $this->username, $this->password );
		$merchant->reference = $reference;
		$merchant->test = $this->test;

		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_QueryRequestMessage( $merchant );

		$result = $this->request( $message );

		if ( is_wp_error( $result ) ) {
			$this->error = $result;
		} else {
			$xml = Pronamic_WP_Util::simplexml_load_string( $result );

			if ( is_wp_error( $xml ) ) {
				$this->error = $xml;
			} else {
				$result = Pronamic_WP_Pay_Gateways_PayDutch_XML_PaymentInfoParser::parse( $xml->paymentinfo );
			}
		}

		return $result;
	}

	/////////////////////////////////////////////////

	/**
	 * Format amount to PayDutch notation
	 *
	 * The amount in euro’s that the consumer need to pay.
	 * Notation: euro(s),cent(s) 00,00.
	 * Max 10000,00 Most banks have a maximum iDeal amount of ten thousand euro.
	 *
	 * @param float $amount
	 * @return string
	 */
	public static function format_amount( $amount ) {
		return number_format( $amount, 2, ',', '' );
	}

	/**
	 * Parse PayDutch notation amount to float
	 *
	 * @param string $amount
	 * @return float
	 */
	public static function parse_amount( $amount ) {
		$amount = str_replace( ',', '.', $amount );

		return filter_var( $amount, FILTER_VALIDATE_FLOAT );
	}
}
