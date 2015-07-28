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
            ["name" => "Red Pesto Pasta", "ingredients" =>[1,2,3]],
            ["name" => "Sausages and Yorkies", "ingredients" => [4,5,6]],
        ];

        $this->ExposeVariable("msg", "Meals!");
        $this->ExposeVariable("meals", $meals);
    }

}
