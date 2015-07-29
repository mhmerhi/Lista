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
    $('ul#selectedMealsList').delegate('li', 'click', selectedMealsListClick);
    $('#btnMakePlanner').on('click', makePlanner);

    //
    // Event Handlers
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

    function makePlanner()
    {
        var numDays  = $('#numDays').val();
        var startDay = $('#startDay').val();

        var table = $('<table>').attr('id', 'tblWeeklyPlanner');
        var headerRow = $('<th>');
        var dayCell    = $('<td class="dayCell">').html('Day');
        var lunchCell  = $('<td class="lunchCell">').html('Lunch');
        var dinnerCell = $('<td class="dinnerCell">').html('Dinner');

        headerRow.append(dayCell)
            .append(lunchCell)
            .append(dinnerCell);

        table.append(headerRow);


        for (var i = startDay; i < numDays; i++) {
            var j = i % 7;
            var row = $('<tr>');
            var dayCell    = $('<td class="dayCell">').html(days[j]);
            var lunchCell  = $('<td class="lunchCell">').append($('<input>', {type: 'text'}).addClass('lunchInput'));
            var dinnerCell = $('<td class="dinnerCell">').append($('<input>', {type: 'text'}).addClass('dinnerInput'));

            row.append(dayCell)
                .append(lunchCell)
                .append(dinnerCell);

            table.append(row);
        }

        var plannerContainer = $('#weeklyPlanner');
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
});