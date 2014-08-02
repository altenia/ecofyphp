<%namespace name="common" file="/codegen_common.tpl"/><%
    # Python code here
%><?php namespace Service;

/**
 * Models from schema: ${ model['schema-name'] } version ${ model['version'] }
 * Code generated by ${params['TASK_TYPE_NAME']}
 *
 */

use Altenia\Ecofy\Service\BaseService;

% for entity_name, entity_def in model['entities'].iteritems():
/**
 * Service class that provides business logic for ${entity_name}
 */
class ${common.to_camelcase(entity_name, True)}Service extends BaseService {

    /**
     * Constructor
     */
    public function __construct($dao, $id = '${entity_name}')
    {
        parent::__construct($dao, $id);
    }

	/**
	 * Returns list of the records.
	 *
	 * @param array $queryParams  Parameters used for querying
	 * @param int   $offset       The starting record
	 * @param int   $limit        Maximum number of records to retrieve
	 * @return Response
	 */
	public function list${common.to_camelcase(entity_name, True, True)}($queryParams, $offset = 0, $limit=100)
	{
		$query = \${common.to_camelcase(entity_name, True)}::query();
		$query = $this->parseQueryParams($query, $queryParams);
        $records = $query->skip($offset)->take($limit)->get();
		return $records;
	}

	/**
	 * Returns paginated list of the records.
	 *
	 * @param array $queryParams  Parameters used for querying
	 * @param int   $page_size    The max number of entries shown per page
	 * @return Response
	 */
	public function paginate${common.to_camelcase(entity_name, True, True)}($queryParams, $page_size = 20)
	{
		$query = \${common.to_camelcase(entity_name, True)}::query();
		$query = $this->parseQueryParams($query, $queryParams);
        $records = $query->paginate($page_size);
		return $records;
	}

    /**
	 * Returns the count of records satisfying the critieria.
	 *
	 * @param array $queryParams  Parameters used for querying
	 * @return int number of records that satisfied the criteria
	 */
	public function count{common.to_camelcase(entity_name, True, True)}($queryParams)
	{
		$query = \${common.to_camelcase(entity_name, True)}::query();
		$query = $this->parseQueryParams($query, $queryParams);
        $count = $query->count();
		return $count;
	}

	/**
	 * Creates a new records.
	 * Mostly wrapper around insert with pre and post processing.
	 *
	 * @param array $data  Parameters used for creating a new record
	 * @return mixed  null if successful, validation object validation fails
	 */
	public function create${common.to_camelcase(entity_name, True)}($data)
	{

		$validator = \${common.to_camelcase(entity_name, True)}::validator($data);
        if ($validator->passes()) {
            $record = new \${common.to_camelcase(entity_name, True)}();
            $record->fill($data);

            /*
             * @todo: assign default values as needed
             */
            $now = new \DateTime;
            $now_str = $now->format('Y-m-d H:i:s');
            $record->uuid = uniqid();
            $record->created_dt = $now_str;
            $record->updated_dt = $now_str;
            $record->save();
            return $record;
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Retrieves a single record.
	 *
	 * @param  int $id  The primary key for the search
	 * @return ${common.to_camelcase(entity_name, True)}
	 */
	public function find${common.to_camelcase(entity_name, True)}($id)
	{
		$record = \${common.to_camelcase(entity_name, True)}::find($id);

		return $record;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int   $id    The primary key of the record to update
	 * @param  array $data  The data of the update
	 * @return mixed null if successful, validation if validation error
	 */
	public function update${common.to_camelcase(entity_name, True)}($id, $data)
	{
		$validator = \${common.to_camelcase(entity_name, True)}::validator($data);
        if ($validator->passes()) {
            $record = \${common.to_camelcase(entity_name, True)}::find($id);
            $record->fill($data);

            $now = new \DateTime;
            $now_str = $now->format('Y-m-d H:i:s');
            $record->updated_dt = $now_str;
            $record->save();
            return $record;
        } else {
            throw new ValidationException($validator);
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return bool true if deleted, false otherwise
	 */
	public function destroy${common.to_camelcase(entity_name, True)}($id)
	{
		// delete
		$record = \${common.to_camelcase(entity_name, True)}::find($id);
		if (!empty($record)) {
		    $record->delete();
		    return true;
		}
		return false;

	}
}
% endfor
