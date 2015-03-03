<?php

/**
 * Title: PayDutch merchant
 * Description: 
 * Copyright: Copyright (c) 2005 - 2015
 * Company: Pronamic
 * @author Remco Tolsma
 * @version 1.0.0
 */
class Pronamic_WP_Pay_Gateways_PayDutch_Merchant {
	/**
	 * PayDutch username
	 * 
	 * @var string
	 */
	public $username;

	/**
	 * PayDutch password
	 * 
	 * @var string
	 */
	public $password;

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
	}
}
