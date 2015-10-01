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

    public function AddItem($name, $typeId)
    {
        $sql = new Sql($this->GetDbAdapter());
        $insert = $sql->insert('household_item')
            ->columns(['name', 'type_id'])
            ->values(['name' => $name, 'type_id' => $typeId]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute()->getGeneratedValue();

        return $result;
    }

    public function EditItem($id, $name, $typeId)
    {
        $sql = new Sql($this->getDbAdapter(), 'household_item');
        $update = $sql->update()
            ->set(['name' => $name, 'type_id' => $typeId])
            ->where(['id' => $id]);

        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute()->getAffectedRows();

        return $result;
    }

    public function GetAllItems()
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
            );

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        $resultArr = [];
        foreach ($result as $row) {
            $resultArr[$row['item_id']] = ['name' => $row['item_name'], 'type' => $row['type_name']];
        }

        return $resultArr;
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

        return $result;
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

        return $result;
    }

    public function GetAllTypes()
    {
        $sql = new Sql($this->GetDbAdapter());
        $select = $sql->select()
            ->columns(['type_id' => 'id', 'type_name' => 'name'])
            ->from(['ht' => 'household_item_type']);

        $stmt = $sql->prepareStatementForSqlObject($select);
        $result = $stmt->execute();

        $types = [];
        foreach ($result as $type) {
            $types[$type['type_id']] = $type['type_name'];
        }
        return $types;
    }
}