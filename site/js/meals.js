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
    $('#mealsList').on('click', 'div.mealDiv span.editTag', makeMealEditable);
    $('#mealsList').on('click', 'input', function() {return false;});
    $('#mealsList').on('click', 'button.editButton', editMeal);
    $('#mealsList').on('click', 'button.cancelButton', cancelEditMeal);
    $('#mealsList').on('click', 'button.saveIngredButton', saveIngredient);
    $('#mealsList').on('keyup', 'input[id="newIngredName"]', submitNewIngredient);
    $('#mealsList').on('click', 'button.cancelIngredButton', cancelIngredient);
    $('#mealsList').on('click', 'span.addIngredient', showAddIngredient);

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
        var oldName = $(this).siblings('span.mealName').text();
        $(this).siblings('input,button,span').remove();
        $(this).parent()
            .prepend($('<button>').addClass('btn btn-sm cancelButton').text('Cancel').data('oldName', oldName))
            .prepend($('<button>').addClass('btn btn-primary btn-sm editButton').text('Save'))
            .prepend($('<input>').attr('type', 'text').val(oldName));
        $(this).remove();
    }

    function editMeal()
    {
        var mealId   = $(this).parents('div.mealDiv').data('mealId');
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
                $(this).parents('div.mealDiv')
                    .prepend($('<span>').addClass('editTag').text('(Edit)'))
                    .prepend($('<span>').addClass('mealName').text(newName));
                $(this).parents('div.mealDiv').find('input,button').remove();
            }
        });

        return false;
    }

    function cancelEditMeal()
    {
        $(this).parents('div.mealDiv')
            .prepend($('<span>').addClass('editTag').text('(Edit)'))
            .prepend($('<span>').addClass('mealName').text($(this).data('oldName')));
        $(this).parents('div.mealDiv').children('input,button').remove();
    }

    function cancelIngredient()
    {
        $(this).parents('li').remove();
    }

    function saveIngredient()
    {
        var mealId   = $(this).parents('div.mealDiv').data('mealId');
        var ingredientName = $(this).siblings('input').val();

        // ajax the new name and id up to the server!
        $.ajax({
            url: '/lista/json/meals/addIngredientToMeal',
            data: {
                mealId: mealId,
                ingredientName: ingredientName
            },
            dataType: 'json',
            context: $(this),
            success: function() {
                // Decide: do this this way, or just get the whole list again.
                var newName = $(this).siblings('input').val();
                $(this).parents('li')
                    .append($('<span>').text(ingredientName));
                $(this).parents('div.mealDiv').find('input,button').remove();
            }
        });

        return false;
    }

    function showAddIngredient()
    {
        var newIngredientName     = $('<input>',
                                        {id: 'newIngredName', type: 'text'});
        var newIngredientSave     = $('<button>')
                                        .addClass('btn btn-sm cancelIngredButton')
                                        .text('Cancel');
        var newIngredientCancel   = $('<button>')
                                        .addClass('btn btn-primary btn-sm saveIngredButton')
                                        .text('Save');

        var newIngredientLi = $('<li>')
            .append(newIngredientName)
            .append(newIngredientCancel)
            .append(newIngredientSave)
            .insertBefore($(this).parents('li'));
        newIngredientName.focus();
    }

    function submitNewIngredient(event)
    {
        if (event.keyCode == 13) {
            $(this).siblings('button.saveIngredButton').click();
        }
    }

    //
    // Callbacks
    //
    function getMealsCB(data)
    {
        var mealListUL = $('#mealsList');
        mealListUL.find('div.mealDiv').remove();

        $.each(data.meals, function(mealId, meal) {
            // Ingredients List
            var ingredientDiv = $('<div>');
            var ingredientList = $('<ul>');
            $.each(meal.ingredients, function(ingId, ingredient){
                var ingredientLi = $('<li>')
                    .data('ingredientId', ingId)
                    .append($('<span>').text(ingredient));
                ingredientLi.appendTo(ingredientList);
            });

            var addIngredientLi = $('<li>')
                .data('ingredientId',-1)
                .append($('<span>').addClass('addIngredient').text('(Add Ingredient)'))
                .appendTo(ingredientList);

            ingredientList.appendTo(ingredientDiv);

            // Meal block
            var mealLi = $('<div>')
                .data('mealId', mealId)
                .addClass("mealDiv well well-sm")
                .append($('<span>').addClass('mealName').text(meal.meal_name))
                .append($('<span>').addClass('editTag').text('(Edit)'))
                .append(ingredientList);
            mealLi.appendTo(mealListUL);
        });
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