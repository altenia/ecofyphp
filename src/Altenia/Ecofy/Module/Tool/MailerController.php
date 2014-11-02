<?php namespace Altenia\Ecofy\Module\Tool;

use Altenia\Ecofy\Util\StringUtil;
use Altenia\Ecofy\Controller\BaseController;
use Altenia\Ecofy\Util\Mailer;

class MailerController extends BaseController {

	protected $layout = 'layouts.workspace';

  	/**
	 * Array of {name, title, model_class_name, model_name, importStrategy}
	 */
	protected $datasources = array();
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->addBreadcrumb(['import']);
		$this->setContentTitle('Import' );

		$this->addDatasource('persons', \Lang::get('person._name')
			, 'Person', 'Persons', 'Altenia\Ecofy\Module\Person\Person' );

    }

    public function addDatasource($name, $title, $modelName, $modelNamePlural, $modelClassName)
    {
    	$this->datasources[$name] = array(
	    		'name' => $name, 'title' => $title, 
	    		'model_name' => $modelName, 'model_name_plural' => $modelNamePlural, 'model_class_name' => $modelClassName
    		);
    }


	public function auxdata()
	{
		
		$auxdata['opt_type'] = array();
		foreach($this->datasources as $datasource) {
			$auxdata['opt_type'][$datasource['name']] = $datasource['title'];
		}
		
		return $auxdata;
	}
	
	/**
	 * Displays Form  
	 */
	public function getForm() {
		
		if (!\Auth::check()) {
			\Session::flash('message', 'No permission. Sign-in first.') ;
			return \Redirect::to('auth/nopermission');
			\App::abort(401);
		}

		$type = \Input::get('type');
		$dataQuery = \Input::get('dataQuery');
		$pageNum = \Input::get('pageNum', 1);
		$pageSize = \Input::get('pageSize', 20);

		$subjectTemplate = \Input::get('subjectTemplate');
		$bodyTemplate = \Input::get('bodyTemplate');

		$smtpServer = \Input::get('smtpServer');
		$smtpUsername = \Input::get('smtpUsername');
		$smtpPassword = \Input::get('smtpPassword');

		$this->layout->content = \View::make('tool.mailer')
			->with('type', $type)
			->with('dataQuery', $dataQuery)
			->with('pageNum', $pageNum)
			->with('pageSize', $pageSize)

			->with('subjectTemplate', $subjectTemplate)
			->with('bodyTemplate', $bodyTemplate)

			->with('smtpServer', $smtpServer)
			->with('smtpUsername', $smtpUsername)
			->with('smtpPassword', $smtpPassword)

			->with('auxdata', $this->auxdata());
	}

	// POST 
	public function postForm() {
		
		if (!\Auth::check()) {
			\App::abort(401);
		}

		$mode = \Input::get('mode');
		$type = \Input::get('type');
		$dataQuery = \Input::get('dataQuery');
		$pageNum = \Input::get('pageNum');
		$pageSize = \Input::get('pageSize');
		$subjectTemplate = \Input::get('subjectTemplate');
		$bodyTemplate = \Input::get('bodyTemplate');

		$smtpServer = \Input::get('smtpServer');
		$smtpUsername = \Input::get('smtpUsername');
		$smtpPassword = \Input::get('smtpPassword');

		$config = $this->mailConfigFromUser(\Auth::user());

		//print_r($config); die();
		$mailer = new Mailer($config);

		$result = $this->handlePost($type, $mode, $dataQuery, $pageNum, $pageSize, $subjectTemplate, $bodyTemplate, $mailer);

		$this->layout->content = \View::make('tool.mailer')
			->with('mode', $mode)
			->with('type', $type)
			->with('dataQuery', $dataQuery)
			->with('pageNum', $pageNum)
			->with('pageSize', $pageSize)
			->with('subjectTemplate', $subjectTemplate)
			->with('bodyTemplate', $bodyTemplate)

			->with('smtpServer', $smtpServer)
			->with('smtpUsername', $smtpUsername)
			->with('smtpPassword', $smtpPassword)

			->with('result', $result)
			->with('isvalid', empty($result['errors']))
			->with('auxdata', $this->auxdata());
	}

	/**
	 * process post
	 */
	private function handlePost($type, $mode, $dataQuery, $pageNum, $pageSize, $subjectTemplate, $bodyTemplate, $mailer)
	{
		$result = array();
		$datasource = $this->datasources[$type];
		$modelFqn = '\\' . $datasource['model_class_name'];
		$service = $this->getService(snake_case($datasource['model_name']));

		$listMethod = 'list' . $datasource['model_name_plural'];

		parse_str($dataQuery, $queryParams);
//print_r($queryParams);
		$criteriaBuilder = new \Altenia\Ecofy\Support\CriteriaBuilder();
        $criteria = $criteriaBuilder->buildFromQueryParams($queryParams);
//print_r($criteria);

        $offset = $pageNum * $pageSize;
		$records = $service->$listMethod($criteria, array(), $offset, $pageSize);
//print_r($records);
//die();

		$recipentsKey = 'email';

		if (count($records) > 0) {
			$user = \Auth::user();
			
			if ($mode == 'process') {
				//die('not yet');
				// process mode
				$sender = array($user->email => $user->getFullName());
				$result = $mailer->sendBulkTemplateMail($sender, $recipentsKey, $records, $subjectTemplate, $bodyTemplate);
			} else {
				// preview mode
				$te = $mailer->getTemplateEngine();
				foreach($records as $record) {
					$recipient = $record[$recipentsKey];

					if (!empty($recipient)){
						$subject = $te->render($subjectTemplate, $record);
	    				$body = $te->render($bodyTemplate, $record);

						$result['preview'][] = array(
								'status' => $record->status,
								'recipients' => $recipient,
								'subject' => $subject, 'body' => $body
							);
					}
				}
			}
		}

		//print_r($result);
		//die();
		return $result;
	}

	/**
	 * Returns the mailer config
	 */
	private function mailConfigFromUser($user)
	{
		$mailConfig = array();
		if (StringUtil::endsWith($user->email, 'gmail.com')) {
			$mailConfig['server'] = 'smtp.gmail.com:465';
			$atSignPos = strpos($user->email, '@');
			$mailConfig['username'] = substr($user->email, 0, $atSignPos);

			$attribs = $user->getAttributes();
			if (!empty($attribs) && array_key_exists('smtp_pwd', $attribs)) {
				$mailConfig['password'] = $attribs['smtp_pwd'];
			}
		}
		return $mailConfig;
	}

}