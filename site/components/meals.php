<?php

namespace Site\Components;

use Reverb\System\ComponentBase;
use Site\Models\MealRepository;


class Meals extends ComponentBase
{
    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    protected function RequiresAuthentication()
    {
        return false;
    }

    protected function Index($params)
    {
    }

    protected function GetMeals()
    {
        //$meals = $this->mealRepository->GetAll();
        $meals = $this->mealRepository->GetAllMealsWithIngredients();
        $this->ExposeVariable("meals", $meals);
    }

    protected function AddMeal($params)
    {
        $newId = $this->mealRepository->AddMeal($params['name']);

        $this->ExposeVariable('success', $newId !== false);
    }

    protected function EditMeal($params)
    {
        $mealId  = $params['id'];
        $newName = $params['name'];

        $affectedRows = $this->mealRepository->EditMeal($mealId, $newName);

        $this->ExposeVariable('success', $affectedRows > 0);
    }
}
