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
        $(this).toggleClass('itemSelected');
    }


    //
    // Callbacks
    //


    //
    // Helpers
    //

});