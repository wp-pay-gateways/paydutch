<?php

class Pronamic_WP_Pay_Gateways_PayDutch_XML_QueryRequestMessageTest extends WP_UnitTestCase {
	function test_request_message() {
		$filename = __DIR__ . '/Mock/request-query.xml';

		$expected = Pronamic_WP_Pay_Gateways_PayDutch_XML_Message::new_dom_document();
		$expected->load( $filename );

		$merchant = new Pronamic_WP_Pay_Gateways_PayDutch_Merchant( 'personalAccountName', 'personalPassword' );
		$merchant->reference = 'Reference123';
		$merchant->test = true;

		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_QueryRequestMessage( $merchant );
		$actual  = $message->get_document();

		$this->assertEquals( $expected, $actual );
	}
}
