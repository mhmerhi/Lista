<?php
/**
 * Created by PhpStorm.
 * User: bensmith
 * Date: 10/08/15
 * Time: 12:38
 */
namespace Site\Models;

use Reverb\System\ModelBase;


class MealRepository extends ModelBase {

    public function __construct()
    {
        $this->modelName = 'meal';
    }

}