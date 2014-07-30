<?php namespace Altenia\Ecofy\Util;

/**
 * Helper class that provides HTML rendering functionalites.
 */
class DataFormat {

	/**
	 * Formats date
	 */
	public static function date($date)
	{
		$formatted = '';
		if (is_string($date)) {
			$formatted = date("M d Y", strtotime($date));
		}
		return $formatted;
	}

	public static function currency($amount)
	{
		$formatted = money_format('%(#10n', $amount);
		return $formatted;
	}
}