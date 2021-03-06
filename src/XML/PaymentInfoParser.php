<?php

/**
 * Title: Payment info parser
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_XML_PaymentInfoParser implements Pronamic_WP_Pay_Gateways_PayDutch_XML_Parser {
	/**
	 * Parse the specified XML element into an iDEAL transaction object
	 *
	 * @param SimpleXMLElement $xml
	 */
	public static function parse( SimpleXMLElement $xml ) {
		$payment_info = new Pronamic_WP_Pay_Gateways_PayDutch_PaymentInfo();

		$payment_info->test            = Pronamic_WP_Pay_XML_Security::filter( $xml->test, FILTER_VALIDATE_BOOLEAN );
		$payment_info->id              = Pronamic_WP_Pay_XML_Security::filter( $xml->id, FILTER_SANITIZE_STRING );
		$payment_info->description     = Pronamic_WP_Pay_XML_Security::filter( $xml->description, FILTER_SANITIZE_STRING );
		$payment_info->amount          = Pronamic_WP_Pay_Gateways_PayDutch_Client::parse_amount( Pronamic_WP_Pay_XML_Security::filter( $xml->amount, FILTER_SANITIZE_STRING ) );
		$payment_info->state           = Pronamic_WP_Pay_XML_Security::filter( $xml->state, FILTER_SANITIZE_STRING );
		$payment_info->reference       = Pronamic_WP_Pay_XML_Security::filter( $xml->reference, FILTER_SANITIZE_STRING );
		$payment_info->methodcode      = Pronamic_WP_Pay_XML_Security::filter( $xml->methodcode, FILTER_SANITIZE_STRING );
		$payment_info->methodname      = Pronamic_WP_Pay_XML_Security::filter( $xml->methodname, FILTER_SANITIZE_STRING );
		$payment_info->consumername    = Pronamic_WP_Pay_XML_Security::filter( $xml->consumername, FILTER_SANITIZE_STRING );
		$payment_info->consumercity    = Pronamic_WP_Pay_XML_Security::filter( $xml->consumercity, FILTER_SANITIZE_STRING );
		$payment_info->consumeraccount = Pronamic_WP_Pay_XML_Security::filter( $xml->consumeraccount, FILTER_SANITIZE_STRING );
		$payment_info->consumercountry = Pronamic_WP_Pay_XML_Security::filter( $xml->consumercountry, FILTER_SANITIZE_STRING );
		$payment_info->created         = Pronamic_WP_Pay_XML_Security::filter( $xml->created, FILTER_SANITIZE_STRING );

		return $payment_info;
	}
}
