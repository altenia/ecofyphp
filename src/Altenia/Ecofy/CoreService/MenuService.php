<?php namespace Altenia\Ecofy\CoreService;

use Altenia\Ecofy\Service\BaseService;

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
        parent::__construct(null, $id);
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
                if ( !($serviceInfo->reference instanceof MenuService) ) {
                    if ($ac->check(\AccessControl::FLAG_READ, 'svc:' . $serviceInfo->reference->getId())) {
                        $menu_admin[] = self::createMenuItem($serviceInfo->title, $serviceInfo->url, $serviceInfo->icon);    
                    }
                }
            }

            if (sizeof($menu_admin) > 0) {
                $menus['workspace'][] = self::createMenuItem(\Lang::get('site.admin'), $menu_admin, 'glyphicon-cog');
            }
            // }} admin menu

        } else {

            $menus['workspace'][] = self::createMenuItem(\Lang::get('site.signin'), \URL::to('auth/signin' ) );
        }

        return $menus;
    }

}