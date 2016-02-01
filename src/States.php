<?php

/**
 * Title: PayDutch states
 * Description:
 * Copyright: Copyright (c) 2005 - 2016
 * Company: Pronamic
 *
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_States {
	/**
	 * Payment methods state 'Register'
	 *
	 * Payment registered, consumer initiated link.
	 *
	 * @var string
	 */
	const REGISTER = 'Register';

	/**
	 * Payment methods state 'Processing'
	 *
	 * Payment in process, consumer is paying at the moment.
	 *
	 * @var string
	 */
	const PROCESSING = 'Processing';

	/**
	 * Payment methods state 'Income'
	 *
	 * Consumer paid successfully to DPG account.
	 *
	 * @var string
	 */
	const INCOME = 'Income';

	/**
	 * Payment methods state 'Assemble'
	 *
	 * After the contractual period the payments are going to be assembled.
	 *
	 * @var string
	 */
	const ASSEMBLE = 'Assemble';

	/**
	 * Payment methods state 'Payout'
	 *
	 * The assembled payments are set ready for payout to the merchants account.
	 *
	 * @var string
	 */
	const PAYOUT = 'Payout';

	/**
	 * Payment methods state 'Success'
	 *
	 * Payout confirmed by the Bank Statement
	 *
	 * @var string
	 */
	const SUCCESS = 'Success';

	/**
	 * Payment methods state 'Cancelled'
	 *
	 * Consumer cancelled the payment.
	 *
	 * @var string
	 */
	const CANCELLED = 'Cancelled';

	/**
	 * Payment methods state 'Failed'
	 *
	 * Failed payment.
	 *
	 * @var string
	 */
	const FAILED = 'Failed';

	/////////////////////////////////////////////////

	/**
	 * Transform an PayDutch state
	 *
	 * @param string $status
	 * @return string
	 */
	public static function transform( $state ) {
		switch ( $state ) {
			case Pronamic_WP_Pay_Gateways_PayDutch_States::REGISTER :
				return Pronamic_WP_Pay_Statuses::OPEN;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::PROCESSING :
				return Pronamic_WP_Pay_Statuses::OPEN;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::INCOME :
				return Pronamic_WP_Pay_Statuses::SUCCESS;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::ASSEMBLE :
				return Pronamic_WP_Pay_Statuses::OPEN;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::PAYOUT :
				return Pronamic_WP_Pay_Statuses::SUCCESS;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::SUCCESS :
				return Pronamic_WP_Pay_Statuses::SUCCESS;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::CANCELLED :
				return Pronamic_WP_Pay_Statuses::CANCELLED;
			case Pronamic_WP_Pay_Gateways_PayDutch_States::FAILED :
				return Pronamic_WP_Pay_Statuses::FAILURE;
			default :
				return null;
		}
	}
}
