<?php namespace Altenia\Ecofy\Support;

/**
 * Class that represents contextual information about query.
 */
class ResponseFactoryCsv {

	/**
	 * Name of this factory
	 */
	protected $name;

	/**
	 * Fields record to render
	 * @type array
	 */
	protected $fieldsToRender = null;

	public function __construct($name, $fieldsToRender)
	{
		$this->name = $name;
		$this->fieldsToRender = $fieldsToRender
    }

	/**
	 * @return Response
	 */
	public function makeResponse($queryCtx, &$records)
	{
		$csv_output = '';
	    foreach ($records as $row) {
	    	if ($fieldsToRender == null) {
	    		$csv_output .= implode(',', $row->toArray()) . "\n";
	    	} else {
	    		foreach ($fieldsToRender as $fieldName) {
	    			$csv_output .= $row->$fieldName;
	    		}
	    		$csv_output .= "\n";
	    	}
	    }
	    $csv_output = rtrim($csv_output, "\n");
	    //$output =  mb_convert_encoding($csv_output, 'UCS-2LE', 'UTF-8');
	    $output =  $csv_output;

	    $filename = (array_key_exists('filename', $queryCtx->qparams)) 
	    	? $queryCtx->qparams['filename'] : $this->name . '.csv';

	    $headers = array(
	        'Content-Type' => 'text/csv',
	        'charset' => 'utf-8',
	        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
	    );
	 
	    return Response::make($output, 200, $headers);
	}
}