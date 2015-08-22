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


class MealRepository extends ModelBase {

    public function __construct()
    {
        $this->modelName = 'meal';
    }

    public function GetAllMealsWithIngredients($mealIds = [])
    {
        $sql = new Sql($this->getDbAdapter());
        $select = $sql->select()
            ->columns(['meal_id' => 'id', 'meal_name' => 'name'])
            ->from(['m' => 'meal'])
            ->join(
                ['mi' => 'meal_ingredient'],
                'm.id = mi.meal_id',
                [],
                Select::JOIN_LEFT
            )
            ->join(
                ['i' => 'ingredient'],
                'i.id = mi.ingredient_id',
                ['ingredient_id' => 'id', 'ingredient_name' => 'name'],
                Select::JOIN_LEFT
            );

        if (!empty($mealIds)) {
            $select->where(['m.id' => $mealIds]);
        }

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        return $this->ProcessMealsAndIngredients($result);
    }

    private function ProcessMealsAndIngredients(ResultInterface $mealResultObject)
    {
        $processedMeals = [];
        foreach ($mealResultObject as $row) {
            $mealId = $row['meal_id'];

            if (!isset($processedMeals[$mealId])) {
                $processedMeals[$mealId] = [
                    'meal_name' => $row['meal_name'],
                    'ingredients' => [],
                ];
            }

            if (!is_null($row['ingredient_id'])) {
                $processedMeals[$mealId]['ingredients'][$row['ingredient_id']] = $row['ingredient_name'];
            }
        }

        return $processedMeals;
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

    public function AddIngredientToMeal($mealId, $ingredientId)
    {
        $sql = new Sql($this->GetDbAdapter(), 'meal_ingredient');
        $insert = $sql->insert()
            ->columns(['meal_id', 'ingredient_id'])
            ->values(['meal_id' => $mealId, 'ingredient_id' => $ingredientId]);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        return $result !== false;
    }
}