<?php

namespace Visitor;

use Krystal\Application\Module\AbstractModule;
use Visitor\Service\VisitorService;

final class Module extends AbstractModule
{
    /**
     * Returns routes of this module
     * 
     * @return array
     */
    public function getRoutes()
    {
        return include(__DIR__ . '/Config/routes.php');
    }

    /**
     * Returns prepared service instances of this module
     * 
     * @return array
     */
    public function getServiceProviders()
    {
        return array(
            'visitorService' => new VisitorService($this->createMapper('\Visitor\Storage\MySQL\VisitorMapper'))
        );
    }
}
