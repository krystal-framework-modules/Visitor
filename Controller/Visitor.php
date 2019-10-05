<?php

namespace Visitor\Controller;

use Krystal\Stdlib\VirtualEntity;
use Site\Controller\AbstractSiteController;

final class Visitor extends AbstractSiteController
{
    /**
     * Show all visitors of a current user
     * 
     * @return string
     */
    public function indexAction()
    {
        // Id of current user
        $id = $this->getAuthService()->getId();
        
        $visitorService = $this->getModuleService('visitorService');

        $output = $this->view->render('profile/visitors', array(
            'users' => $visitorService->findAll($id)
        ));

        // Mark all items as read
        $visitorService->markAsRead($id);

        return $output;
    }
}
