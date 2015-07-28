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

