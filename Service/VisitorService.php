<?php

namespace Visitor\Service;

use Krystal\Application\Model\AbstractService;
use Visitor\Storage\MySQL\VisitorMapper;

final class VisitorService extends AbstractService
{
    /**
     * Any compliant mapper
     * 
     * @var \Visitor\Storage\MySQL\VisitorMapper
     */
    private $visitorMapper;

    /**
     * State initialization
     * 
     * @param \Visitor\Storage\MySQL\VisitorMapper $visitorMapper     
     * @return void
     */
    public function __construct(VisitorMapper $visitorMapper)
    {
        $this->visitorMapper = $visitorMapper;
    }
}
