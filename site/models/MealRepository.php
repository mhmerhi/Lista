<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:38
 */
namespace Site\Models;

use Reverb\System\ModelBase;
use Zend\Db\Sql\Predicate\Predicate;
use Zend\Db\Sql\Sql;


class MealRepository extends ModelBase {

    public function __construct()
    {
        $this->modelName = 'meal';
    }

    public function AddMeal($mealName)
    {
        $sql = new Sql($this->getDbAdapter(), 'meal');
        $insert = $sql->insert()
            ->columns(['name'])
            ->values(['name' => $mealName]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $newId = $statement->execute()->getGeneratedValue();

        return $newId;
    }

    public function EditMeal($id, $name)
    {
        $sql = new Sql($this->getDbAdapter(), 'meal');
        $update = $sql->update()
            ->set(['name' => $name])
            ->where(['id' => $id]);

        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute()->getAffectedRows();

        return $result;
    }
}