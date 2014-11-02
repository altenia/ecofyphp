<?php namespace Altenia\Ecofy\Dao\Schema;

/**
 * DateTIme Data Type.
 */
class TypeDateTime extends DataType {

	public function __construct($attribs)
    {
    	parent::__construct('DateTime', $attribs);
    }

}
