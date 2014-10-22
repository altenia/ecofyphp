<?php namespace Altenia\Ecofy\Module\Tool;

use \Altenia\Ecofy\Controller\BaseController;

class ImportController extends BaseController {

	protected $layout = 'layouts.workspace';

	/**
	 * Array of {name, title, model_class_name, model_name, importStrategy}
	 */
	protected $importables = array();
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->addBreadcrumb(['import']);
		$this->setContentTitle('Import' );

		$this->addImportable('persons', Lang::get('person._name')
			, 'Person', 'Altenia\Ecofy\CoreService\Person', new \Altenia\Ecofy\CoreService\PersonImportStrategy() );

    }

    public function addImportable($name, $title, $modelName, $modelClassName, $strategy = null)
    {
    	$this->importables[$name] = array(
	    		'name' => $name, 'title' => $title, 
	    		'model_name' => $modelName, 'model_class_name' => $modelClassName, 
	    		'strategy' => $strategy
    		);
    }

	public function auxdata()
	{
		
		$auxdata['opt_type'] = array();
		foreach($this->importables as $importable) {
			$auxdata['opt_type'][$importable['name']] = $importable['title'];
		}
		
		$auxdata['opt_onmatch'] = array(
			'update' => Lang::get('import.update'),
			'skip' => Lang::get('import.skip')
			);
		return $auxdata;
	}
	
	/**
	 * Displays Form  
	 */
	public function getForm() {
		$type = \Input::get('type');
		$onmatch = \Input::get('onmatch');
		$keycols = \Input::get('keycols');
		$data = \Input::get('data');
		$this->layout->content = View::make('tool.form')
			->with('type', $type)
			->with('onmatch', $onmatch)
			->with('keycols', $keycols)
			->with('data', $data)
			->with('auxdata', $this->auxdata());
	}

	public function postForm() {
		$type = \Input::get('type');
		$onmatch = \Input::get('onmatch');
		$keycols = \Input::get('keycols');
		$data = \Input::get('data');
		$mode = \Input::get('mode');

		$updateOnMatch = ($onmatch == 'update');
		
		$keycolArr = explode(',', $keycols);
		// Validate
		for($i = count($keycolArr) - 1; $i >= 0; --$i) {
			$keycolArr[$i] = trim($keycolArr[$i]);
			if ( strlen($keycolArr[$i]) == 0) {
				array_splice($keycolArr, $i, 1);
			}
		}

		$rows = Altenia\Ecofy\Util\CsvUtil::toAssociativeArray($data);

		$result = $this->processRecords($type, $mode, $updateOnMatch, $keycolArr, $rows);

		$this->layout->content = View::make('tool.form')
			->with('mode', $mode)
			->with('onmatch', $onmatch)
			->with('keycols', implode(",", $keycolArr))
			->with('type', $type)
			->with('data', $data)
			->with('rows', $rows)
			->with('isvalid', empty($result['errors']))
			->with('result', $result)
			->with('auxdata', $this->auxdata());
	}

	/**
	 * Validates or Processes the records
	 */
	private function processRecords($type, $mode, $updateOnMatch, $keycolArr, &$rows)
	{

		$result = array(
			'errors' => array(),
			'items_count' => 0,
			'items_created_count' => 0,
			'items_updated_count' => 0,
			'items_skipped_count' => 0,
			'items_created' => [],
			'items_updated' => [],
			'items_skipped' => []
			);
		$errors = array();
		$importable = $this->importables[$type];
		$modelFqn = '\\' . $importable['model_class_name'];
		$service = $this->getService(snake_case($importable['model_name']));
		$createMethod = 'create' . $importable['model_name'];

		$findMethod = 'find' . $importable['model_name'];
		$updateMethod = 'update' . $importable['model_name'];

		$importStrategy = $importable['strategy'];

		$linenum = 0;
		$prev_row = null;
		foreach ($rows as &$row) {
			$linenum++;
			
			if ($importStrategy !== null)
				$importStrategy->prepareInput($row, $prev_row);
			$validator = $modelFqn::validator($row);
			$prev_row = $row;

	        if (!$validator->passes()) {
	        	$errors[] = array('line' => $linenum, 'message' => $validator->messages()->toArray());
			} else {
				if ($mode == 'process') {
					try {
						$record = null;

						$findCriteria = array();
						foreach ($keycolArr as $keyCol) {
							$findCriteria[$keyCol] = $row[$keyCol];
						}
						$record = $service->$findMethod($findCriteria);

						if ( empty($record) ) {
							if ($importStrategy !== null)
								$importStrategy->beforeRecordInsert($row, $errors);
							$record = $service->$createMethod($row);
							if ($importStrategy !== null)
								$importStrategy->afterRecordInsert($service, $record, $row, $errors);
							$result['items_created'][] = $row[$keycolArr[0]];
							$result['items_created_count']++;
						} else {
							$service->$updateMethod($record->sid, $row);
							if ($importStrategy !== null)
								$importStrategy->afterRecordUpdate($service, $record, $row, $errors);
							$result['items_updated'][] = $row[$keycolArr[0]];
							$result['items_updated_count']++;
						}

					} catch (Exception $ex) {
						$errors[] = array('line' => $linenum, 'message' => $ex->getMessage());
					}
				}
			}
		}
		$result['errors'] = $errors;
		$result['items_count'] = count($rows);

		return $result;
	}


	public function dateToIso($time_val, $outputFormat = 'Y-m-d H:i:s', $inputFormat = 'm/d/y')
	{
		$time = DateTime::createFromFormat($inputFormat, $time_val);
		//$time = new DateTime($time_val);
        $time_str = $time->format($outputFormat);
        return $time_str;
	}

}