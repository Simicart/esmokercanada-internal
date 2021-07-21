/**
 * fuction for save new card information
 * @returns {undefined}
 */
function saveCardForm()
{
        var dataForm = jQuery('#monerisca_add_card');
        dataForm.mage('validation');
        if (jQuery('#monerisca_add_card').valid()) {
            jQuery('#monerisca_add_card_btn').attr('disabled', true);
            jQuery('#monerisca_add_card').submit();
        }
}

 function saveUpdateCardForm()
{
    var dataForm = jQuery('#monerisca_update_card');
    dataForm.mage('validation');
    if (jQuery('#monerisca_update_card').valid()) {
        jQuery('#monerisca_add_card_btn').attr('disabled', true);
        jQuery('#monerisca_update_card').submit();
    }
}

function toggleCards(selectedValue, current_card) {
    switch (selectedValue) {
        case 'existing':
            jQuery("#cardparent").css("display", "none");
            break;
        case 'new':
            jQuery("#cardparent").css("display", "block");
            break;
    }
}