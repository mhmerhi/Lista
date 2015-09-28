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
        var oldType = $(this).siblings('span.itemType').text();

        $(this).siblings('input,button,span').remove();
        $(this).parent()
            .prepend($('<button>')
                .addClass('btn btn-sm cancelButton')
                .text('Cancel')
                .data('oldName', oldName)
                .data('oldType', oldType)
            )
            .prepend($('<button>').addClass('btn btn-primary btn-sm editButton').text('Save'))
            .prepend($('#newHouseholdItemType').clone().attr('id', 'editHouseholdItemType'))
            .prepend($('<input>').attr('type', 'text').addClass('itemName').val(oldName));
        $(this).remove();
    }

    function editItem()
    {
        var itemId       = $(this).parents('div.itemDiv').data('itemId');
        var itemName     = $(this).siblings('input').val();
        var itemTypeId   = $(this).siblings('select').val();

        // ajax the new name and id up to the server!
        $.ajax({
            url: '/lista/json/household/editItem',
            data: {
                id: itemId,
                name: itemName,
                type: itemTypeId
            },
            dataType: 'json',
            context: $(this),
            success: function() {
                // Decide: do this this way, or just get the whole list again.
                var newName = $(this).siblings('input').val();
                var newTypeName = $(this).siblings('select').find('option:selected').text();

                $(this).parents('div.itemDiv')
                    .prepend($('<span>').addClass('itemType').text(newTypeName))
                    .prepend($('<span>').addClass('itemName').text(newName))
                    .prepend($('<span>').addClass('editTag').text('(Edit)'));
                $(this).parents('div.itemDiv').find('input,button,select').remove();
            }
        });

        return false;
    }

    function cancelEditItem()
    {
        $(this).parents('div.itemDiv')
            .prepend($('<span>').addClass('itemType').text($(this).data('oldType')))
            .prepend($('<span>').addClass('itemName').text($(this).data('oldName')))
            .prepend($('<span>').addClass('editTag').text('(Edit)'));
        $(this).parents('div.itemDiv').children('input,button,select').remove();
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
                .append($('<span>').addClass('editTag').text('(Edit)'))
                .append($('<span>').addClass('itemName').text(item.name))
                .append($('<span>').addClass('itemType').text(item.type));
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