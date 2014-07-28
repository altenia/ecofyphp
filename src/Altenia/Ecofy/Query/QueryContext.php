<?php namespace Altenia\Ecofy\Query;

/**
 * Class that represents contextual information about query.
 */
class QueryContext {

	public $envelop = false; // Wheter or not to envelop with paging info (only in json)
	public $format  = 'html'; // html, json, csv, xml
	public $page    = null;  // The current page
	public $offset  = null;  // Alternative to page: an offset
	public $limit   = 20;    // Maximum number of entries to return
	public $qparams;         // The query parameters used for data query
	public $boolop  = 'or';  // Wheter to conjunct (and) or disjunct (or) 

	public function __construct($loadFromInput = true) {
		if ($loadFromInput) {
			$this->fromInput();	
		}
    }

    /**
     * Returns the array representation of the context
     */
    public function toArray()
    {
    	return array(
    		'format' => $this->format,
    		'page' => $this->page,
    		'offset' => $this->offset,
    		'limit' => $this->limit,
    		'qparams' => $this->qparams,
    		'boolop' => $this->boolop
    		);
    }

	/**
	 * Generates links to download files
	 */
	public function fromInput()
	{
		$this->envelop = \Input::get('_envelop', 0); // Whether or not to wrap in envelop including paging info
		$this->format  = \Input::get('_format', 'html');
		$this->page    = \Input::get('_page', null);
		$this->offset  = \Input::get('_offset', null);
		$this->limit   = \Input::get('_limit', 20);
		// @todo - Iterate \Input::all() removing those that starts with '_' 
		//$this->qparams = \Input::except(array('_envelop', '_format', '_offset', '_page', '_limit'));
		$this->loadQParams();

	}

	// Loads Query parameters
	private function loadQParams()
	{
		$this->qparams = array();
		foreach(\Input::all() as $name => $val)
		{
			if ($name[0] !== '_' && trim($val) !== '' ) {
				$this->qparams[$name] = $val;
			}
		}

	}

	/**
	 * Returns the offset, either from the value or calculated form page
	 */
	public function getOffset()
	{
		if ($this->offset !== null) {
			//print("OFF:" . $this->offset);
			return $this->offset;
		}
		if ($this->page !== null) {
			//print("PAG:" . $this->page * $this->limit);
			return $this->page * $this->limit;
		}
		return 0;
	}

	/**
	 * Returns a criteria structure (MongoDB-like) based on the query parameter  
	 */
	public function buildCriteria()
	{
		$criteriaBuilder = new \DocuFlow\Helper\DfCriteriaBuilder();
        $criteria = $criteriaBuilder->buildFromQueryParams($this->qparams);
        return $criteria;
	}

	/**
	 * Returns a criteria structure (MongoDB-like) based on the query parameter  
	 */
	public function buildQueryString()
	{
        return http_build_query($this->qparams);
	}

	/**
	 * Return the value of a queryParam
	 */
	public function getQParamVal($name, $defVal = '')
	{
		return array_key_exists($name, $this->qparams) ? $this->qparams[$name] : $defVal;
	}
}