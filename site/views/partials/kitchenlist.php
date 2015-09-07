<div>
    <h3>Kitchen Items</h3>
    <ul id="kitchenList" class="list-unstyled">
        <?php foreach ($kitchenItems as $item): ?>
            <li data-itemid="<?=$item['item_id']?>"><?= $item['item_name'];?></li>
        <?php endforeach; ?>
    </ul>
</div>