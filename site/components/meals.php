<?php

namespace Site\Components;

use Reverb\System\ComponentBase;


class Meals extends ComponentBase
{
    protected function
    RequiresAuthentication()
    {
        return false;
    }

    protected function 
    Index($params)
    {
        $meals = [
            ["id" => 0, "name" => "Red Pesto Pasta",      "ingredients" => [1,2,3]],
            ["id" => 1, "name" => "Sausages and Yorkies", "ingredients" => [4,5,6]],
            ["id" => 2, "name" => "Pork Baguettes",       "ingredients" => [7,8,9]],
        ];

        $this->ExposeVariable("msg", "Meals!");
        $this->ExposeVariable("meals", $meals);
    }

}