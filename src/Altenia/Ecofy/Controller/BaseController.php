<?php namespace Altenia\Ecofy\Controller;

use Illuminate\Routing\Controller;
/**
 * Base clas of all Controllers.
 * All the "service" controller classes must follow the naming convention of
 * <ServiceName>Controller.
 */
class BaseController extends Controller {

	const PAGE_SIZE_PNAME = '_page_size';

	public $breadcrumb = array();

	/**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->afterFilter('@setBredcrumbFilter');
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function setContentTitle($title)
	{
		View::share('content_header', $title);
	}

	protected function addBreadcrumb($breadcrumbItem)
	{
		$this->breadcrumb[] = $breadcrumbItem;
		View::share('breadcrumb', $this->breadcrumb);
	}


	/**
	 * URL return after post (create/update)
	 */
	protected function redirectAfterPost($urlMap, $defaultUrl)
	{
		$return_url = Input::get('_return_url', null);
        if (empty($return_url)) {
        	$submit = Input::get('_submit', 'save');

        	if(array_key_exists($submit, $urlMap)) {
        		$return_url = $urlMap[$submit];
        	} else {
        		$return_url = $defaultUrl;
        	}

        }
        return Redirect::to($return_url);
	}

	protected function toJson($arr, $option = JSON_PRETTY_PRINT)
	{
		return json_encode($arr, $option);
	}

	///////// Filters

	/**
     * Filter the incoming requests.
     */
    public function setBredcrumbFilter($route, $request)
    {
        View::share('breadcrumb', $this->breadcrumb);
    }
}