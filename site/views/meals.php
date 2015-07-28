<h1><?php echo $msg; ?></h1>

<ul id="mealsList">
<?php foreach ($meals as $meal): ?>
<li><?= $meal['name'];?></li>
<?php endforeach; ?>
</ul>