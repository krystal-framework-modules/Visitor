<?php

namespace Visitor\Storage\MySQL;

use Krystal\Db\Sql\AbstractMapper;
use User\Storage\MySQL\UserMapper;

final class VisitorMapper extends AbstractMapper
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'users_visitors';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPk()
    {
        return 'id';
    }

    /**
     * Mark all items as read
     * 
     * @param int $ownerId
     * @return boolean
     */
    public function markAsRead($ownerId)
    {
        $db = $this->db->update(self::getTableName(), array('viewed' => '1'))
                       ->whereEquals('owner_id', $ownerId);

        return (bool) $db->execute(true);
    }

    /**
     * Counts a number of new visitors
     * 
     * @param int $ownerId
     * @return int
     */
    public function countNew($ownerId)
    {
        $db = $this->db->select()
                       ->count($this->getPk())
                       ->from(self::getTableName())
                       ->whereEquals('owner_id', $ownerId)
                       ->andWhereEquals('viewed', '0');

        return (int) $db->queryScalar();
    }

    /**
     * Find all visitors of a current user
     * 
     * @param int $ownerId
     * @return array
     */
    public function findAll($ownerId)
    {
        // Columns to be selected
        $columns = array(
            UserMapper::column('id'),
            UserMapper::column('name'),
            UserMapper::column('birthday'),
            self::column('datetime'),
            self::column('viewed'),
        );

        $db = $this->db->select($columns)
                       ->from(self::getTableName())
                       // User relation
                       ->leftJoin(UserMapper::getTableName(), array(
                            UserMapper::column('id') => self::getRawColumn('visitor_id')
                       ))
                       ->whereEquals(self::column('owner_id'), $ownerId)
                       ->orderBy(self::column('id'))
                       ->desc();

        return $db->queryAll();
    }
}
