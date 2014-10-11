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
		$this->fieldsToRender = $fieldsToRender;
    }

	/**
	 * @return Response
	 */
	public function makeResponse($queryCtx, &$records)
	{
		$csv_output = $this->headerCsv($records);
		$numFields = count($this->fieldsToRender);
	    foreach ($records as $row) {
	    	// if fields not specified, return all fields
	    	if ($this->fieldsToRender == null) {
	    		$csv_output .= implode(',', $row->toArray()) . "\n";
	    	} else {

	    		for ($i = 0; $i < $numFields; ++$i) {
	    			$fieldName = $this->fieldsToRender[$i];
	    			$fieldVal = '';
	    			if (\Altenia\Ecofy\Util\StringUtil::endsWith($fieldName, '()')) {
	    				$methodName = substr($fieldName, 0, -2);
		    			$fieldVal = $row->$methodName();
		    		} else {
		    			$fieldVal = $row->$fieldName;
		    		}
	    			$csv_output .= '"' . $fieldVal . '"';
	    			if ($i < $numFields - 1) {
	    				$csv_output .= ',';
	    			}
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
	 
	    return \Response::make($output, 200, $headers);
	}

	private function headerCsv(&$records)
	{
		$header = '';
    	if ($this->fieldsToRender == null) {
    		$header = implode(',', $records[0]->toArray()) . "\n";
    	} else {
    		$header = implode(',', $this->fieldsToRender) . "\n";
    	}
    	return $header;
	} 
}