<?php

namespace Site\Components;

use Reverb\System\ComponentBase;
use Site\Models\IngredientRepository;
use Site\Models\MealRepository;


class Meals extends ComponentBase
{
    private $mealRepository;
    private $ingredientRepository;

    public function __construct(MealRepository $mealRepository, IngredientRepository $ingredientRepository)
    {
        $this->mealRepository       = $mealRepository;
        $this->ingredientRepository = $ingredientRepository;
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

    protected function AddIngredientToMeal($params)
    {
        $mealId = $params['mealId'];
        $newIngredient = $params['ingredientName'];

        // check to see if ingredient already exists, and create it if not!
        $ingredientId = $this->ingredientRepository->GetIdByName($newIngredient, true);
        // add ingredient to meal
        $success = $this->mealRepository->AddIngredientToMeal($mealId, $ingredientId);

        $this->ExposeVariable('success', $success);
    }
}
