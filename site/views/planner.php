<div id="meals">
    <?= $meallist; ?>
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
    <?= $bathroomlist; ?>
</div>
<div id="listDiv">
    <?= $kitchenlist; ?>
</div>