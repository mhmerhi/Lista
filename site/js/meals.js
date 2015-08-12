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
    $('#mealsList').on('click', 'li', makeMealEditable);
    $('#mealsList').on('click', 'li input', function() {return false;});
    $('#mealsList').on('click', 'li button', editMeal);

    //
    // Event Handlers
    //
    function addNewMeal()
    {
        // ajax the new meal off to be added to database
        var data = {
            'name': $('#newMealName').val()
        };
        $.ajax({
            url: '/lista/json/meals/addMeal',
            data: data,
            dataType: "json",
            context: $(this),
            success: GetMealsList
        });

        return false;
    }

    function makeMealEditable()
    {
        var oldName = $(this).find('span').text();
        $(this).find('input,button,span').remove();
        $(this).append($('<input>').attr('type', 'text').val(oldName))
               .append($('<button>').text('Edit'));
    }

    function editMeal()
    {
        var mealId   = $(this).parents('li').data('mealId');
        var mealName = $(this).siblings('input').val();

        // ajax the new name and id up to the server!
        $.ajax({
            url: '/lista/json/meals/editMeal',
            data: {
                id: mealId,
                name: mealName
            },
            dataType: 'json',
            context: $(this),
            success: function() {
                // Decide: do this this way, or just get the whole list again.
                var newName = $(this).siblings('input').val();
                $(this).parents('li').append($('<span>').text(newName));
                $(this).parents('li').find('input,button').remove();
            }
        });

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
            var li = $('<li>').data('mealId', value.id).append($('<span>').text(value.name));
            li.appendTo(mealListUL);
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