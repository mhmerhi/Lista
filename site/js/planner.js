/**
 * Created by bensmith on 28/07/15.
 */

$(document).ready(function() {
    //
    // Global Vars
    //
    var days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday',
    ];

    var plannerContainer = $('#weeklyPlanner');

    //
    // Page Initialisation
    //
    var startDaySelect = $('#startDay');
    for (var dayIndex in days) {
        startDaySelect.append($('<option>', {'value': dayIndex, html: days[dayIndex]}));
    }

    addMakeListButton();

    //
    // Event Handler Registration
    //
    $('ul#mealsList').delegate('li', 'click', mealsListClick);
    $('body').on('click', 'table#tblWeeklyPlanner li', selectedMealsListClick);
    $('#btnMakePlanner').on('click', makePlanner);
    $('body').on('click','#makeShoppingListBtn', makeShoppingList);

    //
    // Event Handlers
    //
    function mealsListClick()
    {
        var meal = $(this);

        var firstEmptyMealSlot = $('table#tblWeeklyPlanner').find('div:empty:first');
        meal.clone().appendTo(firstEmptyMealSlot);
        meal.remove();
    }

    function selectedMealsListClick()
    {
        var meal = $(this);

        var mealList = $('ul#mealsList');
        mealList.append(meal.clone());
        meal.remove();
    }

    function makePlanner()
    {
        var numDays = $('#numDays').val();
        var startDay = $('#startDay').val();

        var table = $('<table>').attr('id', 'tblWeeklyPlanner').addClass("table table-striped");
        var headerRow = $('<tr>');
        var dayCell = $('<th class="dayCell">').html('Day');
        var lunchCell = $('<th class="lunchCell">').html('Lunch');
        var dinnerCell = $('<th class="dinnerCell">').html('Dinner');

        headerRow.append(dayCell)
            .append(lunchCell)
            .append(dinnerCell);

        table.append(headerRow);

        for (var i = 0, j = startDay; i < numDays; i++, j = ++j % 7) {
            var row = $('<tr>');
            var dayCell = $('<td class="dayCell">').html(days[j]);
            var lunchCell = $('<td class="lunchCell">').append($('<div>').addClass('lunchInput'));
            var dinnerCell = $('<td class="dinnerCell">').append($('<div>').addClass('dinnerInput'));

            row.append(dayCell)
                .append(lunchCell)
                .append(dinnerCell);

            table.append(row);
        }

        // add the weekly planner to the page
        plannerContainer.find('#tblWeeklyPlanner').remove();
        plannerContainer.append(table);

        return false;
    }


    //
    // Callbacks
    //

    //
    // Helpers
    //
    function addMakeListButton()
    {
        // Add a button to generate the shopping list
        var makeListBtn = $('<button>')
            .attr('id', 'makeShoppingListBtn')
            .html('Make List')
            .addClass('btn btn-sm');

        var bodyContent = $('#bodyContent');
        bodyContent.find('#makeShoppingListBtn').remove();
        bodyContent.append(makeListBtn);
        return false;
    }

    function makeShoppingList() {
        // TODO: actually make a list...
        console.log('list!');
    };
});