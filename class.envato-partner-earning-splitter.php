<?php

/**
 * @Author: Abdul Awal
 * @Date:   2020-07-14 15:48:43
 * @Last Modified by:   Abdul Awal
 * @Last Modified time: 2020-07-14 17:28:27
 */

class EnvatoEarningSplitter {
	// Bearer, no need for OAUTH token, change this to your bearer string
	// https://build.envato.com/api/#token

	private static $bearer = "XXXXXXXXXXXXXXXXXXXXXXXXXXXX"; // replace the API key here.

	static function getStatement( $item_id, $start_date, $end_date, $site ) {
	  
		//setting the header for the rest of the api
		$bearer   = 'bearer ' . self::$bearer;
		$header   = array();
		$header[] = 'Content-length: 0';
		$header[] = 'Content-type: application/json; charset=utf-8';
		$header[] = 'Authorization: ' . $bearer;

		$api_url 		= 'https://api.envato.com/v3/market/user/statement';
		$ch_statement 	= curl_init( $api_url . '?from_date=' . $start_date . '&to_date='. $end_date . '&site='. $site );

		curl_setopt( $ch_statement, CURLOPT_HTTPHEADER, $header );
		curl_setopt( $ch_statement, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch_statement, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch_statement, CURLOPT_CONNECTTIMEOUT, 5 );
		curl_setopt( $ch_statement, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

		$cinit_statement_data = curl_exec( $ch_statement );
		curl_close( $ch_statement );

		if ($cinit_statement_data != ""){
			$cinit_statement_data = json_decode( $cinit_statement_data );
			$total_results = $cinit_statement_data->count;
			if( $total_results > 0){
				$amount = 0;
				$total_pages = ceil( $total_results / 50 );
				for ($i=1; $i <= $total_pages; $i++) { 
					$ch_statement_paged		= curl_init( $api_url . '?page='. $i .'&from_date=' . $start_date . '&to_date='. $end_date . '&site='. $site );
					curl_setopt( $ch_statement_paged, CURLOPT_HTTPHEADER, $header );
					curl_setopt( $ch_statement_paged, CURLOPT_SSL_VERIFYPEER, false );
					curl_setopt( $ch_statement_paged, CURLOPT_RETURNTRANSFER, 1 );
					curl_setopt( $ch_statement_paged, CURLOPT_CONNECTTIMEOUT, 5 );
					curl_setopt( $ch_statement_paged, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

					$cinit_statement_paged_data = curl_exec( $ch_statement_paged );
					curl_close( $ch_statement_paged );

					if ($cinit_statement_paged_data != ""){
						
						$cinit_statement_paged_data = json_decode( $cinit_statement_paged_data );
						$items = $cinit_statement_paged_data->results;
						foreach( $items as $item_key => $item_value ){
							if( $item_value->item_id == $item_id ){
								$amount += $item_value->amount;
							}
						}	
					}
				}

				return $amount;
				
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}