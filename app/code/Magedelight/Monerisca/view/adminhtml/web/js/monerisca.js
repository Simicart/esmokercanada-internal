 require(['jquery', 'mage/url'],function($,urlBuilder){
     
            $('.md-monerisca-cards-list-item').each(function(i, element){
                $(element).hover(
                    function(){
                        $(element).addClass('ui-state-active');
                    },
                    function(){
                        $(element).removeClass('ui-state-active');
                    }
                );
            });
        $(document).off('click').on('click.delete','.action-delete',function(event){
            var customercardid = $(this).attr('customer-card-id');
            var delete_url = $(this).attr('delete_url');
              $.ajax(''+delete_url+'',{
               data: {customercardid: customercardid},
               method: 'GET',
               dataType: 'json',
               beforeSend: function(){
                   $('li:has(button[customer-card-id="'+customercardid+'"])').slideUp('slow');
                   jQuery('.admin__data-grid-loading-mask').show();
                    jQuery('.admin__data-grid-loading-mask').css("position","fixed");
               },
               complete: function(transport){
                    jQuery('#messages').remove();
                    var resultData = transport.responseText.evalJSON();
                    
                    if(resultData.error)
                    {
                        jQuery('li:has(button[customer-card-id="'+customercardid+'"])').slideDown('slow');
                    }
                    jQuery('.admin__data-grid-loading-mask').hide();
                    jQuery('.admin__data-grid-loading-mask').css("position","absolute");
                    var url = jQuery("#md-cards-add").attr('add_new_url');
                    addNewForm(url);
                    jQuery('.page-main-actions').after(resultData.message);
                    
               },
               error: function(transport){
                    jQuery('li:has(button[customer-card-id="'+customercardid+'"])').slideDown('slow');
               },
               
            });
        });
        
        $(document).off('click.edit').on('click.edit','.action-edit',function(event){
             var customercardid = $(this).attr('customer-card-id');
             var edit_url = $(this).attr('edit_url');
             $.ajax(''+edit_url+'',{
              data: {customercardid: customercardid},
               method: 'GET',
               dataType: 'html',
               beforeSend: function(){
                    jQuery('.admin__data-grid-loading-mask').show();
                    jQuery('.admin__data-grid-loading-mask').css("position","fixed");
               },
               complete: function(transport){
                   var responseText = transport.responseText;
                    var updateflag = true;
                    if (transport.responseText.isJSON()) {
                            var response = transport.responseText.evalJSON();
                            if (response.ajaxExpired && response.ajaxRedirect) {
                                updateflag = false;
                                setLocation(response.ajaxRedirect);
                            }
                            
                     }
                     if(updateflag)
                     {
                        $('.md-monerisca-cards-item-edit-fieldset').html(transport.responseText);
                        jQuery('.admin__data-grid-loading-mask').hide();
                        jQuery('.admin__data-grid-loading-mask').css("position","absolute");
                     }
               },
               error: function(transport){
                    $('.md-monerisca-cards-item-edit-fieldset').html('Error during processing...');
               },
            });
            
        });
        
        $(document).on('change','#md_monerisca_data_key', function() {
                    
                        var currentValue = jQuery(this).val();
                        var cVVElement = jQuery('#md_monerisca_cc_cid');   
                         if(currentValue == 'new'){
                              jQuery('#md_monerisca_cc_type').attr('data-validate',JSON.stringify({required:true, 'validate-cc-type-select':'#md_monerisca_cc_number'}));
                              jQuery('#md_monerisca_cc_number').attr('data-validate',JSON.stringify({required:true, 'validate-cc-type':'#md_monerisca_cc_type'}));
                              jQuery('#md_monerisca_expiration').attr('data-validate',JSON.stringify({required:true, 'validate-cc-exp':'#md_monerisca_expiration_yr'}));
                              jQuery('#md_monerisca_expiration_yr').attr('data-validate',JSON.stringify({required:true}));
                          }
                           else{
                             jQuery('#md_monerisca_cc_type').removeAttr('data-validate');
                             jQuery('#md_monerisca_cc_number').removeAttr('data-validate');
                             jQuery('#md_monerisca_expiration').removeAttr('data-validate');
                             jQuery('#md_monerisca_expiration_yr').removeAttr('data-validate');
                           }
                           
                        jQuery(".md_monerisca_new").each(function(){

                            if(currentValue == 'new'){
                                jQuery(this).show();
                            }else{
                                jQuery(this).hide();
                            }
                        }); 
                        if(cVVElement){
                            cVVElement.show();
                            if(currentValue == 'new'){
                                cVVElement.addClass('validate-cvn');
                            }else{
                                cVVElement.removeClass('validate-cvn');
                            }
                        }
                });
    });
    function addNewForm(url)
    {
        jQuery.ajax(''+url+'?isAjax=true',{
               data: {},
               method: 'GET',
               dataType: 'html',
               beforeSend: function(){
                   jQuery('.admin__data-grid-loading-mask').show();
                    jQuery('.admin__data-grid-loading-mask').css("position","fixed");
               },
               complete: function(transport){
                    var responseText = transport.responseText;
                    var updateflag = true;
                    if (transport.responseText.isJSON()) {
                            var response = transport.responseText.evalJSON();
                            if (response.ajaxExpired && response.ajaxRedirect) {
                                updateflag = false;
                                setLocation(response.ajaxRedirect);
                            }
                            
                     }
                     if(updateflag)
                     {
                          jQuery('.md-monerisca-cards-item-edit-fieldset').html(transport.responseText);
                          jQuery('.admin__data-grid-loading-mask').hide();
                          jQuery('.admin__data-grid-loading-mask').css("position","absolute");
                     }
                    
               },
               error: function(transport){
                    jQuery('.md-monerisca-cards-item-edit-fieldset').html('Error during processing...');
               },
              
            });
    }
    
    function cssaveCardFromList()
    {
       
         var formToValidate = $('monerisca-form-validate');
         var validator = new Validation(formToValidate);
         if(validator.validate()) {
            var paymentParam = {
                firstname:jQuery('#md_monerisca_firstname').val(),
                lastname:jQuery('#md_monerisca_lastname').val(),
                company:jQuery('#md_monerisca_company').val(),
                street:jQuery('#md_monerisca_street').val(),
                city:jQuery('#md_monerisca_city').val(),
                region_id:jQuery('#md_monerisca_region_id').val(),
                state:jQuery('#md_monerisca_region').val(),
                postcode:jQuery('#md_monerisca_zip').val(),
                country_id:jQuery('#md_monerisca_country_id').val(),
                telephone:jQuery('#md_monerisca_telephone').val(),
                cc_type:jQuery('#md_monerisca_cc_type').val(),
                cc_number:jQuery('#md_monerisca_cc_number').val(),
                cc_exp_month:jQuery('#md_monerisca_expiration').val(),
                cc_exp_year:jQuery('#md_monerisca_expiration_yr').val(),
                cc_cid:(jQuery('#md_monerisca_cc_cid')) ? jQuery('#md_monerisca_cc_cid').val(): '',
                
            };            
               var cs_cardSaveAjaxUrl = jQuery("#cs_card_save_ajax_url").val();
               jQuery.ajax(''+cs_cardSaveAjaxUrl+'?isAjax=true',{
               data: {paymentParam:paymentParam,form_key:jQuery('input[name=form_key]').val()},
               method: 'POST',
               dataType: 'json',
                beforeSend: function(){
                    jQuery('.admin__data-grid-loading-mask').show();
                    jQuery('.admin__data-grid-loading-mask').css("position","fixed");
               },
               complete: function(transport){
                    jQuery('#messages').remove();
                    var resultData = transport.responseText.evalJSON(); 
                    if(!resultData.error)
                    {
                       jQuery('#md-monerisca-cards-list-container').parent().html(resultData.append);
                    }
                    jQuery('.page-main-actions').after(resultData.message);
                    jQuery('.admin__data-grid-loading-mask').hide();
                    jQuery('.admin__data-grid-loading-mask').css("position","absolute");
               },
               error: function(transport){
                    jQuery('.page-main-actions').after('Error during processing...');
               },
            
            });
           
        }
    }
     function csupdateCardFromList(){

      var formToValidate = $('monerisca-form-validate');
         var validator = new Validation(formToValidate);
         if(validator.validate()) {
            var ccAction = jQuery('#md_monerisca_cc_action');
            var paymentParam = { 
                card_id:jQuery('#md_monerisca_card_id').val(),
                customer_id:jQuery('#md_monerisca_customer_id').val(),
                cc_type:jQuery('#md_monerisca_cc_type').val(),
                cc_number:jQuery('#md_monerisca_cc_number').val(),
                cc_exp_month:jQuery('#md_monerisca_expiration').val(),
                cc_exp_year:jQuery('#md_monerisca_expiration_yr').val(),
                cc_cid:(jQuery('#md_monerisca_cc_cid')) ? jQuery('#md_monerisca_cc_cid').val(): '',
                firstname:jQuery('#md_monerisca_firstname').val(),
                lastname:jQuery('#md_monerisca_lastname').val(),
                company:jQuery('#md_monerisca_company').val(),
                street:jQuery('#md_monerisca_street').val(),
                city:jQuery('#md_monerisca_city').val(),
                region_id:jQuery('#md_monerisca_region_id').val(),
                state:jQuery('#md_monerisca_region').val(),
                postcode:jQuery('#md_monerisca_zip').val(),
                country_id:jQuery('#md_monerisca_country_id').val(),
                telephone:jQuery('#md_monerisca_telephone').val(),
                cc_action:jQuery('#md_monerisca_cc_action').val(),
            };
            if($('md_monerisca_cc_cid') === null){
                delete paymentParam.cc_cid;
            }
            
            var cs_cardUpdateAjaxUrl = jQuery("#cs_card_update_ajax_url").val();
            jQuery.ajax(''+cs_cardUpdateAjaxUrl+'?isAjax=true',{
               data: {paymentParam:paymentParam,form_key:jQuery("input[name=form_key]").val()},
               method: 'POST',
               dataType: 'html',
                beforeSend: function(){
                    jQuery('.admin__data-grid-loading-mask').show();
                    jQuery('.admin__data-grid-loading-mask').css("position","fixed");
               },
               complete: function(transport){
                    jQuery('#messages').remove();
                    var resultData = transport.responseText.evalJSON(); 
                    if(!resultData.error)
                    {
                       jQuery('#md-monerisca-cards-list-container').parent().html(resultData.append);
                    }
                    jQuery('.page-main-actions').after(resultData.message);
                    jQuery('.admin__data-grid-loading-mask').hide();
                    jQuery('.admin__data-grid-loading-mask').css("position","absolute");
                    
               },
               error: function(transport){
                    jQuery('.page-main-actions').after('Error during processing...');
               },
            
            });
       }
       
    }
  function cstoggleCards(selectedValue, current_card)
  {
        switch(selectedValue){
            case 'existing':
                $('md_monerisca_cc_type').disabled = true;
                jQuery("#md_monerisca_cc_type").removeClass("validate-cc-type-select");
                $('md_monerisca_cc_number').disabled = true;
                jQuery("#md_monerisca_cc_number").removeClass("validate-cc-number validate-cc-type");
                $('md_monerisca_expiration').disabled = true;
                jQuery('#md_monerisca_expiration').removeClass("validate-cc-exp");
                $('md_monerisca_expiration_yr').disabled = true;
                if($('md_monerisca_cc_cid') !== null){
                    $('md_monerisca_cc_cid').disabled = true;
                    jQuery("#md_monerisca_cc_cid").removeClass("required-entry validate-cc-cvn");
                     cvvcheck=0;
                }
                break;
            case 'new':
                $('md_monerisca_cc_type').disabled = false;
                jQuery("#md_monerisca_cc_type").addClass("validate-cc-type-select");
                $('md_monerisca_cc_number').disabled = false;
                jQuery("#md_monerisca_cc_number").addClass("validate-cc-number validate-cc-type");
                $('md_monerisca_expiration').disabled = false;
                  jQuery('#md_monerisca_expiration').addClass("validate-cc-exp");
                $('md_monerisca_expiration_yr').disabled = false;
               if($('md_monerisca_cc_cid') !== null){
                    $('md_monerisca_cc_cid').disabled = false;
                    jQuery("#md_monerisca_cc_cid").addClass("required-entry validate-cc-cvn");
                     cvvcheck=1;
                }
                break;
        }
   }
   
    