<h3>All Meals</h3>
<ul id="mealsList" class="list-unstyled">
    <?php foreach ($meals as $meal): ?>
        <li data-mealid="<?=$meal['id']?>"><?= $meal['name'];?></li>
    <?php endforeach; ?>
</ul>