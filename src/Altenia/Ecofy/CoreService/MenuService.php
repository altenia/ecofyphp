<?php namespace Altenia\Ecofy\CoreService;


/**
 * Service class that provides business logic for category
 */
class MenuService extends BaseService {

    const MODE_TEST = 0;
	
    /**
     * Constructor
     */
    public function __construct($id = 'menu')
    {
        parent::__construct($id);
    }

    /**
     * {string|array} - String is url, array is submenu
     */
    private function createMenuItem($title, $content, $iconName = null)
    {
        $iconHtml = '';
        if (!empty($iconName)) {
            if (starts_with($iconName, 'glyphicon-')) {
                $iconHtml = '<span class="glyphicon ' . $iconName . '"></span>';
            } else if (starts_with($iconName, 'fa-')) {
                $iconHtml = '<i class="fa ' . $iconName . '"></i>';
            }
        }
        // Array of format [(<Title>, <Url_Path>, <icon>)]
        return array($title, $content, $iconHtml);
    }

    public function getMenu($mode = MenuService::MODE_TEST)
    {
    	$menus = array();

        if(\Auth::check())
        {
            $ac = $this->getAccessControlService()->findAccessControlByUser(\Auth::user());


            // Populate the admin menu {{
            $serviceRegistry = \App::make('svc:service_registry');

            $menu_admin = array();
            foreach ($serviceRegistry->listServices() as $serviceInfo) {
                if ($ac->check(\AccessControl::FLAG_READ, 'svc:' . $serviceInfo->reference->getId())) {
                    $menu_admin[] = self::createMenuItem($serviceInfo->title, $serviceInfo->url, $serviceInfo->icon);    
                }
            }

            if (sizeof($menu_admin) > 0) {
                $menus['workspace'][] = self::createMenuItem(\Lang::get('site.admin'), $menu_admin, 'glyphicon-cog');
            }
            // }} admin menu

            $documentTypeService = \App::make('svc:document_type');
            $docTypes = $documentTypeService->listDocumentTypes(null, null, 0, 20);
            // List all document types
            $menu_documents = array();
            foreach ($docTypes as $docType) {
                if ($ac->check(\AccessControl::FLAG_READ, 'svc:document_type/item:'. $docType->id)) {
                    $menu_documents[] = self::createMenuItem($docType->name, \URL::to(route('document_types.documents.index', $docType->sid)), 'glyphicon-file');
                }
            }

            if (sizeof($menu_documents) > 0) {
                $menus['workspace'][] = self::createMenuItem(\Lang::get('site.documents'), $menu_documents, 'glyphicon-folder-open');
            }
            
            $menu_favorites = array(
                array('FAL', \URL::to('/page/fal')),
                );
            $menus['workspace'][] = array(\Lang::get('site.favorites'), $menu_favorites, '<span class="glyphicon glyphicon-heart"></span>');

        } else {

            $menus['workspace'][] = self::createMenuItem(\Lang::get('site.signin'), \URL::to('auth/signin' ) );
        }

        return $menus;
    }

}