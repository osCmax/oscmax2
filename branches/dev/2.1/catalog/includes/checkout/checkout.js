$.fn.focusNextInputField = function() {
    return this.each(function() {
        var fields = $(this).parents('form:eq(0),body').find('button,input,textarea,select');
        var index = fields.index( this );
        if ( index > -1 && ( index + 1 ) < fields.length ) {
            fields.eq( index + 1 ).focus();
        }
        return false;
    });
};

document.onkeydown = keydown;
document.onmousedown = mousedown;
isTab = false;
isState = false;

function getCheckedValue(radioObj) {
  if(!radioObj)
    return "";
  var radioLength = radioObj.length;
  if(radioLength == undefined)
    if(radioObj.checked)
      return radioObj.value;
    else
      return "";
  for(var i = 0; i < radioLength; i++) {
    if(radioObj[i].checked) {
      return radioObj[i].value;
    }
  }
  return "";
}


function keydown(event) {
        var code;
        var e;
        if (document.all) {
            if (!event) {
                var e = window.event;
                code = e.keyCode;
            }
        }
        else if (event.which) {
        code = event.which;
        e = event;
        }
        if (code == 9) {//Write some logic
  isTab = true;
        }
        else
        {
          isTab = false;
        }
    }

    function mousedown(event) {
      isTab = false;
    }



var submitter = null;
var $element1;
var selectedM;
function submitFunction() {
  submitter = 1;
}

var errCSS = {
  'border-color': 'red',
  'border-style': 'solid'
};


function bindAutoFill($el){
  if ($el.attr('type') == 'select-one'){
    var method = 'change';
  }else{
    var method = 'blur';
  }
  
  $el.blur(unsetFocus).focus(setFocus);
  
  if (document.attachEvent){
  if($el.get(0))
    $el.get(0).attachEvent('onpropertychange', function (){
      if ($(event.srcElement).data('hasFocus') && $(event.srcElement).data('hasFocus') == 'true') return;
      if ($(event.srcElement).val() != '' && $(event.srcElement).hasClass('required')){
        $(event.srcElement).trigger(method);
      }
    });
  }else{
  if($el.get(0))
    $el.get(0).addEventListener('onattrmodified', function (e){
      if ($(e.currentTarget).data('hasFocus') && $(e.currentTarget).data('hasFocus') == 'true') return;
      if ($(e.currentTarget).val() != '' && $(e.currentTarget).hasClass('required')){
        $(e.currentTarget).trigger(method);
      }
    }, false);
  }
}

function setFocus(){
  $(this).data('hasFocus', 'true');
  //$element1 = $(this);
}

function unsetFocus(){
  $(this).data('hasFocus', 'false');
  //$element1 = $(this);
}

var checkout = {
  charset: 'UTF-8',
  pageLinks: {},
  fieldSuccessHTML: '<div style="margin-left:1px;margin-top:1px;float:left;" class="success_icon ui-icon-green ui-icon-circle-check"></div>',
  fieldErrorHTML: '<div style="margin-left:1px;margin-top:1px;float:left;" class="error_icon ui-icon-red ui-icon-circle-close"></div>',
  fieldRequiredHTML: '<div style="margin-left:1px;margin-top:1px;float:left;" class="required_icon ui-icon-red ui-icon-gear"></div>',
  showAjaxLoader: function (){
    if(this.showMessagesPopUp == true)
    {
      $('#ajaxMessages').dialog('open');
    }
    $('#ajaxLoader').show();
  },
  hideAjaxLoader: function (){
    $('#ajaxLoader').hide();
    if(this.showMessagesPopUp == true)
    {
      $('#ajaxMessages').dialog('close');
    }
  },
  showAjaxMessage: function (message){
    $('#checkoutButtonContainer').hide();
    $('#ajaxMessages').show().html('<center>Loading...<br><img src="ext/jQuery/themes/smoothness/images/ajax_load.gif"><br>' + message + '</center>');
  },
  hideAjaxMessage: function (){
    $('#checkoutButtonContainer').show();
    $('#ajaxMessages').hide();
  },
  fieldErrorCheck: function ($element, forceCheck, hideIcon){
    forceCheck = forceCheck || false;
    hideIcon = hideIcon || false;
    
    var errMsg = this.checkFieldForErrors($element, forceCheck);
    if (hideIcon == false){
      if (errMsg != false){
        this.addIcon($element, 'error', errMsg);
        return true;
      }else{
        this.addIcon($element, 'success', errMsg);
      }
    }else{
      if (errMsg != false){
        return true;
      }
    }
    return false;
  },
  checkFieldForErrors: function ($element, forceCheck){
    var hasError = false;
    
    if ($element.is(':visible') && ($element.hasClass('required') || forceCheck == true)){
      var errCheck = getFieldErrorCheck($element);
      if (!errCheck.errMsg){
        return false;
      }

      switch($element.attr('type')){
        case 'password':
        if ($element.attr('name') == 'password'){
          if ($element.val().length < errCheck.minLength){
            hasError = true;
          }
        }else{
          if ($element.val() != $(':password[name="password"]', $('#billingAddress')).val() || $element.val().length <= 0){
            hasError = true;
          }
        }
        break;
        case 'radio':
        if ($(':radio[name="' + $element.attr('name') + '"]:checked').size() <= 0){
          hasError = true;
        }
        break;
        case 'checkbox':
        if ($(':checkbox[name="' + $element.attr('name') + '"]:checked').size() <= 0){
          hasError = true;
        }
        break;
        case 'select-one':
        if ($element.val() == ''){
          hasError = true;
        }
        break;
        default:
        if ($element.val().length < errCheck.minLength){
          hasError = true;
        }
        break;
      }
      if (hasError == true){
        return errCheck.errMsg;
      }
    }
    return hasError;
  },
  addIcon: function ($curField, iconType, title){
    title = title || false;
    $('.success_icon, .error_icon, .required_icon', $curField.parent()).hide();
    switch(iconType){
      case 'error':
      if (this.initializing == true){
        this.addRequiredIcon($curField, 'Required');
      }else{
        this.addErrorIcon($curField, title);
      }
      break;
      case 'success':
      this.addSuccessIcon($curField, title);
      break;
      case 'required':
      this.addRequiredIcon($curField, 'Required');
      break;
    }
  },
  addSuccessIcon: function ($curField, title){
    if ($('.success_icon', $curField.parent()).size() <= 0){
      $curField.parent().append(this.fieldSuccessHTML);
    }
    $('.success_icon', $curField.parent()).attr('title', title).show();
  },
  addErrorIcon: function ($curField, title){
    if ($('.error_icon', $curField.parent()).size() <= 0){
      $curField.parent().append(this.fieldErrorHTML);
    }
    $('.error_icon', $curField.parent()).attr('title', title).show();
  },
  addRequiredIcon: function ($curField, title){
    if ($curField.hasClass('required')){
      if ($('.required_icon', $curField.parent()).size() <= 0){
        $curField.parent().append(this.fieldRequiredHTML);
      }
      $('.required_icon', $curField.parent()).attr('title', title).show();
    }
  },
  clickButton: function (elementName){
    if ($(':radio[name="' + elementName + '"]').size() <= 0){
      $('input[name="' + elementName + '"]').trigger('click', true);
    }else{
      $(':radio[name="' + elementName + '"]:checked').trigger('click', true);
    }
  },
  addRowMethods: function($row){
    $row.hover(function (){
      if (!$(this).hasClass('moduleRowSelected')){
        $(this).addClass('moduleRowOver');
      }
    }, function (){
      if (!$(this).hasClass('moduleRowSelected')){
        $(this).removeClass('moduleRowOver');
      }
    }).click(function (){
      if (!$(this).hasClass('moduleRowSelected')){
        var selector = ($(this).hasClass('shippingRow') ? '.shippingRow' : '.paymentRow') + '.moduleRowSelected';
        $(selector).removeClass('moduleRowSelected');
        $(this).removeClass('moduleRowOver').addClass('moduleRowSelected');
        if($(':radio', $(this)).is(':disabled')!==true)
        if (!$(':radio', $(this)).is(':checked')){
          $(':radio', $(this)).attr('checked', 'checked').click();
        }
      }
    });
  },
  queueAjaxRequest: function (options){
    var checkoutClass = this;
    var o = {
      url: options.url,
      cache: options.cache || false,
      dataType: options.dataType || 'html',
      type: options.type || 'GET',
      contentType: options.contentType || 'application/x-www-form-urlencoded; charset=' + this.ajaxCharset,
      data: options.data || false,
/*      async:false,*/
      beforeSend: options.beforeSend || function (){
        checkoutClass.showAjaxMessage(options.beforeSendMsg || 'Ajax Operation, Please Wait...');
        checkoutClass.showAjaxLoader();
      },
      complete: function (){
        checkoutClass.hideAjaxMessage();
        if (document.ajaxq.q['orderUpdate'].length <= 0){
          checkoutClass.hideAjaxLoader();
        }
      },
      success: options.success,
      error: function (XMLHttpRequest, textStatus, errorThrown){
        if (XMLHttpRequest.responseText == 'session_expired') document.location = this.pageLinks.shoppingCart;
        alert(options.errorMsg || 'There was an ajax error, please contact ShedsForLessDirect for support.');
      }
    };
    $.ajaxq('orderUpdate', o);
  },
  updateAddressHTML: function (type){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=' + (type == 'shipping' ? 'getShippingAddress' : 'getBillingAddress'),
      type: 'post',
      beforeSendMsg: 'Updating ' + (type == 'shipping' ? 'Shipping' : 'Billing') + ' Address',
      success: function (data){
        $('#' + type + 'Address').html(data);
        if(checkoutClass.showAddressInFields == true)
        {
          checkoutClass.attachAddressFields();
          if(checkoutClass.stateEnabled == true)
          {
            $('*[name="billing_state"]').trigger('change');
            $('*[name="delivery_state"]').trigger('change');
          }
          }
      },
      errorMsg: 'There was an error loading your ' + type + ' address, please inform ShedsForLessDirect about this error.'
    });
  },
  attachAddressFields: function(){
    var checkoutClass = this;
    $('input', $('#billingAddress')).each(function (){
      if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio'){
        $(this).blur(function (){
          if ($(this).hasClass('required')){
            checkoutClass.fieldErrorCheck($(this));
          }
        });
        bindAutoFill($(this));

        if ($(this).hasClass('required')){
          if (checkoutClass.fieldErrorCheck($(this), true, true) == false){
            checkoutClass.addIcon($(this), 'success');
          }else{
            checkoutClass.addIcon($(this), 'required');
          }
        }
      }
    });

    $('input,select[name="billing_country"], ', $('#billingAddress')).each(function (){
      var processFunction = function (){
        if ($(this).hasClass('required')){
          if (checkoutClass.fieldErrorCheck($(this)) == false){
            if($(this).attr('name')=='billing_country' || $(this).attr('name')=='billing_zipcode' || $(this).attr('name')=='billing_state')
            {
              checkoutClass.processBillingAddress();
            }else
            {
              checkoutClass.processBillingAddress(true);
            }
          }
        }else{
          if($(this).attr('name')=='billing_country' || $(this).attr('name')=='billing_zipcode' || $(this).attr('name')=='billing_state')
          {
            checkoutClass.processBillingAddress();
          }else
          {
            checkoutClass.processBillingAddress(true);
          }
        }
        $element1 = $(this);
      };
      
      $(this).unbind('blur');
      if ($(this).attr('type') == 'select-one'){
        $(this).change(processFunction);
      }else{
        $(this).blur(processFunction);
      }
      bindAutoFill($(this));
    });
    $('input,select[name="shipping_country"]', $('#shippingAddress')).each(function (){
      if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox'){
        var processAddressFunction = function (){
          if ($(this).hasClass('required')){
            if (checkoutClass.fieldErrorCheck($(this)) == false){
              if($(this).attr('name')=='shipping_country' || $(this).attr('name')=='shipping_zipcode' || $(this).attr('name')=='delivery_state')
              {
                checkoutClass.processShippingAddress();
              }else
              {
                checkoutClass.processShippingAddress(true);
              }
            }else{
              $('#noShippingAddress').show();
              $('#shippingMethods').hide();
            }
          }else{
            if($(this).attr('name')=='shipping_country' || $(this).attr('name')=='shipping_zipcode' || $(this).attr('name')=='delivery_state')
            {
              checkoutClass.processShippingAddress();
            }else
            {
              checkoutClass.processShippingAddress(true);
            }
          }
          $element1 = $(this);
        };
      $(this).unbind('blur');
      if ($(this).attr('type') == 'select-one'){
        $(this).change(processAddressFunction);
      }else{
        $(this).blur(processAddressFunction);
      }
        //$(this).blur(processAddressFunction);
        bindAutoFill($(this));

        if ($(this).hasClass('required')){
          var icon = 'required';
          if ($(this).val() != '' && checkoutClass.fieldErrorCheck($(this), true, true) == false){
            icon = 'success';
          }
          checkoutClass.addIcon($(this), icon);
        }
      }
    });
    if(checkoutClass.stateEnabled == true)
    {

      $('select[name="shipping_country"], select[name="billing_country"]').each(function (){
        var $thisName = $(this).attr('name');
        var fieldType = 'billing';
        if ($thisName == 'shipping_country'){
          fieldType = 'delivery';
        }
        checkoutClass.addCountryAjax($(this), fieldType + '_state', 'stateCol_' + fieldType);
  
      });

      $('*[name="billing_state"], *[name="delivery_state"]').each(function (){
        var processAddressFunction = checkoutClass.processBillingAddress;
        if ($(this).attr('name') == 'delivery_state'){
          processAddressFunction = checkoutClass.processShippingAddress;
        }
        
        var processFunction = function (){
          if ($(this).hasClass('required')){
            if (checkoutClass.fieldErrorCheck($(this)) == false){
              processAddressFunction.call(checkoutClass);
            }
          }else{
            processAddressFunction.call(checkoutClass);
          }
          $element1 = $(this);
        }
      
        if ($(this).attr('type') == 'select-one'){
          $(this).change(processFunction);
        }else{
          $(this).blur(processFunction);
        }
        bindAutoFill($(this));
      });
    }   
  },
  updateCartView: function (){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=updateCartView',
      type: 'post',
      beforeSendMsg: 'Refreshing Shopping Cart',
      success: function (data){
        if (data == 'none'){
          document.location = checkoutClass.pageLinks.shoppingCart;
        }else{
          $('#shoppingCart').html(data);

          $('.removeFromCart').each(function (){
            checkoutClass.addCartRemoveMethod($(this));
          });
        }
  
      },
      errorMsg: 'There was an error refreshing the shopping cart, please inform ShedsForLessDirect about this error.'
    });
  },
  updatePayment: function (){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=updatePayment',
      type: 'post',
      beforeSendMsg: 'Refreshing Payment Methods',
      dataType: 'json',
      async:false,
      success: function (data){

            if($element1 !=null && (isTab || isState)){
        $element1.focusNextInputField();
      }
      t = false;
      p=0;
      arr_pay = data.payment.split(";");  
      for(u=0;u<arr_pay.length;u++){
      if(arr_pay[u] !="") {
        $(':tr[name="'+arr_pay[u]+'"]').css('display','');  
          t = true;
          p=p+1;


          // zak fix
          selM = getCheckedValue(document.checkout.payment);
          if(selM != '') {
            selectedM = $(eval(selM));
          }


          if(selectedM) {
                    if($('#'+arr_pay[u]).attr('id')!=selectedM.attr('id')) {
                        $('#'+arr_pay[u]).css('display',"none");
                    } else{
                        $('#'+arr_pay[u]).css('display',"");
                    }
          } else {           
            $('#'+arr_pay[u]).css('display','none');
          }
        
        
        }
      }
      
      
      
      
      arr_pay1 = data.payment1.split(";");            
      for(u=0;u<arr_pay1.length;u++){     
      if(arr_pay1[u] !=""){
        $(':tr[name="'+arr_pay1[u]+'"]').css('display','none');       
        
          if(selectedM){
          
                    if($('#'+arr_pay1[u]).attr('id')!=selectedM.attr('id')){
            
                        $('#'+arr_pay1[u]).css('display',"none");
            }
                    else{
            selectedM = '';
            $(':radio[name="payment"]').removeAttr("checked");
                        $('#'+arr_pay1[u]).css('display',"none");
          }
                    }
                    else
                    {
          
                        $('#'+arr_pay1[u]).css('display',"none");
                    }
        
        }
      }
      
      if (t == true){
        $('#noPaymentAddress').css('display','none');
                $('#pay2').css('display','');
        if (p ==1){
            $(':radio[name="payment"]:not(:checked):visible').click();
        } 
      }else{
        $('#noPaymentAddress').css('display','');
        $('#pay2').css('display','none');
      }

                if(!checkoutClass.autoshow){

                }
      
      },
      errorMsg: 'There was an error refreshing the final products listing, please inform ShedsForLessDirect about this error.'
    });
  },
  updateFinalProductListing: function (){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=getProductsFinal',
      type: 'post',
      beforeSendMsg: 'Refreshing Final Product Listing',
      success: function (data){
        $('.finalProducts').html(data);
          
      },
      errorMsg: 'There was an error refreshing the final products listing, please inform ShedsForLessDirect about this error.'
    });
  },
  setGV: function (status){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=setGV&cot_gv=' + status,
      type: 'post',
      beforeSendMsg: (status=='on'?'':'Un') + 'Setting Gift Voucher',
      dataType: 'json',
      success: function (data){
        checkoutClass.updateOrderTotals();
                checkoutClass.updatePayment();
      },
      errorMsg: 'There was an error ' + (status=='on'?'':'Un') + 'setting Gift Voucher method, please inform ShedsForLessDirect about this error.'
    });
  },
  updateOrderTotals: function (){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      cache: false,
      data: 'action=getOrderTotals',
      type: 'post',
      beforeSendMsg: 'Updating Order Totals',
      success: function (data){
        //checkoutClass.updatePayment();
        $('.orderTotals').html(data);     
        checkoutClass.hideAjaxLoader();
        
      },
      errorMsg: 'There was an error refreshing the shopping cart, please inform ShedsForLessDirect about this error.'
    });
  },
  checkPoints: function()
  {
    var checkoutClass = this;
    checkoutClass.queueAjaxRequest({
      url: checkoutClass.pageLinks.checkout,
      data: 'action=redeemPoints&points=' + $('input[name="customer_shopping_points_spending"]').val(),
      type: 'post',
      beforeSendMsg: 'Validating Points',
      dataType: 'json',
      success: function (data){
        if (data.success == false){
          alert('You do not have ' + $('input[name="customer_shopping_points_spending"]').val() + ' points please enter a valid number of points');
        }
        checkoutClass.updateOrderTotals();
                       checkoutClass.updatePayment();
      },
      errorMsg: 'There was an error redeeming points, please inform ShedsForLessDirect about this error.'
    });
    return false;
  },
  clearPoints: function()
  {
    var checkoutClass = this;
    checkoutClass.queueAjaxRequest({
      url: checkoutClass.pageLinks.checkout,
      data: 'action=clearPoints',
      type: 'post',
      beforeSendMsg: 'Clearing Points',
      dataType: 'json',
      success: function (data){
        checkoutClass.updateOrderTotals();
                     checkoutClass.updatePayment();
      },
      errorMsg: 'There was an error redeeming points, please inform ShedsForLessDirect about this error.'
    });
    return false;
  },
  updateModuleMethods: function (action, noOrdertotalUpdate){
    var checkoutClass = this;
    var descText = (action == 'shipping' ? 'Shipping' : 'Payment');
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=update' + descText + 'Methods',
      type: 'post',
      beforeSendMsg: 'Updating ' + descText + ' Methods',
      success: function (data){
        $('#no' + descText + 'Address').hide();
        $('#' + action + 'Methods').html(data).show();

        if(action == 'payment')
        {
          if($('input[name="cot_gv"]', $(this)))
          {
            $('input[name="cot_gv"]', $(this)).each(function (){
              $(this).change(function (e){
                checkoutClass.setGV(($(':checkbox[name="cot_gv"]').is(':checked'))?'':'on');
              });
            });
          }
          //if(checkoutClass.pointsInstalled == true)
          if($(':input[name="customer_shopping_points_spending"]',$(this)))
          {
            $(':input[name="customer_shopping_points_spending"]').keypress(function(event){
              if (event.keyCode == '13') {
                if($(':checkbox[name="use_shopping_points"]').is(':checked'))
                {
                  checkoutClass.checkPoints();
                  this.changed = true;
                }else
                {
                  this.changed = false;
                }
                event.preventDefault();
                return false;
              }
            });
                        $(':checkbox[name="use_shopping_points"]').click(function() {
              if($(':checkbox[name="use_shopping_points"]').is(':checked'))
              {
                checkoutClass.checkPoints();
              }else
              {
                checkoutClass.clearPoints();
              }
              return true;
            });
            $(':input[name="customer_shopping_points_spending"]').change(function() {
              if($(':checkbox[name="use_shopping_points"]').is(':checked'))
              {
                return checkoutClass.checkPoints();
              }
              return false;
            });
          }
        }
        $('.' + action + 'Row').each(function (){
          checkoutClass.addRowMethods($(this));

          $('input[name="' + action + '"]', $(this)).each(function (){
            var setMethod = checkoutClass.setPaymentMethod;
            if (action == 'shipping'){
              setMethod = checkoutClass.setShippingMethod;
            }
            $(this).click(function (e, noOrdertotalUpdate){
              setMethod.call(checkoutClass, $(this));
                checkoutClass.updateOrderTotals();
                                            checkoutClass.updatePayment();
            });
          });
        });       
        
        checkoutClass.clickButton(descText.toLowerCase());
        //$('input[name="billing_firstname"]').focus();
      },
      errorMsg: 'There was an error updating ' + action + ' methods, please inform ShedsForLessDirect about this error.'
    });
  },
  updateShippingMethods: function (noOrdertotalUpdate){
    if (this.shippingEnabled == false){
      return false;
    }

    this.updateModuleMethods('shipping', noOrdertotalUpdate);
  },
  updatePaymentMethods: function (noOrdertotalUpdate){
    this.updateModuleMethods('payment', noOrdertotalUpdate);
  },
  setModuleMethod: function (type, method, successFunction){
    var checkoutClass = this;
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=set' + (type == 'shipping' ? 'Shipping' : 'Payment') + 'Method&method=' + method,
      type: 'post',
      beforeSendMsg: 'Setting ' + (type == 'shipping' ? 'Shipping' : 'Payment') + ' Method',
      dataType: 'json',
      success: successFunction,
      errorMsg: 'There was an error setting ' + type + ' method, please inform ShedsForLessDirect about this error.'
    });
  },
  setShippingMethod: function ($button){
    if (this.shippingEnabled == false){
      return false;
    }

    var checkoutClass = this;
    this.setModuleMethod('shipping', $button.val(), function (data){
      
    });
  },
  setPaymentMethod: function ($button){
    var checkoutClass = this;
    this.setModuleMethod('payment', $button.val(), function (data){ 

  if (typeof(data.id) !="undefined"){   
                selectedM = $(eval(data.id));

                /*$('.pay1').each(function(){
                    if($(this).attr('id')!=selectedM.attr('id'))
                        $(this).css('display',"none");
                    else
                        $(this).css('display',"");
                });*/

      }
    });
  },
  loadAddressBook: function ($dialog, type){
    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      data: 'action=getAddressBook&addressType=' + type,
      type: 'post',
      beforeSendMsg: 'Loading Address Book',
      success: function (data){
        $dialog.html(data);
      },
      errorMsg: 'There was an error loading your address book, please inform ShedsForLessDirect about this error.'
    });
  },
  addCountryAjax: function ($input, fieldName, stateCol){
    var checkoutClass = this;
    $input.change(function (event, callBack){
      if ($(this).hasClass('required')){
        if ($(this).val() != '' && $(this).val() > 0){
          checkoutClass.addIcon($(this), 'success');
        }
      }
            $element1 = $(this);
            //alert($element1.attr('name'));
      var thisName = $(this).attr('name');
      var $origStateField = $('*[name="' + fieldName + '"]', $('#' + stateCol));
      checkoutClass.queueAjaxRequest({
        url: checkoutClass.pageLinks.checkout,
        data: 'action=countrySelect&fieldName=' + fieldName + '&cID=' + $(this).val() + '&curValue=' + $origStateField.val(),
        type: 'post',
        beforeSendMsg: 'Getting Country\'s Zones',
        success: function (data){
          $('#' + stateCol).html(data);
          var $curField = $('*[name="' + fieldName + '"]', $('#' + stateCol));
                    //alert($element1.attr('name') + isTab + "jjj");
                    if($element1 !=null){
                      //   alert($element1.attr('name'));
                $element1.focus();
              }
          if ($curField.hasClass('required')){
            if (checkoutClass.fieldErrorCheck($curField, true, true) == false){
              checkoutClass.addIcon($curField, 'success');
            }else{
              checkoutClass.addIcon($curField, 'required');
            }
          }

          var processAddressFunction = checkoutClass.processBillingAddress;
          if (thisName == 'shipping_country'){
            processAddressFunction = checkoutClass.processShippingAddress;
          }
          
          var processFunction = function (){
            if ($(this).hasClass('required')){
              if (checkoutClass.fieldErrorCheck($(this)) == false){
                processAddressFunction.call(checkoutClass);
              }
            }else{
              processAddressFunction.call(checkoutClass);
            }

          };
          
          bindAutoFill($curField);
          
          if ($curField.attr('type') == 'select-one'){
            $curField.change(processFunction);
          }else{
            $curField.blur(processFunction);
          }

          if (callBack){
            callBack.call(checkoutClass);
          }
        },
        errorMsg: 'There was an error getting states, please inform ShedsForLessDirect about this error.'
      });
    });
  },
  addCountryAjaxEdit: function ($input, fieldName, stateCol){
    var checkoutClass = this;
    $input.change(function (event, callBack){
      if ($(this).hasClass('required')){
        if ($(this).val() != '' && $(this).val() > 0){
          checkoutClass.addIcon($(this), 'success');
        }
      }
      var thisName = $(this).attr('name');
      var $origStateField = $('*[name="' + fieldName + '"]', $('#' + stateCol));
      checkoutClass.queueAjaxRequest({
        url: checkoutClass.pageLinks.checkout,
        data: 'action=countrySelect_edit&fieldName=' + fieldName + '&cID=' + $(this).val() + '&selected=' + $origStateField.val(),
        type: 'post',
        beforeSendMsg: 'Getting Country\'s Zones',
        success: function (data){
          $('#' + stateCol).html(data);
          var $curField = $('*[name="' + fieldName + '"]', $('#' + stateCol));

          /*if ($curField.hasClass('required')){
            if (checkoutClass.fieldErrorCheck($curField, true, true) == false){
              checkoutClass.addIcon($curField, 'success');
            }else{
              checkoutClass.addIcon($curField, 'required');
            }
          }

          var processAddressFunction = checkoutClass.processBillingAddress;
          if (thisName == 'shipping_country'){
            processAddressFunction = checkoutClass.processShippingAddress;
          }
          
          var processFunction = function (){
            if ($(this).hasClass('required')){
              if (checkoutClass.fieldErrorCheck($(this)) == false){
                processAddressFunction.call(checkoutClass);
              }
            }else{
              processAddressFunction.call(checkoutClass);
            }
            $element1 = $(this);
          };
          
          bindAutoFill($curField);
          
          if ($curField.attr('type') == 'select-one'){
            $curField.change(processFunction);
          }else{
            $curField.blur(processFunction);
          }

          if (callBack){
            callBack.call(checkoutClass);
          }*/
        },
        errorMsg: 'There was an error getting states, please inform ShedsForLessDirect about this error.'
      });
    });
  },
  addCartRemoveMethod: function ($element){
    var checkoutClass = this;
    $element.click(function (){
      var $productRow = $(this).parent().parent();
      checkoutClass.queueAjaxRequest({
        url: checkoutClass.pageLinks.checkout,
        data: $(this).attr('linkData'),
        type: 'post',
        beforeSendMsg: 'Removing Product From Cart',
        dataType: 'json',
        success: function (data){
          if (data.products == 0){
            document.location = checkoutClass.pageLinks.shoppingCart;
          }else{
            $productRow.remove();
            checkoutClass.updateFinalProductListing();
            checkoutClass.updateShippingMethods(true);
            checkoutClass.updateOrderTotals();
                        checkoutClass.updatePayment();
          }
        },
        errorMsg: 'There was an error updating shopping cart, please inform ShedsForLessDirect about this error.'
      });
      return false;
    });
  },
  processBillingAddress: function (skipUpdateTotals){
    var hasError = false;
    var checkoutClass = this;
    $('select[name="billing_country"], input[name="billing_street_address"], input[name="billing_zipcode"], input[name="billing_city"], *[name="billing_state"]', $('#billingAddress')).each(function (){
      if (checkoutClass.fieldErrorCheck($(this), false, true) == true){
        hasError = true;
      }
    });
    if (hasError == true){
      return;
    }

    this.setBillTo();
    
    if ($('#diffShipping:checked').size() <= 0 && this.loggedIn != true){
      this.setSendTo(false);
    }else{
      this.setSendTo(true);
    }
    if(skipUpdateTotals != true)
    {
      this.updateCartView();
      this.updateFinalProductListing();
      this.updatePaymentMethods(true);
      this.updateShippingMethods(true);
      this.updateOrderTotals();
            this.updatePayment();

    }
  },
  processShippingAddress: function (skipUpdateTotals){
    var hasError = false;
    var checkoutClass = this;
    $('select[name="delivery_country"], input[name="delivery_street_address"], input[name="delivery_zipcode"], input[name="delivery_city"]', $('#deliveryAddress')).each(function (){
      if (checkoutClass.fieldErrorCheck($(this), false, true) == true){
        hasError = true;
      }
    });
    if (hasError == true){
      return;
    }

    this.setSendTo(true);
    if (this.shippingEnabled == true && skipUpdateTotals != true){
      this.updateShippingMethods(true);
    }
    if(skipUpdateTotals != true)
    {
      this.updateOrderTotals();
            this.updatePayment();
    }
  },
  setCheckoutAddress: function (type, useShipping){
    var selector = '#' + type + 'Address';
    var sendMsg = 'Setting ' + (type == 'shipping' ? 'Shipping' : 'Billing') + ' Address';
    var errMsg = type + ' address';
    if (type == 'shipping' && useShipping == false){
      selector = '#billingAddress';
      sendMsg = 'Setting Shipping Address';
      errMsg = 'billing address';
    }
    action = 'setBillTo';
    if (type == 'shipping'){
      action = 'setSendTo';
    }

    this.queueAjaxRequest({
      url: this.pageLinks.checkout,
      beforeSendMsg: sendMsg,
      dataType: 'json',
      data: 'action=' + action + '&' + $('*', $(selector)).serialize(),
      type: 'post',
      success: function (data){
      
      if($element1!=null && isTab){
      //  $('input[name="billing_firstname"]').focus();
        //alert($element1.attr('name'));
        $element1.focusNextInputField();
//        $element1 = $element1.getNextInputField();
        //$element1=null;
      
      }
      /*arr_pay = data.payment.split(";");  
        
      for(u=0;u<arr_pay.length;u++){
      if(arr_pay[u] !=""){
        $(':tr[name="'+arr_pay[u]+'"]').css('display','');        
        $('#'+arr_pay[u]).css('display','');
        }
      }
      
      arr_pay1 = data.payment1.split(";");            
      for(u=0;u<arr_pay1.length;u++){     
      if(arr_pay1[u] !=""){
        $(':tr[name="'+arr_pay1[u]+'"]').css('display','none');       
        $('#'+arr_pay1[u]).css('display','none');
        }
      }*/
      
      
      },
      errorMsg: 'There was an error updating your ' + errMsg + ', please inform ShedsForLessDirect about this error.'
    });
  },
  setBillTo: function (){
    this.setCheckoutAddress('billing', false);
  },
  setSendTo: function (useShipping){
    this.setCheckoutAddress('shipping', useShipping);
  },
  initCheckout: function (){
    var checkoutClass = this;

    if (this.loggedIn == false){
      $('#shippingAddress').hide();
      $('#shippingMethods').html('');
    }

    $('#checkoutNoScript').remove();
    $('#checkoutYesScript').show();

    $('.removeFromCart').each(function (){
      checkoutClass.addCartRemoveMethod($(this));
    });


if(this.autoshow == true &&  this.loggedIn == false){

          this.updateCartView();
      this.updateFinalProductListing();
            this.setBillTo();
            this.setSendTo(false);
      this.updatePaymentMethods(true);
      this.updateShippingMethods(true);
      this.updateOrderTotals();
            this.updatePayment();
      $('#pay2').css('display','');
            $('#noPaymentAddress').css('display','none');
    }else{

  if(this.loggedIn == false){
    $('#noPaymentAddress').css('display','');
        $('#pay2').css('display','none');
    }
  this.updateFinalProductListing();
  this.updateOrderTotals(); 
  if(this.autoshow == true || this.loggedIn == true)
    this.updatePayment(); 
}

if ($(':radio[name="payment"]').length == 1)
  $(':radio[name="payment"]').click();

    $('#diffShipping').click(function (){
      if (this.checked){
        $('#shippingAddress').show();
        $('#shippingMethods').html('');
        $('#noShippingAddress').show();
        $('select[name="shipping_country"]').trigger('change');
                checkoutClass.setSendTo(true);
                checkoutClass.updateShippingMethods(true);
      }else{
        $('#shippingAddress').hide();
        var errCheck = checkoutClass.processShippingAddress();
        if (errCheck == ''){
          $('#noShippingAddress').hide();
        }else{
          $('#noShippingAddress').show();
        }
                checkoutClass.setSendTo(false);
                checkoutClass.updateShippingMethods(true);
      }
    });


    if (this.loggedIn == true){
      //checkoutClass.setPaymentMethod($(':radio[name="payment"]:checked'));
      $('.shippingRow, .paymentRow').each(function (){
        checkoutClass.addRowMethods($(this));
      });

      $('input[name="payment"]').each(function (){
        $(this).click(function (){        
          checkoutClass.setPaymentMethod($(this));
          checkoutClass.updateOrderTotals();
                    checkoutClass.updatePayment();
        });
      });

      if (this.shippingEnabled == true){
        $('input[name="shipping"]').each(function (){
          $(this).click(function (){
            checkoutClass.setShippingMethod($(this));
            checkoutClass.updateOrderTotals();
                        checkoutClass.updatePayment();
          });
        });
      }
    }

    if ($('#paymentMethods').is(':visible')){
      this.clickButton('payment');
    }

    if (this.shippingEnabled == true){
      if ($('#shippingMethods').is(':visible')){
        this.clickButton('shipping');
      }
    }
    



    $('input, password', $('#billingAddress')).each(function (){
      if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox' && $(this).attr('type') != 'radio'){
        
        if ($(this).attr('type') == 'password'){
          $(this).blur(function (){
            if ($(this).hasClass('required')){
              checkoutClass.fieldErrorCheck($(this));
            }
          });
          /* Used to combat firefox 3 and it's auto-populate junk */
          $(this).val('');

          if ($(this).attr('name') == 'password'){
            $(this).focus(function (){
              $(':password[name="confirmation"]').val('');
            });

            var rObj = getFieldErrorCheck($(this));
            $(this).pstrength({
              addTo: '#pstrength_password',
              minchar: rObj.minLength
            });
          }
        }else{
          $(this).blur(function (){
            if ($(this).hasClass('required')){
              checkoutClass.fieldErrorCheck($(this));
            }
          });
          bindAutoFill($(this));
        }

        if ($(this).hasClass('required')){
          if (checkoutClass.fieldErrorCheck($(this), true, true) == false){
            checkoutClass.addIcon($(this), 'success');
          }else{
            checkoutClass.addIcon($(this), 'required');
          }
        }
      }
    });
    /*
    $('select[name="billing_country"], input[name="billing_street_address"], input[name="billing_zipcode"], input[name="billing_city"]', $('#billingAddress')).each(function (){
      var processFunction = function (){
        if ($(this).hasClass('required')){
          if (checkoutClass.fieldErrorCheck($(this)) == false){
            checkoutClass.processBillingAddress();
          }
        }else{
          checkoutClass.processBillingAddress();
        }
      };
      
      $(this).unbind('blur');
      if ($(this).attr('type') == 'select-one'){
        $(this).change(processFunction);
      }else{
        $(this).blur(processFunction);
      }
      bindAutoFill($(this));
    });
    */
    $('input,select[name="billing_country"], ', $('#billingAddress')).each(function (){
      var processFunction = function (){
        if ($(this).hasClass('required')){
          if (checkoutClass.fieldErrorCheck($(this)) == false){
            if($(this).attr('name')=='billing_country' || $(this).attr('name')=='billing_zipcode' || $(this).attr('name')=='billing_state')
            {
              checkoutClass.processBillingAddress();
            }else
            {
              checkoutClass.processBillingAddress(true);
            }
          }
        }else{
          if($(this).attr('name')=='billing_country' || $(this).attr('name')=='billing_zipcode' || $(this).attr('name')=='billing_state')
          {
            checkoutClass.processBillingAddress();
          }else
          {
            checkoutClass.processBillingAddress(true);
          }
          
        }
        $element1 = $(this);
      };
      
      $(this).unbind('blur');
      if ($(this).attr('type') == 'select-one'){
        $(this).change(processFunction);
      }else{
        $(this).blur(processFunction);
      }
      bindAutoFill($(this));
    });

    $('input[name="billing_email_address"]').each(function (){
      $(this).unbind('blur').blur(function (){
        var $thisField = $(this);
      
        if (checkoutClass.initializing == true){
          checkoutClass.addIcon($thisField, 'required');
        }else{
          if (this.changed == false) return;
          if (checkoutClass.fieldErrorCheck($thisField, true, true) == false){
            this.changed = false;
            checkoutClass.queueAjaxRequest({
              url: checkoutClass.pageLinks.checkout,
              data: 'action=checkEmailAddress&emailAddress=' + $thisField.val(),
              type: 'post',
              beforeSendMsg: 'Checking Email Address',
              dataType: 'json',
              success: function (data){
                $('.success, .error', $thisField.parent()).hide();
                if (data.success == false){
                  checkoutClass.addIcon($thisField, 'error', data.errMsg.replace('/n', "\n"));
                  alert(data.errMsg.replace('/n', "\n").replace('/n', "\n").replace('/n', "\n"));
                }else{
                  checkoutClass.addIcon($thisField, 'success');
                }
                $element1 =  $thisField;
                                $element1.focusNextInputField();
                                //alert($element1.attr('name'));

              },
              errorMsg: 'There was an error checking email address, please inform ShedsForLessDirect about this error.'
            });
          }
        }
      }).keyup(function (){
        this.changed = true;
      });
      bindAutoFill($(this));
    });
    /*
    $('input', $('#shippingAddress')).each(function (){
      if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox'){
        var processAddressFunction = function (){
          if ($(this).hasClass('required')){
            if (checkoutClass.fieldErrorCheck($(this)) == false){
              checkoutClass.processShippingAddress();
            }else{
              $('#noShippingAddress').show();
              $('#shippingMethods').hide();
            }
          }else{
            checkoutClass.processShippingAddress();
          }
        };
      
        $(this).blur(processAddressFunction);
        bindAutoFill($(this));

        if ($(this).hasClass('required')){
          var icon = 'required';
          if ($(this).val() != '' && checkoutClass.fieldErrorCheck($(this), true, true) == false){
            icon = 'success';
          }
          checkoutClass.addIcon($(this), icon);
        }
      }
    });
    */
    $('input,select[name="shipping_country"]', $('#shippingAddress')).each(function (){
      if ($(this).attr('name') != undefined && $(this).attr('type') != 'checkbox'){
        
        var processAddressFunction = function (){
          
          
          if ($(this).hasClass('required')){
            if (checkoutClass.fieldErrorCheck($(this)) == false){
              
              if($(this).attr('name')=='shipping_country' || $(this).attr('name')=='shipping_zipcode' || $(this).attr('name')=='delivery_state')
              {
                checkoutClass.processShippingAddress();
                //$(this).focus();
              }else
              {
                checkoutClass.processShippingAddress(true);
                //$(this).focus();
              }
            }else{
              $('#noShippingAddress').show();
              $('#shippingMethods').hide();
            }
          }else{
            if($(this).attr('name')=='shipping_country' || $(this).attr('name')=='shipping_zipcode' || $(this).attr('name')=='delivery_state')
            {
              checkoutClass.processShippingAddress();
              //$(this).focus();
            }else
            {
              checkoutClass.processShippingAddress(true);
              //$(this).focus();
            }
          }
          $element1 = $(this);
        };
      
        //$(this).blur(processAddressFunction);
                $(this).unbind('blur');
      if ($(this).attr('type') == 'select-one'){
        $(this).change(processAddressFunction);
      }else{
        $(this).blur(processAddressFunction);
      }
        bindAutoFill($(this));

        if ($(this).hasClass('required')){
          var icon = 'required';
          if ($(this).val() != '' && checkoutClass.fieldErrorCheck($(this), true, true) == false){
            icon = 'success';
          }
          checkoutClass.addIcon($(this), icon);
        }
      }
    });
    if(checkoutClass.stateEnabled == true)
    {
      $('select[name="shipping_country"], select[name="billing_country"]').each(function (){
        var $thisName = $(this).attr('name');
        var fieldType = 'billing';
        if ($thisName == 'shipping_country'){
          fieldType = 'delivery';
        }
        checkoutClass.addCountryAjax($(this), fieldType + '_state', 'stateCol_' + fieldType);
      });
    
      $('*[name="billing_state"], *[name="delivery_state"]').each(function (){
        var processAddressFunction = checkoutClass.processBillingAddress;
        if ($(this).attr('name') == 'delivery_state'){
          processAddressFunction = checkoutClass.processShippingAddress;
        }
        
        var processFunction = function (){
          if ($(this).hasClass('required')){
            if (checkoutClass.fieldErrorCheck($(this)) == false){
              processAddressFunction.call(checkoutClass);
            }
          }else{
            processAddressFunction.call(checkoutClass);
          }
          $element1 = $(this);
        }
      
        if ($(this).attr('type') == 'select-one'){
          $(this).change(processFunction);
        }else{
          $(this).blur(processFunction);
        }
        bindAutoFill($(this));
      });
    }
    $('#updateCartButton').click(function (){
      checkoutClass.showAjaxLoader();
      checkoutClass.queueAjaxRequest({
        url: checkoutClass.pageLinks.checkout,
        data: 'action=updateQuantities&' + $('input', $('#shoppingCart')).serialize(),
        type: 'post',
        beforeSendMsg: 'Updating Product Quantities',
        dataType: 'json',
        success: function (){
          checkoutClass.updateCartView();
          checkoutClass.updateFinalProductListing();
          if ($('#noPaymentAddress:hidden').size() > 0){
            checkoutClass.updatePaymentMethods();
                        checkoutClass.updatePayment();
            checkoutClass.updateShippingMethods(true);
          }
          checkoutClass.updateOrderTotals();
                    isTab = true;
                                       $element1 = $('input[name^=qty]');
                    $('input[name="billing_firstname"]').focus();
                                       
        },
        errorMsg: 'There was an error updating shopping cart, please inform ShedsForLessDirect about this error.'
      });
      return false;
    });

    function checkAllErrors(){
      var errMsg = '';
       $('input[name="gv_redeem_code"]').val('');
       $('input[name="coupon"]').val('');
      if ($('.required_icon:visible', $('#billingAddress')).size() > 0){
        errMsg += 'Please fill in all required fields in "Billing Address"' + "\n";
      }

      if ($('.error_icon:visible', $('#billingAddress')).size() > 0){
        errMsg += 'Please correct fields with errors in "Billing Address"' + "\n";
      }

      if ($('#diffShipping:checked').size() > 0){
        if ($('.required_icon:visible', $('#shippingAddress')).size() > 0){
          errMsg += 'Please fill in all required fields in "Shipping Address"' + "\n";
        }

        if ($('.error_icon:visible', $('#shippingAddress')).size() > 0){
          errMsg += 'Please correct fields with errors in "Shipping Address"' + "\n";
        }
      }

      if (errMsg != ''){
        errMsg = '------------------------------------------------' + "\n" +
        '                 Address Errors                 ' + "\n" +
        '------------------------------------------------' + "\n" +
        errMsg;
      }
      
  
  
      if ($(':radio[name="payment"]:checked').length <= 0){ 
          if ($(':radio[name="payment"]').length>0){    
          errMsg += '------------------------------------------------' + "\n" +
          '           Payment Selection Error              ' + "\n" +
          '------------------------------------------------' + "\n" +
          'You must select a payment method.' + "\n";       
          }
      }
      
      if(this.pointsInstalled == true && $(':checkbox[name="use_shopping_points"]').is(':checked') && $('input[name="customer_shopping_points_spending"]').val() >0)
      {
      }
      else
      {
        if ($(':radio[name="payment"]:checked').length <= 0){
          if ($(':radio[name="payment"]').length>0){    
            errMsg += '------------------------------------------------' + "\n" +
            '           Payment Selection Error              ' + "\n" +
            '------------------------------------------------' + "\n" +
            'You must select a payment method.' + "\n";
                    } 
        }
      }

      if (checkoutClass.shippingEnabled === true){
        if ($(':radio[name="shipping"]:checked').size() <= 0){
          if ($('input[name="shipping"]:hidden').size() <= 0){
            errMsg += '------------------------------------------------' + "\n" +
            '           Shipping Selection Error             ' + "\n" +
            '------------------------------------------------' + "\n" +
            'You must select a shipping method.' + "\n";
          }
        }
      }
      if(this.ccgvInstalled == true)
      {
        if($('input[name="gv_redeem_code"]').val() == 'redeem code')
        {
          $('input[name="gv_redeem_code"]').val('');
        }
      }

      if(this.kgtInstalled == true)
      {
        if($('input[name="coupon"]').val() == 'redeem code')
        {
          $('input[name="coupon"]').val('');
        }
      }

      if (errMsg.length > 0){
        alert(errMsg);
        return false;
      }else{
        return true;
      }
    }
    if(this.pointsInstalled == true)
    {
      $(':input[name="customer_shopping_points_spending"]').keypress(function(event){
              if (event.keyCode == '13') {
                if($(':checkbox[name="use_shopping_points"]').is(':checked'))
                {
                  checkoutClass.checkPoints();
                  this.changed = true;
                }else
                {
                  this.changed = false;
                }
                event.preventDefault();
                return false;
              }
            });
      $(':checkbox[name="use_shopping_points"]').click(function() {
        checkoutClass.checkPoints();
        return true;
      });
      $(':checkbox[name="customer_shopping_points_spending"]').change(function() {
        if($(':checkbox[name="use_shopping_points"]').is(':checked'))
        {
          return checkoutClass.checkPoints();
        }
        return false;
      });
    }

    $('#checkoutButton').click(function() {
      return checkAllErrors();
    });

    if (this.ccgvInstalled == true){
      $('input[name="gv_redeem_code"]').focus(function (){
        if ($(this).val() == 'redeem code'){
          $(this).val('');
        }
      });

      $('#voucherRedeem').click(function (){
        checkoutClass.queueAjaxRequest({
          url: checkoutClass.pageLinks.checkout,
          data: 'action=redeemVoucher&code=' + $('input[name="gv_redeem_code"]').val(),
          type: 'post',
          beforeSendMsg: 'Validating Coupon',
          dataType: 'json',
          success: function (data){
            if (data.success == false){
              
              alert('Coupon is either invalid or expired.');
               $('input[name="gv_redeem_code"]').val('');
            }
            checkoutClass.updateOrderTotals();
                        checkoutClass.updatePayment();
          },
          errorMsg: 'There was an error redeeming coupon, please inform ShedsForLessDirect about this error.'
        });
        return false;
      });
      if($('input[name="cot_gv"]', $('#paymentMethods')))
      {
        $('input[name="cot_gv"]', $('#paymentMethods')).each(function (){
          $(this).change(function (e){
            checkoutClass.setGV(($(':checkbox[name="cot_gv"]').is(':checked'))?'':'on');
          });
        });
      }
    }
    if (this.kgtInstalled == true){
      $('input[name="coupon"]').focus(function (){
        if ($(this).val() == 'coupon code'){
          $(this).val('');
        }
      });
      $('#voucherRedeemCoupon').click(function (){
        checkoutClass.queueAjaxRequest({
          url: checkoutClass.pageLinks.checkout,
          data: 'action=redeemVoucher&code=' + $('input[name="coupon"]').val(),
          type: 'post',
          beforeSendMsg: 'Validating Coupon',
          dataType: 'json',
          success: function (data){
            if (data.success == false){
              $('input[name="coupon"]').val('');
              alert('Coupon is either invalid or expired.');
              
            }
            //alert(data.message);
            checkoutClass.updateOrderTotals(true);
                        checkoutClass.updatePayment();
          },
          errorMsg: 'There was an error redeeming coupon, please inform ShedsForLessDirect about this error.'
        });
        return false;
      });
    }
    if (this.loggedIn == true && this.showAddressInFields == true){
      $('*[name="billing_state"]').trigger('change');
      $('*[name="delivery_state"]').trigger('change');
    }

    this.initializing = false;
  }
}