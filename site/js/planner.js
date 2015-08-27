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

    //
    // Event Handler Registration
    //
    $('ul#mealsList').delegate('li', 'click', mealsListClick);
    $('body').on('click', 'table#tblWeeklyPlanner li', selectedMealsListClick);
    $('#btnMakePlanner').on('click', makePlanner);
    $('body').on('click','#makeShoppingListBtn', makeShoppingList);
    $('body').on('click', 'th.lunchCell,th.dinnerCell', selectColumnForMeals)

    //
    // Event Handlers
    //
    function mealsListClick()
    {
        var meal = $(this);

        var firstEmptyMealSlot;
        if ($('table#tblWeeklyPlanner').find('.tableColumnSelected').length) {
            firstEmptyMealSlot = $('table#tblWeeklyPlanner').find('td.tableColumnSelected div:empty:first');
        } else {
            firstEmptyMealSlot = $('table#tblWeeklyPlanner').find('div:empty:first');
        }
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

        addMakeListButton();

        return false;
    }

    function selectColumnForMeals() {
        var plannerTable = $('#tblWeeklyPlanner');

        // is there a currently-selected column?
        var currentSelection = false;
        if (plannerTable.find('.tableColumnSelected').hasClass('lunchCell')) {
            currentSelection = 'lunchCell';
        } else if (plannerTable.find('.tableColumnSelected').hasClass('dinnerCell')) {
            currentSelection = 'dinnerCell';
        }

        plannerTable.find('.tableColumnSelected').removeClass('tableColumnSelected');

        var cellClass = '';
        if ($(this).hasClass('lunchCell')) {
            cellClass = 'lunchCell';
        } else if ($(this).hasClass('dinnerCell')) {
            cellClass = 'dinnerCell';
        }

        if (currentSelection != cellClass) {
            plannerTable.find('.'+cellClass).addClass('tableColumnSelected');
        }
    }

    //
    // Callbacks
    //
    function shoppingListCB(data) {
        var listDiv = $('#listDiv');

        var list = $('<textarea>')
            .html(data.list.join('\n'))
            .css('height', data.list.length * 20 + 10 + 'px');

        listDiv.find('textarea').remove();
        listDiv.append(list);
    }

    //
    // Helpers
    //
    function addMakeListButton()
    {
        // Add a button to generate the shopping list
        var makeListBtn = $('<button>')
            .attr('id', 'makeShoppingListBtn')
            .html('Make List')
            .addClass('btn btn-sm btn-primary');

        var listDiv = $('#listDiv');
        listDiv.find('#makeShoppingListBtn').remove();
        listDiv.append(makeListBtn);
        return false;
    }

    function makeShoppingList() {
        var mealLis = $('#tblWeeklyPlanner').find('li');
        var mealIdArray = [];

        $.each(mealLis, function(id, value) {
           mealIdArray.push($(value).data('mealid'));
        });

        $.ajax({
            url: '/lista/json/planner/getListForMeals',
            data: {
                meals: mealIdArray
            },
            dataType: 'json',
            context: $(this),
            success: shoppingListCB
        })
    };
});