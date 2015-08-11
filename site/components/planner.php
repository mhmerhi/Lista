<?php

namespace Site\Components;

use Reverb\System\ComponentBase;
use Site\Models\MealRepository;


class Planner extends ComponentBase
{
    public function __construct(MealRepository $mealRepository)
    {
        $this->mealRepository = $mealRepository;
    }

    protected function
    RequiresAuthentication()
    {
        return false;
    }

    protected function 
    Index($params)
    {
        $meals = $this->mealRepository->GetAll();

        $this->ExposeVariable("msg", "Meals!");
        $this->ExposeVariable("meals", $meals);
    }

}
