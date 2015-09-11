<h3>Kitchen Items</h3>
<ul id="kitchenList" class="list-unstyled">
    <?php foreach ($kitchenItems as $item): ?>
        <li class="itemListItem" data-itemid="<?=$item['item_id']?>"><?= $item['item_name'];?></li>
    <?php endforeach; ?>
</ul>