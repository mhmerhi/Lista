<h1><?php echo $msg; ?></h1>

<div id="meals" class="">
    <h3>All Meals</h3>
    <ul id="mealsList">
    <?php foreach ($meals as $meal): ?>
    <li><?= $meal['name'];?></li>
    <?php endforeach; ?>
    </ul>
</div>

<div id="selectedMeals" class="">
    <h3>Selected Meals</h3>
    <ul id="selectedMealsList">
        <!-- meals added here dynamically -->
    </ul>
</div>

<div id="weeklyPlanner">
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
                <input type="text" id="numDays" />
            </label>
            <button id="btnMakePlanner" class="btn-small btn-primary">Make Planner</button>
        </fieldset>
    </form>
</div>