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
    // Get the Items List
    GetItemsList();
    GetItemTypeList();


    //
    // Event Handler Registration
    //
    $('#newHouseholdItemSubmit').on('click', addNewItem);
    $('#householdItemsList').on('click', 'div.itemDiv span.editTag', makeItemEditable);
    $('#householdItemsList').on('click', 'input', function() {return false;});
    $('#householdItemsList').on('click', 'button.editButton', editItem);
    $('#householdItemsList').on('click', 'button.cancelButton', cancelEditItem);

    //
    // Event Handlers
    //
    function addNewItem()
    {
        // ajax the new item off to be added to database
        var data = {
            'name':   $('#newHouseholdItemName').val(),
            'typeId': $('#newHouseholdItemType').val()
        };
        $.ajax({
            url: '/lista/json/household/addItem',
            data: data,
            dataType: "json",
            context: $(this),
            success: GetItemsList
        });

        return false;
    }

    function makeItemEditable()
    {
        var oldName = $(this).siblings('span.itemName').text();
        $(this).siblings('input,button,span').remove();
        $(this).parent()
            .prepend($('<button>').addClass('btn btn-sm cancelButton').text('Cancel').data('oldName', oldName))
            .prepend($('<button>').addClass('btn btn-primary btn-sm editButton').text('Save'))
            .prepend($('<input>').attr('type', 'text').val(oldName));
        $(this).remove();
    }

    function editItem()
    {
        var itemId   = $(this).parents('div.itemDiv').data('itemId');
        var itemName = $(this).siblings('input').val();

        // ajax the new name and id up to the server!
        $.ajax({
            url: '/lista/json/household/editItem',
            data: {
                id: itemId,
                name: itemName
            },
            dataType: 'json',
            context: $(this),
            success: function() {
                // Decide: do this this way, or just get the whole list again.
                var newName = $(this).siblings('input').val();
                $(this).parents('div.itemDiv')
                    .prepend($('<span>').addClass('editTag').text('(Edit)'))
                    .prepend($('<span>').addClass('itemName').text(newName));
                $(this).parents('div.itemDiv').find('input,button').remove();
            }
        });

        return false;
    }

    function cancelEditItem()
    {
        $(this).parents('div.itemDiv')
            .prepend($('<span>').addClass('editTag').text('(Edit)'))
            .prepend($('<span>').addClass('itemName').text($(this).data('oldName')));
        $(this).parents('div.itemDiv').children('input,button').remove();
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

    function getItemTypesCB(data)
    {
        var typeList = $('#newHouseholdItemType');
        typeList.find('option').remove();

        $.each(data.itemTypes, function(id, name) {
            var typeOption = $('<option>')
                .val(id)
                .text(name)
            typeOption.appendTo(typeList);
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

    function GetItemTypeList() {
        $.ajax({
            url: '/lista/json/household/getAllItemTypes',
            data: {},
            dataType: "json",
            context: $(this),
            success: getItemTypesCB
        });
    }
});