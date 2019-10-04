<?php

namespace Visitor\Storage\MySQL;

use Krystal\Db\Sql\AbstractMapper;

final class VisitorMapper extends AbstractMapper
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return 'users_visitors';
    }
}
