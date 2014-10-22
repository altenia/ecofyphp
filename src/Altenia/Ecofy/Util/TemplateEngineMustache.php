<?php namespace Altenia\Ecofy\Util;

/**
 * Represents a set of records with header.
 */
class TemplateEngineMustache extends AbstractTemplateEngine {

	protected $engine = null;

	/**
	 * Initializes the Template Engine
	 * @param {array} $config The configuration data if any
	 */
	public function init($config = null)
	{
		$this->engine = new \Mustache_Engine;
	}


	/**
	 * Renders the template
	 * @param {string} $template The template
	 * @param {array}  $context  The model data to pass as parameter to the template
	 */
	public function render($template, $context)
	{
		return $this->engine->render($template, $context);
	}
}