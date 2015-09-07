<?php

namespace Site\Components;

use Reverb\System\ComponentBase;
use Site\Models\HouseholdRepository;


class Household extends ComponentBase
{
    private $householdRepository;

    public function __construct(HouseholdRepository $householdRepository)
    {
        $this->householdRepository = $householdRepository;
    }

    protected function RequiresAuthentication()
    {
        return false;
    }

    protected function Index($params)
    {
    }

    protected function GetAllItems()
    {
        $items = $this->householdRepository->GetAll();
        $this->ExposeVariable("householdItems", $items);
    }

    protected function GetAllItemTypes()
    {
        $types = $this->householdRepository->GetAllTypes();
        $this->ExposeVariable("itemTypes", $types);
    }

    protected function AddItem($params)
    {
        // todo
    }

    protected function EditItem($params)
    {
        // todo
    }
}
