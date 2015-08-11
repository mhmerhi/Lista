<div id="meals" class="" style="float:right; width:25%">
    <h3>All Meals</h3>
    <ul id="mealsList">
    <?php foreach ($meals as $meal): ?>
    <li><?= $meal['name'];?></li>
    <?php endforeach; ?>
    </ul>
</div>

<div id="weeklyPlanner" style="width:75%">
    <h3>Weekly Planner</h3>
    <form>
        <fieldset>
            <label>
                Start Day
                <select id="startDay">
                    <!-- options added dynamically -->
                </select>
            </label>
            <label>
                Number Of Days
                <input type="text" id="numDays" value="7" />
            </label>
            <button id="btnMakePlanner" class="btn btn-sm btn-primary">Make Planner</button>
        </fieldset>
    </form>
</div>