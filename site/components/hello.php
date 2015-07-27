<?php

namespace Site\Components;

use Reverb\System\ComponentBase;


class Hello extends ComponentBase
{
    protected function
    RequiresAuthentication()
    {
        return false;
    }

    protected function 
    Index($params)
    {
        $this->ExposeVariable("msg", "Hello everybody!"); 
    }

}
