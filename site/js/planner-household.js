/**
 * Created by bensmith on 28/07/15.
 */

$(document).ready(function() {
    //
    // Global Vars
    //

    //
    // Page Initialisation
    //


    //
    // Event Handler Registration
    //
    $('#bathroomList,#kitchenList').on('click', 'li', toggleSelectItem);

    //
    // Event Handlers
    //
    function toggleSelectItem(data)
    {
        console.log('has');
        $(this).toggleClass('itemSelected');
    }


    //
    // Callbacks
    //
    function getItemsCB(data)
    {
        var itemsList = $('#householdItemsList');
        itemsList.find('div.itemDiv').remove();

        $.each(data.householdItems, function(itemId, item) {
            var itemLi = $('<div>')
                .data('itemId', itemId)
                .addClass("itemDiv well well-sm")
                .append($('<span>').addClass('itemName').text(item.name))
                .append($('<span>').addClass('editTag').text('(Edit)'));
            itemLi.appendTo(itemsList);
        });
    }


    //
    // Helpers
    //
    function GetItemsList() {
        $.ajax({
            url: '/lista/json/household/getAllItems',
            data: {},
            dataType: "json",
            context: $(this),
            success: getItemsCB
        });
    }

});