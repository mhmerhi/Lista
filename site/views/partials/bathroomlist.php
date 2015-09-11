<h3>Bathroom Items</h3>
<ul id="bathroomList" class="list-unstyled">
    <?php foreach ($bathroomItems as $item): ?>
        <li class="itemListItem" data-itemid="<?=$item['item_id']?>"><?= $item['item_name'];?></li>
    <?php endforeach; ?>
</ul>