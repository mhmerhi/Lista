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

    public function GetAllKitchenItems()
    {
        $sql = new Sql($this->GetDbAdapter());
        $select = $sql->select()
            ->columns(['item_id' => 'id', 'item_name' => 'name'])
            ->from(['hh' => 'household_item'])
            ->join(
                ['ht' => 'household_item_type'],
                'ht.id = hh.type_id',
                ['type_name' => 'name'],
                SELECT::JOIN_LEFT
            )->where('ht.name = "Kitchen"');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $kitchenItems = $result;

        return $kitchenItems;
    }

    public function GetAllBathroomItems()
    {
        $sql = new Sql($this->GetDbAdapter());
        $select = $sql->select()
            ->columns(['item_id' => 'id', 'item_name' => 'name'])
            ->from(['hh' => 'household_item'])
            ->join(
                ['ht' => 'household_item_type'],
                'ht.id = hh.type_id',
                ['type_name' => 'name'],
                SELECT::JOIN_LEFT
            )
            ->where('ht.name = "Bathroom"');

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $bathroomItems = $result;


        return $bathroomItems;
    }
}