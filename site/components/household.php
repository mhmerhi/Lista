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
        $items = $this->householdRepository->GetAllItems();
        $this->ExposeVariable("householdItems", $items);
    }

    protected function GetAllItemTypes()
    {
        $types = $this->householdRepository->GetAllTypes();
        $this->ExposeVariable("itemTypes", $types);
    }

    protected function AddItem($params)
    {
        $newId = $this->householdRepository->AddItem($params['name'], $params['typeId']);

        $this->ExposeVariable('success', $newId !== false);
    }

    protected function EditItem($params)
    {
        $itemId  = $params['id'];
        $newName = $params['name'];
        $newTypeId = $params['type'];

        $affectedRows = $this->householdRepository->EditItem($itemId, $newName, $newTypeId);

        $this->ExposeVariable('success', $affectedRows > 0);
    }
}
