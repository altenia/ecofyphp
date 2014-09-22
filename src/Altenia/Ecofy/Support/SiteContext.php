<?php namespace Altenia\Ecofy\Support;

/**
 * Contains information about the site
 */
class SiteContext {

	public $name;
	public $slogan;
	public $description;
	public $copyright;

	public $default_lang;

	public $logo_url;

	public $base_path;

	private static $context = null;

	public static function instance() {
		if (self::$context == null)
			self::$context = new SiteContext();
		return self::$context;
	}
}