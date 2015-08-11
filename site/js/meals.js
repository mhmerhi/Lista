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
    // Get the Meals List
    GetMealsList();


    //
    // Event Handler Registration
    //
    $('#newMealSubmit').on('click', addNewMeal);

    //
    // Event Handlers
    //
    function addNewMeal()
    {
        // ajax the new meal off to be added to database

        // !!AS A CALLBACK TO ABOVE!! refresh the meals list
        GetMealsList();

        return false;
    }

    //
    // Callbacks
    //
    function getMealsCB(data)
    {
        var mealListUL = $('#mealsList');
        mealListUL.find('li').remove();

        $.each(data.meals, function(id, value) {
            $('<li>').text(value.name).appendTo(mealListUL);
        })
    }

    //
    // Helpers
    //
    function GetMealsList() {
        $.ajax({
            url: '/lista/json/meals/getMeals',
            data: {},
            dataType: "json",
            context: $(this),
            success: getMealsCB

        });
    }
});