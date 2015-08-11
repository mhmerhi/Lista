<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:47
 */

namespace Site\Components\Service;


use Reverb\System\DependencyContainer;
use Site\Components\Planner;

class PlannerFactory {

    public function CreateInstance(DependencyContainer $dependencyContainer)
    {
        $mealRepository = $dependencyContainer->GetInstance('MealRepository');

        return new Planner($mealRepository);
    }
}