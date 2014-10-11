<?php namespace Altenia\Ecofy\Util;

/**
 * Helper class that provides HTML rendering functionalites.
 */
class AddressUtil {

	/**
	 * Parses US address of format <Street>, City, <ST> nnnnn
	 * @return {array} Associative array with keys address, province_cd (state), postal_code
	 */
	public static function parse($addressText)
	{
		$addressParts = array();
		preg_match_all("/[A-Z]{2}\s+[0-9]{5}/", $addressText, $output_array, PREG_OFFSET_CAPTURE);
		if ( !empty($output_array) && !empty($output_array[0])) {
			// There should be only one instance
			// n-th Index 0=always zero, 1=list of occurence, 2=[0]->string, [1] offset 
			$stateZip = $output_array[0][0][0];
			$tokens = preg_split('/\s+/', $stateZip);

			$address = substr($addressText, 0, $output_array[0][0][1]);
			$address = rtrim($address, " ,.");
			$addressParts['address'] = $address;
			$addressParts['province_cd'] = $tokens[0];
			$addressParts['postal_code'] = $tokens[1];
		} else {
			$addressParts['address'] = $addressText;
			$addressParts['province_cd'] = '';
			$addressParts['postal_code'] = '';
		}
		return $addressParts;
	}

	/**
	 * Returns a full address from address parts
	 * @param {array} $addressParts Associative array containing following 
	 *                              keys: address, province_cd, postal_code 
	 */
	public static function fullAddress($addressParts)
	{
		$fullAddress = $addressParts['addresss'];
		if (array_key_exists('province_cd', $addressParts)) {
			$fullAddress .= ', ' . $addressParts['province_cd'];
		}
		if (array_key_exists('postal_code', $addressParts)) {
			$fullAddress .= ' ' . $addressParts['postal_code'];
		}
		return $fullAddress;
	}
}