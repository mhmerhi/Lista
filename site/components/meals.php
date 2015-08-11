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
        $this->ExposeVariable("msg", "Meals!");
    }

    protected function GetMeals()
    {
        $meals = $this->mealRepository->GetAll();
        $this->ExposeVariable("meals", $meals);
    }
}
