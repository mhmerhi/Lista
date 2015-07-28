/**
 * Created by bensmith on 28/07/15.
 */

$(document).ready(function() {
    //
    // Global Vars
    //

    //
    // Page Initialisation
    //

    //
    // Event Handler Registration
    //

    //
    // Event Handlers
    //
    $('ul#mealsList').delegate('li', 'click', mealsListClick);
    $('ul#selectedMealsList').delegate('li', 'click', selectedMealsListClick);

    //
    // Callbacks
    //
    function mealsListClick()
    {
        var meal = this;

        var selectedList = $('ul#selectedMealsList');
        selectedList.append(meal);
    }

    function selectedMealsListClick()
    {
        var meal = this;

        var mealList = $('ul#mealsList');
        mealList.append(meal);
    }

    //
    // Helpers
    //
});