<?php

namespace Site\Components;

use Reverb\System\ComponentBase;
use Site\Config\SiteConfig;
use Site\Models\HouseholdRepository;
use Site\Models\MealRepository;


class Planner extends ComponentBase
{
    public function __construct(MealRepository $mealRepository, HouseholdRepository $householdRepository)
    {
        $this->mealRepository = $mealRepository;
        $this->householdRepository = $householdRepository;
    }

    protected function RequiresAuthentication()
    {
        return false;
    }

    protected function Index($params)
    {
        $meals         = $this->mealRepository->GetAllMealsWithIngredients();
        $kitchenItems  = $this->householdRepository->GetAllKitchenItems();
        $bathroomItems = $this->householdRepository->GetAllBathroomItems();

        $this->ExposeVariable('meals', $meals);
        $this->ExposeVariable('kitchenItems', $kitchenItems);
        $this->ExposeVariable('bathroomItems', $bathroomItems);

        $this->ExposePartialTemplate('meallist');
         $this->ExposePartialTemplate('bathroomlist');
        $this->ExposePartialTemplate('kitchenlist');
    }

    protected function GetListForMeals($params)
    {
        $mealIds = $params['meals'];

        $mealsWithIngredients = $this->mealRepository->GetAllMealsWithIngredients($mealIds);

        $ingredientsList = [];
        foreach ($mealsWithIngredients as $meal) {
            foreach ($meal['ingredients'] as $ingredient) {
                if (!in_array($ingredient, $ingredientsList)) {
                    $ingredientsList[] = $ingredient;
                }
            }
        }

        sort($ingredientsList);

        $this->ExposeVariable('list', $ingredientsList);
    }
}
