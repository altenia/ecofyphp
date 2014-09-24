<?php namespace Altenia\Ecofy\Support;

use Altenia\Ecofy\Util\StringUtil;
use Altenia\Ecofy\Service\ServiceRegistry;
use Altenia\Ecofy\CoreService\PredefinedAcl;
use Altenia\Ecofy\CoreService\AccessControl;

/**
 * Authorization (AccessControl) Facade
 */
class AuthzFacade {

	private static $accessControlService = null;
		
	public static function getAccessControlService() {
		if (self::$accessControlService == null) {
			self::$accessControlService = ServiceRegistry::instance()->findById('access_control');
		}
		return self::$accessControlService;
	}

	/**
	 *
	 */
	public static function deduceResourceAndPermission()
	{
		$controllerAndAction = self::tokenizeActionName();

		// path sample: document_types/{document_types}/documents/{documents}/edit
		$resource = self::deduceResource($controllerAndAction[0]);
		$permission = self::deducePermission($controllerAndAction[1]);

		return array($resource, $permission);
	}

	/**
	 *
	 */
	public static function getAccessControl($user)
	{
		if (\Session::has('access_control')) {
			$ac = \Session::get('access_control');
			return $ac;
		}

		$ac = null;
		if (!empty($user)) {
		    if (!empty($user->type)) {
		    	$ac = PredefinedAcl::get($user->type);
		    } else if (self::getAccessControlService() != null && 
				!empty($user->role_sid)
				)
		    {
				$criteria = array( 'role_sid' => $user->role_sid, 'service' => 'root' );
		        $ac = self::getAccessControlService()->findAccessControl($criteria);
		    }
		}
    	if (empty($ac)) {
    		$ac = PredefinedAcl::get('default');
    	}

    	\Session::set('access_control', $ac);

		return $ac;
	}

	public static function removeSession()
	{
		\Session::forget('access_control');
	}

	/**
	 *
	 */
	public static function check($permission, $resource)
	{
		$user = \Auth::user();

		$ac = self::getAccessControl($user);

		return $ac->check($permission, $resource);
	}

	/**
	 * Returns true if the current route (service/action) is authorized 
	 * for the current user
	 */
	public static function checkRouteAccess()
	{
		/*
		$controllerAndAction = self::tokenizeActionName();

		// path sample: document_types/{document_types}/documents/{documents}/edit
		$resource = self::deduceResource($controllerAndAction[0]);
		$permission = self::deducePermission($controllerAndAction[1]);
		*/
		list($resource, $permission) = self::deduceResourceAndPermission();

		//$ac = self::getAccessControlService()->findAccessControlByUser(\Auth::user());
		//return $ac->check($permission, $resource);
		return self::check($permission, $resource);
	}


	/**
	 * The route: 
	 *  <base-url>/document_types/~fal1/documents/536ecb2abf5c35d03c0041af/edit
	 * will return:
	 *  svc:document_types/item:fal1/svc:documents
	 * svc:documen_types
	 */
	public static function deduceResource($controllerName)
	{
		// 1. Obtain controller name from getActionName()
		// 2. Remove 'Conroller' suffix and use it as the service name
		// 3. If such service exits, get create an array with Container's services name (all the way to root service)
		// 3.1. The resource string is "svc:<container_svc_root>/item:<param[0]>[/svc:<conatiner_service>]"
		// 4. If no such service exists, just use the service name as-is with /<param-key>:<param-val>. 
		$resource = '';
		// Remove 'Controller' suffix
		$serviceName = substr($controllerName, 0,  - 10); 
		if (StringUtil::endsWith($serviceName, 'Api')) {
			// Remove 'Api'
			$serviceName = substr($serviceName, 0,  - 3); 
		}
		$serviceName = snake_case($serviceName);

		$serviceInfo = ServiceRegistry::instance()->findById($serviceName);
		if ($serviceInfo !== null) {
			// parameters's sample: Array ( [document_types] => ~fal1 [documents] => 536ecb2abf5c35d03c0041af ) 
			// @todo - remove initial non-resource params (e.g. the domainId)
			$params = array_values(\Route::current()->parameters());
			$servicePath = $serviceInfo->reference->getServicePath();

			$servicePathCnt = count($servicePath);
			$paramsCnt = count($params);
			for ($i = 0; $i < $servicePathCnt; $i ++) {
				$itemPart = ( $paramsCnt > $i) ? '/item:' . $params[$i] : '';
                                if ($i > 0) $resource .= '/';
				$resource .= 'svc:' . $servicePath[$i] . $itemPart;
			}
		} else {
			$resource = $serviceName;
		}
		return $resource;

	}

	public static function deducePermission($actionType)
	{
		// routeName sample : document_types.documents.show  (only works for resources)
		//$routeName = \Route::current()->getName();
		//$lastDotPos = strrpos($routeName, '.');
		// actionName sample: DocumentController@edit

		if (StringUtil::startsWith($actionType, 'index'))
			return AccessControl::FLAG_READ;
		if (StringUtil::startsWith($actionType, 'show'))
			return AccessControl::FLAG_READ;
		if (StringUtil::startsWith($actionType, 'create'))
			return AccessControl::FLAG_CREATE;
		if (StringUtil::startsWith($actionType, 'store'))
			return AccessControl::FLAG_CREATE;
		if (StringUtil::startsWith($actionType, 'edit'))
			return AccessControl::FLAG_UDPATE;
		if (StringUtil::startsWith($actionType, 'update'))
			return AccessControl::FLAG_UDPATE;
		if (StringUtil::startsWith($actionType, 'destroy'))
			return AccessControl::FLAG_DELETE;
		return AccessControl::FLAG_READ;
	}


	/**
	 * Returns an array of [<ControllerName>, <action_type>]
	 */
	public static function tokenizeActionName()
	{
		$actionName = \Route::current()->getActionName();
		$arrobaPos = strrpos($actionName, '@');

		return array(
			substr($actionName, 0, $arrobaPos),
			substr($actionName, $arrobaPos + 1)
			);
	}

}