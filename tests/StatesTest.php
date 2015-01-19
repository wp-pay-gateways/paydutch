<?php

/**
 * Title: PayDutch states test
 * Description:
 * Copyright: Copyright (c) 2005 - 2014
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_StatesTest extends PHPUnit_Framework_TestCase {
	/**
	 * @dataProvider status_matrix_provider
	 */
	public function test_transform( $state, $expected ) {
		$status = Pronamic_WP_Pay_Gateways_PayDutch_States::transform( $state );

		$this->assertEquals( $expected, $status );
	}

	public function status_matrix_provider() {
		return array(
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::REGISTER, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::PROCESSING, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::INCOME, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::ASSEMBLE, Pronamic_WP_Pay_Statuses::OPEN ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::PAYOUT, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::SUCCESS, Pronamic_WP_Pay_Statuses::SUCCESS ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::CANCELLED, Pronamic_WP_Pay_Statuses::CANCELLED ),
			array( Pronamic_WP_Pay_Gateways_PayDutch_States::FAILED, Pronamic_WP_Pay_Statuses::FAILURE ),
			array( 'not existing state', null ),
		);
	}
}
