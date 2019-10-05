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
