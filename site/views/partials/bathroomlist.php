<div>
    <h3>Bathroom Items</h3>
    <ul id="bathroomList" class="list-unstyled">
        <?php foreach ($bathroomItems as $item): ?>
            <li data-itemid="<?=$item['item_id']?>"><?= $item['item_name'];?></li>
        <?php endforeach; ?>
    </ul>
</div>