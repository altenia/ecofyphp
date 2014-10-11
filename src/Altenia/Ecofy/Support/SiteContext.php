<?php namespace Altenia\Ecofy\Support;

/**
 * Contains information about the site
 */
class SiteContext {

	public static $VERSION = '0.1'; 

	public $name;
	public $slogan;
	public $description;
	public $copyright;

	public $default_lang;

	public $alt_url;
	public $logo_url;

	// array {title, url} 
	public $main_page;

	public $context_path = '/';

	private static $context = null;

	public static function instance() {
		if (self::$context == null)
			self::$context = new SiteContext();
		return self::$context;
	}

	/**
	 * Set the values
	 */
	public static function set($info) {
		$vars = get_class_vars(__CLASS__);

		$instance = self::instance();
		foreach ($vars as $var => $val) {
			if (array_key_exists($var, $info)) {
				$instance->$var = $info[$var];
			}
		}

		return self::$context;
	}
}