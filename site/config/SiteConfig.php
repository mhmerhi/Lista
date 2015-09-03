<?php
namespace Site\Config;

class SiteConfig
{
    const WEB_ROOT    = "/opt/git/Lista";
    const SITE_ROOT   = "/opt/git/Lista/site";
    const REVERB_ROOT = "/opt/git/Lista/reverb";
    const VENDOR_ROOT = "/opt/git/Lista/vendor";

    const DEFAULT_HEAD_TITLE = "Lista";

    const DB_HOST = 'localhost';
    const DB_USER = 'db_user';
    const DB_PASS = 'wpe84u9384u5';
    const DB_DB   = 'lista';

    const DEFAULT_LOGIN = '/lista/html/login/index';
    const DEFAULT_PAGE_AFTER_LOGIN = '/lista/html/view';

    private $classes = array();
    private $initializers = array();

    public function __construct() 
    {
        $this->classes = array(
            // Libs
            'MemcachedManager'      => 'Reverb\Lib\MemcachedManager',
            'DbConnection'          => 'Reverb\Lib\DbConnection',
            // Components
            'Household'             => 'Site\Components\Household',
            'Login'                 => 'Site\Components\Login',
            'Meals'                 => 'Site\Components\Meals',
            'Planner'               => 'Site\Components\Planner',
            // Models
            'HouseholdRepository'   => 'Site\Models\HouseholdRepository',
            'IngredientRepository'  => 'Site\Models\IngredientRepository',
            'MealRepository'        => 'Site\Models\MealRepository',
        );

        $this->factories = array(
            'Site\Components\Meals'     => 'Site\Components\Service\MealsFactory',
            'Site\Components\Planner'   => 'Site\Components\Service\PlannerFactory',
            'Site\Components\Household' => 'Site\Components\Service\HouseholdFactory',
        );

        $this->initializers = array(
            'MemcachedManagerAwareInitializer'   => 'Reverb\Lib\MemcachedManagerAwareInitializer',
            'DbConnectionAwareInitializer'       => 'Reverb\Lib\DbConnectionAwareInitializer',
            'DbAdapterAwareInitializer'          => 'Reverb\Lib\DbAdapterAwareInitializer',
        );
    }

    public function GetClass($className)
    {
        if (!isset($this->classes[$className])) {
            return false;
        }

        return $this->classes[$className];
    }

    public function GetInitializers()
    {
        return $this->initializers;
    }
}
