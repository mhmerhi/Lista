<?php $this->AddStylesheet('itemList.css'); ?>
<div id="meals" class="">
    <h3>All Meals</h3>
    <div id="mealsList">
    </div>
</div>

<div>
    <form>
        <div class="form-group">
            <h3>Add Meal</h3>
            <label>
                Meal Name
                <input type="text" id="newMealName" class="form-control" placeholder="Name" />
            </label>
            <button id="newMealSubmit" class="btn btn-primary">Add</button>
        </div>
    </form>
</div>