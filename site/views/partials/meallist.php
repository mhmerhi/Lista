<h3>All Meals</h3>
<ul id="mealsList" class="list-unstyled">
    <?php foreach ($meals as $mealId => $meal): ?>
        <li data-mealid="<?=$mealId?>"><?= $meal['meal_name'];?></li>
    <?php endforeach; ?>
</ul>