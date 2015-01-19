<?php

class Pronamic_WP_Pay_Gateways_PayDutch_XML_RetrieveBankListRequestMessageTest extends WP_UnitTestCase {
	function test_request_message() {
		$filename = __DIR__ . '/Mock/request-retrievebanklist.xml';

		$expected = Pronamic_WP_Pay_Gateways_PayDutch_XML_Message::new_dom_document();
		$expected->load( $filename );

		$message = new Pronamic_WP_Pay_Gateways_PayDutch_XML_RetrieveBankListRequestMessage( '0101', true );
		$actual  = $message->get_document();

		$this->assertEquals( $expected, $actual );
	}
}
