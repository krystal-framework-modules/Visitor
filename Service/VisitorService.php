<?php

namespace Visitor\Service;

use Krystal\Date\TimeHelper;
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

    /**
     * Mark all items as read
     * 
     * @param int $ownerId
     * @return boolean
     */
    public function markAsRead($ownerId)
    {
        return $this->visitorMapper->markAsRead($ownerId);
    }

    /**
     * Counts a number of new visitors
     * 
     * @param int $ownerId
     * @return int
     */
    public function countNew($ownerId)
    {
        return $this->visitorMapper->countNew($ownerId);
    }

    /**
     * Find all visitors of a current user
     * 
     * @param int $ownerId
     * @return array
     */
    public function findAll($ownerId)
    {
        return $this->visitorMapper->findAll($ownerId);
    }

    /**
     * Visit someone's profile
     * 
     * @param int $ownerId
     * @param int $visitorId Profile id to be visited
     * @return boolean Depending on success
     */
    public function visit($ownerId, $visitorId)
    {
        // Can't visit self
        if ($ownerId == $visitorId) {
            return false;
        }

        // Data to be inserted
        $data = array(
            'owner_id' => $ownerId,
            'visitor_id' => $visitorId,
            'datetime' => TimeHelper::getNow(),
            'viewed' => 0
        );

        return $this->visitorMapper->persist($data);
    }
}
