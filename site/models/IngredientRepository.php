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
use Zend\Db\Sql\Where;


class IngredientRepository extends ModelBase {

    public function __construct()
    {
        $this->modelName = 'ingredient';
    }

//    public function GetAllMealsWithIngredients()
//    {
//        $sql = new Sql($this->getDbAdapter());
//        $select = $sql->select()
//            ->columns(['meal_id' => 'id', 'meal_name' => 'name'])
//            ->from(['m' => 'meal'])
//            ->join(
//                ['mi' => 'meal_ingredient'],
//                'm.id = mi.meal_id',
//                [],
//                Select::JOIN_LEFT
//            )
//            ->join(
//                ['i' => 'ingredient'],
//                'i.id = mi.ingredient_id',
//                ['ingredient_id' => 'id', 'ingredient_name' => 'name'],
//                Select::JOIN_LEFT
//            );
//
//        $statement = $sql->prepareStatementForSqlObject($select);
//        $result = $statement->execute();
//
//        return $this->ProcessMealsAndIngredients($result);
//    }
//
//    public function AddMeal($mealName)
//    {
//        $sql = new Sql($this->getDbAdapter(), 'meal');
//        $insert = $sql->insert()
//            ->columns(['name'])
//            ->values(['name' => $mealName]);
//
//        $statement = $sql->prepareStatementForSqlObject($insert);
//        $newId = $statement->execute()->getGeneratedValue();
//
//        return $newId;
//    }
//
//    public function EditMeal($id, $name)
//    {
//        $sql = new Sql($this->getDbAdapter(), 'meal');
//        $update = $sql->update()
//            ->set(['name' => $name])
//            ->where(['id' => $id]);
//
//        $statement = $sql->prepareStatementForSqlObject($update);
//        $result = $statement->execute()->getAffectedRows();
//
//        return $result;
//    }

    public function GetIdByName($ingredientName, $createIfNotFound = false)
    {
        $sql = new Sql($this->GetDbAdapter());
        $select = $sql->select('ingredient')
            ->columns(['id'])
            ->where('trim(lower(name)) = "'.trim($ingredientName).'"');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if ($result->current()) {
            return $result->current()['id'];
        }

        // Didn't find a match, create a new ingredient!
        $newIngredientId = $this->AddIngredient($ingredientName);

        return $newIngredientId;
    }

    private function AddIngredient($name)
    {
        $sql = new Sql($this->getDbAdapter(), 'ingredient');
        $insert = $sql->insert()
            ->columns(['name'])
            ->values(['name' => $name]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $newId = $statement->execute()->getGeneratedValue();

        return $newId;
    }
}