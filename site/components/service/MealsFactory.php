<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:47
 */

namespace Site\Components\Service;


use Reverb\System\DependencyContainer;
use Site\Components\Meals;

class MealsFactory {

    public function CreateInstance(DependencyContainer $dependencyContainer)
    {
        $mealRepository       = $dependencyContainer->GetInstance('MealRepository');
        $ingredientRepository = $dependencyContainer->GetInstance('IngredientRepository');

        return new Meals($mealRepository, $ingredientRepository);
    }
}