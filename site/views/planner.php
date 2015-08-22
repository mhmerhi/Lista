<div id="meals">
    <h3>All Meals</h3>
    <ul id="mealsList" class="list-unstyled">
    <?php foreach ($meals as $meal): ?>
    <li data-mealid="<?=$meal['id']?>"><?= $meal['name'];?></li>
    <?php endforeach; ?>
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
                <input type="text" id="numDays" value="7" />
            </label>
            <button id="btnMakePlanner" class="btn btn-sm btn-primary">Make Planner</button>
        </fieldset>
    </form>
</div>
<div id="listDiv">
</div>