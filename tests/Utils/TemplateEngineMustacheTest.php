<?php

use Altenia\Ecofy\Util\TemplateEngineMustache;

class TemplateEngineMustacheTest extends PHPUnit_Framework_TestCase {

	/**
	 * Test updating an empty policy
	 */
	public function testRender()
	{
		$te = new TemplateEngineMustache();
		$te->init();
		$context = array('var' => 'Ecofy');
    	$subject = $te->render('Hello {{var}}', $context);
    	$this->assertEquals('Hello Ecofy', $subject);
	}
}