<?php namespace Altenia\Ecofy\Util;

/**
 * Represents a set of records with header.
 */
abstract class AbstractTemplateEngine {

	/**
	 * Initializes the Template Engine
	 * @param {array} $config The configuration data if any
	 */
	abstract public function init($config = null);


	/**
	 * Renders the template
	 * @param {string} $template The template
	 * @param {array}  $context  The model data to pass as parameter to the template
	 */
	abstract public function render($template, $context);
}