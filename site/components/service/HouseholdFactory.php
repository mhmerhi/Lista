<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:47
 */

namespace Site\Components\Service;


use Reverb\System\DependencyContainer;
use Site\Components\Household;

class HouseholdFactory {

    public function CreateInstance(DependencyContainer $dependencyContainer)
    {
        $householdRepository = $dependencyContainer->GetInstance('HouseholdRepository');

        return new Household($householdRepository);
    }
}