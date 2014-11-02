<?php namespace Altenia\Ecofy\Dao\Schema;

/**
 * DateTIme Data Type.
 */
class Schema {

	public $fields;

	public function __construct()
    {
    	$this->fields = array();
    }

	/**
	 * @param {string} $name    Name of the field
	 * @param {array}  $attribs Field attributes
	 */
	public function addField($name, $typeName, $attribs = null)
	{
		//$typeClass = $typeName;
		//$typeObject = new $typeClass($attribs);
		//$this->fields[$name] = $typeObject;

		$this->fields[$name] = new DataType($typeName, $attribs);
	}

	public function getFields()
	{
		return $this->fields;
	}
}
