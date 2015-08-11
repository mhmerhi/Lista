<h1><?php echo $msg; ?></h1>

<div id="meals" class="">
    <h3>All Meals</h3>
    <ul id="mealsList">
    <?php foreach ($meals as $meal): ?>
    <li><?= $meal['name'];?></li>
    <?php endforeach; ?>
    </ul>
</div>

<div>
    <form>
        <h3>Add Meal</h3>
        <label>
            Meal Name
            <input type="text" id="newMealName" />
        </label>
        <button id="newMealSubmit">Add</button>
    </form>
</div>