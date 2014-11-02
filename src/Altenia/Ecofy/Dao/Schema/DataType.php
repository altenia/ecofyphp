<?php namespace Altenia\Ecofy\Dao\Schema;

/**
 * Generic Data Type.
 */
class DataType {

	const TYPE_DATETIME = 'DateTime';
	const TYPE_STRING = 'String';
	const TYPE_NUMERIC = 'Numeric';


	public $name;
	public $isNullable = false;
	public $size;
	public $attribs;

	public function __construct($name, $attribs)
    {
    	$this->name = $name;
    	$this->attribs = $attribs;
    	if (!empty($attribs) && array_key_exists('is_nullable', $attribs)) {
    		$this->isNullable = $attribs['is_nullable'];
    	}
    }

    public function getName()
    {
    	return $this->name;
    }

}
