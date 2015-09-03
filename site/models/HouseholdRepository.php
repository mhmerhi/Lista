<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:38
 */
namespace Site\Models;

use Reverb\System\ModelBase;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;


class HouseholdRepository extends ModelBase {

    public function __construct()
    {
        $this->modelName = 'household_item';
    }
}