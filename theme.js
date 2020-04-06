//custom_code   17-02-2020 Suffes

$(document).ready(function() {


  //Quantity upadte
  $(document).on('change', '#CartContainer1 .quantity,.cartPageQty', function(){
    //var $quantity = $(this).prev();
    var qty = $(this).val();
    var varient = $(this).data('id');
    var mainQty = $(".qty-"+varient).attr('data-qty');
/* Jerry America comment
    if(parseInt(qty) <= parseInt(mainQty)){
      console.log(qty+"done");


    }else{
     // $(this).val(mainQty);
     // var qty = mainQty;
      //alert('Please select valid Quantity');
      //return false;
    }
*/    
    if(parseInt(qty) > parseInt(mainQty)){
      console.log(qty+"done");
      $(this).val(mainQty);
      var qty = mainQty;
      // alert('Please select valid Quantity');
      // return false;
    }

    if(qty > 0){
   
    
    //console.log(varient);
    var data = { updates: {} };
    data.updates[varient] = qty;
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/update.js',
      data: data,
      dataType: 'json',
      success: function() { 
        $.getJSON( "/cart.json", function( data ) {
          // location.href = '/cart'; 
          //console.log(data);
          //console.log(theme.Currency.formatMoney(data.items[0].final_line_price, theme.settings.moneyFormat));
          $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
          $.each(data.items, function(key,val) { 
            if(data.items[key].id == varient){
              $('.updtePrice-'+varient).html(theme.Currency.formatMoney(data.items[key].final_line_price, theme.settings.moneyFormat));

              $('.cart_qui').text(data.item_count);
            }
          });

          //$('.cart_qui').text(qty);
          var q = data.item_count
          var  k= '240';
          var o = q * k ;
          console.log(o);
          $('.cart_sub_price').html('$'+o);
        })
      },
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          }
    });
      
    }else{
    
     //console.log(varient+"asdas");
      var productId = parseInt(varient);
      var data = { updates: {} };
      data.updates[productId] = 0;
      jQuery.ajax({
        type: 'POST',
        beforeSend: function(){ $('.ajax-loader').show(); },
        url: '/cart/update.js',
        data: data,
        dataType: 'json',
        success: function() { 
          $.getJSON( "/cart.json", function( data ) {
            if(data.item_count > 0){
              $(".tableCART").show();
              // location.href = '/cart';
              //console.log("test");
              $('#trid_'+productId ).remove();
              $('.cart_qui').text(data.item_count);
              var q = data.item_count
              
              $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
            var cartpage = $(".currentPage").val();
              //console.log(cartpage+"sdfsd");
              if(cartpage == "cartpage"){
             	 location.reload();
              }
            } else {
              //console.log("else");
              $(".emptyCart").hide();
              $(".emptyCartDiv").show();
              $(".tableCART").hide();
              $(".cartDiv2").hide();
              
              var cartpage = $(".currentPage").val();
              //console.log(cartpage+"sdfsd");
              if(cartpage == "cartpage"){
             	 location.reload();
              }
            }
          })
        }
        ,
        complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                             $('.ajax-loader').hide();
                            },
      });
    }
  

  });


  $(document).on('click', '.js-qty__adjust--plus', function(e){
 
    e.preventDefault();
    // alert("fdg");
    var fieldName = $(this).attr('data-qytPlus');
    // Get its current value
    var currentVal = parseInt($('.qtyALL-'+fieldName).val());
    //console.log(fieldName);
    console.log(currentVal);
    if (!isNaN(currentVal)) {
      // Increment
      $('.qtyALL-'+fieldName).val(currentVal + 1);
    } else {
      // Otherwise put a 0 there
      $('.qtyALL-'+fieldName).val(0);
    }
  });
  // This button will decrement the value till 0
  $(document).on('click', '.js-qty__adjust--minus', function(e){
    // alert("fdg");
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var fieldName = $(this).attr('data-qytMinus');
    // Get its current value
    var currentVal = parseInt($('.qtyALL-'+fieldName).val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 1) {
      // Decrement one
      $('.qtyALL-'+fieldName).val(currentVal - 1);
    } else {
      // Otherwise put a 0 there
      $('.qtyALL-'+fieldName).val(1);
    }
  });

  
  
  $(document).on('change', '.js-qty__num', function(e){
 
    e.preventDefault();
    // alert("fdg");
    var fieldName = $(this).attr('data-qytVal');
    // Get its current value
    var currentVal = parseInt($(this).val());
    //console.log(fieldName);
    console.log(currentVal);
    if (!isNaN(currentVal)) {
      // Increment
      $('.qtyALL-'+fieldName).val(currentVal);
    } else {
      // Otherwise put a 0 there
      $('.qtyALL-'+fieldName).val(0);
    }
  });
  


  $(".closeDrawer").click(function () {
    $("#PageContainer").removeClass("menuOpen");
    $("body").removeClass("menuOpenScroll");
    $("#CartContainer1").css({'right':'-100%' });
    
  });

  $(".cart-link").click(function () {


    $.getJSON( "/cart.json", function( data ) {

      //$('#CartContainer1 > tbody').empty();
      if(data.item_count > 0){
        var html='';
        $.each(data.items, function(key,val) {             
          html +='<tr id="trid_'+ val.id +'" class="responsive-table-row">'+
            '<td data-label="Product">'+
            '<div class="img-cart"><a href="'+ val.url +'"><img src="'+ val.image +'" alt="'+ val.title +'"></a></div></td>'+
            '<td><div class="cart_title"><a href="'+ val.url +'">'+ val.product_title +'</a></div><div id="field1" class="button-wrapper">'+
            '<button type="button" id="sub_'+ val.id +'" class="sub cat_qun">-</button>'+
            '<input type="tel" data-id="'+ val.id +'" id="update_'+ val.key +'" value="' + val.quantity + '" min="0"  class="quantity cartQty-'+ val.id +'">'+
            '<button type="button" id="add_'+ val.id +'" class="add cat_qu">+</button></div><a href="#" data-id="'+ val.id +'" class="slide-remove-item" title="Remove Item">X</a>'+
            '<div class="cart_line_price updtePrice-'+ val.id +'">'+theme.Currency.formatMoney(val.final_line_price, theme.settings.moneyFormat) +'</div></td></tr>';
          //console.log(val);
          //console.log(val.title);
        });   

		$(".cartDiv2").show();
        $(".emptyCart").show();
        $(".emptyCartDiv").hide();
        $(".tableCART").show();
        $('.cart_qui').text(data.item_count);
        var q = data.item_count
      
        $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
      } 
      else

      {
        $(".cartDiv2").hide();

        $(".emptyCart").hide();
        $(".emptyCartDiv").show();
        $(".tableCART").hide();

        $('.empty_msg').html('<a class="cust_link button cart-form__button" href="/products/go-the-safest-cane-ever">continue shopping</a>');

      }

      //console.log(html);

      $('table.tableCART').html(html);
    })

    $("#CartContainer1").css({'right':'0px' });
    $("#PageContainer").addClass("menuOpen");
     $("body").addClass("menuOpenScroll");
    
  });

   $(document).on('click', '.product__variants-button', function(){
    var pcount = 0;
    var id = $(this).attr("data-variant-id");
   // var qty = $(this).closest("div.ja-product-lower").find("input[name=â€™quantityâ€™]").val()
  //  console.log(qty);
    var qty = $(".qtyALL-"+id).val();
    var cartQty = $(".cartQty-"+id).val();
      //console.log(qty);
     console.log(cartQty);                                   
    var mainQty = $(".qtyALL-"+id).attr("data-qty");
    console.log(qty);
    console.log(mainQty);
     if(parseInt(qty) <= parseInt(mainQty)){

    }else{
      //console.log(cartQty);
      if(typeof(cartQty == "undefined")){
      var cartQty = 0;
      }
     var currentQty = mainQty - cartQty; 
       $(".qtyALL-"+id).val(currentQty);
      alert("Non ne abbiamo cosÃ¬ tanti! :)");
      return false;
    }
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/add.js',
      data: {
        quantity: qty,
        id: id
      },
      dataType: 'json',           
      success: function() {

        $.getJSON( "/cart.json", function( data ) {

          $(".addText-"+id).hide();
          $(".doneText-"+id).show();
          
         
          setTimeout(function(){

             $(".doneText-"+id).hide();

          }, 4000);
          setTimeout(function(){

            $(".addText-"+id).show();

          }, 4000);
          if(data.item_count > 0){
            var html='';
            $.each(data.items, function(key,val) {             
              html +='<tr id="trid_'+ val.id +'" class="responsive-table-row">'+
                '<td data-label="Product">'+
                '<div class="img-cart"><a href="'+ val.url +'"><img src="'+ val.image +'" alt="'+ val.title +'"></a></div></td>'+
                '<td><div class="cart_title"><a href="'+ val.url +'">'+ val.product_title +'</a></div><div id="field1" class="button-wrapper">'+
                '<button type="button" id="sub_'+ val.id +'" class="sub cat_qun">-</button>'+
                '<input type="tel" data-id="'+ val.id +'" id="update_'+ val.key +'" value="' + val.quantity + '" min="0"  class="quantity cartQty-'+ val.id +'">'+
                '<button type="button" id="add_'+ val.id +'" class="add cat_qu">+</button></div><a href="#" data-id="'+ val.id +'" class="slide-remove-item" title="Remove Item">X</a>'+
                '<div class="cart_line_price updtePrice-'+ val.id +'">'+theme.Currency.formatMoney(val.final_line_price, theme.settings.moneyFormat) +'</div></td></tr>';
              //console.log(val);
              //console.log(val.title);
            });   

            
            $('.cart_qui').text(data.item_count);
            var q = data.item_count
        
            $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
            $(".cartDiv2").show();
          } 
          else

          {

            $(".cust_form").hide(); 
            $('.empty_msg').show();
            $('.empty_msg').html('<a class="cust_link button cart-form__button" href="/products/go-the-safest-cane-ever">continue shopping</a>');

          }
          $(".emptyCart").show();
          $(".emptyCartDiv").hide();
          $(".tableCART").show();
          //console.log(html);
          $('.cart-link').trigger("click");
          $('#CartContainer1 > table').html(html);
        })


      },
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          },
      error: function() {

        alert('Non ne abbiamo cosÃ¬ tanti! :)');
      }

    }); 

  });


  $(document).on('click', '.recent_product__variants', function(){
    var pcount = 0;
    var id = $(this).attr("data-variant-id");
    var qty = $(".qtyALL-"+id).val();
    var cartQty = $(".cartQty-"+id).val();
    //console.log(qty);                                   
 
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/add.js',
      data: {
        quantity: qty,
        id: id
      },
      dataType: 'json',           
      success: function() {

        $.getJSON( "/cart.json", function( data ) {

          $(".addText-"+id).hide();
          $(".doneText-"+id).show();
          
         
          setTimeout(function(){

             $(".doneText-"+id).hide();

          }, 4000);
          setTimeout(function(){

            $(".addText-"+id).show();

          }, 4000);
          // $(".addText-"+id).fadeIn(4000);
          //$(".addText-"+id).html("Fatto");

          //console.log(data);
          //$('#CartContainer1 > tbody').empty();
          if(data.item_count > 0){
            var html='';
            $.each(data.items, function(key,val) {             
              html +='<tr id="trid_'+ val.id +'" class="responsive-table-row">'+
                '<td data-label="Product">'+
                '<div class="img-cart"><a href="'+ val.url +'"><img src="'+ val.image +'" alt="'+ val.title +'"></a></div></td>'+
                '<td><div class="cart_title"><a href="'+ val.url +'">'+ val.product_title +'</a></div><div id="field1" class="button-wrapper">'+
                '<button type="button" id="sub_'+ val.id +'" class="sub cat_qun">-</button>'+
                '<input type="tel" data-id="'+ val.id +'" id="update_'+ val.key +'" value="' + val.quantity + '" min="0"  class="quantity cartQty-'+ val.id +'">'+
                '<button type="button" id="add_'+ val.id +'" class="add cat_qu">+</button></div><a href="#" data-id="'+ val.id +'" class="slide-remove-item" title="Remove Item">X</a>'+
                '<div class="cart_line_price updtePrice-'+ val.id +'">'+theme.Currency.formatMoney(val.final_line_price, theme.settings.moneyFormat) +'</div></td></tr>';
              //console.log(val);
              //console.log(val.title);
            });   

            
            $('.cart_qui').text(data.item_count);
            var q = data.item_count
          
            $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
            $(".cartDiv2").show();
          } 
          else

          {

            $(".cust_form").hide(); 
            $('.empty_msg').show();
            $('.empty_msg').html('<a class="cust_link button cart-form__button" href="/products/go-the-safest-cane-ever">continue shopping</a>');

          }
          $(".emptyCart").show();
          $(".emptyCartDiv").hide();
          $(".tableCART").show();
          //console.log(html);
          $('.cart-link').trigger("click");
          $('#CartContainer1 > table').html(html);
        })


      },
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          },
      error: function() {

        alert('Non ne abbiamo cosÃ¬ tanti! :)');
      }

    }); 
  });

  $(".close_cust").click(function(){
    //$("#custom_cart").hide();
    $('body').removeClass("cust_move");
  });

  $(document).mouseup(function(e) 
                      {
    var container = jQuery("#CartContainer1");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
      // jQuery(".custom_cart").css("display","none");
      $('#CartContainer1').css("right","-570px");
      $("#PageContainer").removeClass("menuOpen");
       $("body").removeClass("menuOpenScroll");
    }
  });


  //Quantity
  $(document).on('click', '#CartContainer1 .add,.cart .add', function(){

    //alert("aSAD");
    $(this).prev().val(+$(this).prev().val() + 1);

  });

  $(document).on('click', '#CartContainer1 .sub,.cart .sub', function(){
    if ($(this).next().val() > 0) {
      if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
    }
  });




  //Quantity upadte
  $(document).on('click', '#CartContainer1 .add,.cart .add', function(){
   
    var $quantity = $(this).prev();
    var qty = $quantity.val();
    var varient = $quantity.data('id');
    //console.log(varient);
    var mainQty = $(".qty-"+varient).attr('data-qty');
    if(typeof(mainQty) == "undefined"){
    var mainQty = $(".qtyALL-"+varient).attr("data-qty");
    
    }
	//console.log(mainQty);
	//console.log(qty);
    if(parseInt(qty) <= parseInt(mainQty)){

    }else{
      $quantity.val(qty - 1); 
      alert('Non ne abbiamo cosÃ¬ tanti! :)');
      return false;
    }
    var data = { updates: {} };
    data.updates[varient] = qty;
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/update.js',
      data: data,
      dataType: 'json',
      success: function() { 
        $.getJSON( "/cart.json", function( data ) {
          // location.href = '/cart'; 
          //console.log(data);
          //console.log(theme.Currency.formatMoney(data.items[0].final_line_price, theme.settings.moneyFormat));
          $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));

          $.each(data.items, function(key,val) { 
            if(data.items[key].id == varient){
              $('.updtePrice-'+varient).html(theme.Currency.formatMoney(data.items[key].final_line_price, theme.settings.moneyFormat));

              $('.cart_qui').text(data.item_count);
            }
          });
        });
      },
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          }
    });
    //      $('.cart_qui').empty();



  });
  
  $(document).on('click', '#CartContainer1 .sub,.cart .sub', function(){
    var $quantity = $(this).next();
   
    var qty = $quantity.val();
     var varient = $quantity.data('id');
    //console.log(qty+"qty");
    if(qty > 0){
   
    
    //console.log(varient);
    var data = { updates: {} };
    data.updates[varient] = qty;
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/update.js',
      data: data,
      dataType: 'json',
      success: function() { 
        $.getJSON( "/cart.json", function( data ) {
          // location.href = '/cart'; 
          //console.log(data);
          //console.log(theme.Currency.formatMoney(data.items[0].final_line_price, theme.settings.moneyFormat));
          $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
          $.each(data.items, function(key,val) { 
            if(data.items[key].id == varient){
              $('.updtePrice-'+varient).html(theme.Currency.formatMoney(data.items[key].final_line_price, theme.settings.moneyFormat));

              $('.cart_qui').text(data.item_count);
            }
          });

          //$('.cart_qui').text(qty);
          var q = data.item_count
          var  k= '240';
          var o = q * k ;
          //console.log(o);
          $('.cart_sub_price').html('$'+o);
        })
      },
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          }
    });
      
    }else{
 //console.log(varient+"asdas");
      var productId = parseInt(varient);
      var data = { updates: {} };
      data.updates[productId] = 0;
      jQuery.ajax({
        type: 'POST',
        beforeSend: function(){ $('.ajax-loader').show(); },
        url: '/cart/update.js',
        data: data,
        dataType: 'json',
        success: function() { 
          $.getJSON( "/cart.json", function( data ) {
            if(data.item_count > 0){
              $(".tableCART").show();
              // location.href = '/cart';
              //console.log("test");
              $('#trid_'+productId ).remove();
              $('.cart_qui').text(data.item_count);
              var q = data.item_count
              
              $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
            var cartpage = $(".currentPage").val();
              //console.log(cartpage+"sdfsd");
              if(cartpage == "cartpage"){
             	 location.reload();
              }
            } else {
              //console.log("else");
              $(".emptyCart").hide();
              $(".emptyCartDiv").show();
              $(".tableCART").hide();
              $(".cartDiv2").hide();
              
              var cartpage = $(".currentPage").val();
              //console.log(cartpage+"sdfsd");
              if(cartpage == "cartpage"){
             	 location.reload();
              }
            }
          })
        }
        ,
        complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                             $('.ajax-loader').hide();
                            },
      });
    }

  });

  //$('.slide-remove-item').on('click', function(event){
  $(document).on('click', '.slide-remove-item', function(){
    event.preventDefault();
    var productId = parseInt($(this).attr('data-id'));
    var data = { updates: {} };
    data.updates[productId] = 0;
    jQuery.ajax({
      type: 'POST',
      beforeSend: function(){ $('.ajax-loader').show(); },
      url: '/cart/update.js',
      data: data,
      dataType: 'json',
      success: function() { 
        $.getJSON( "/cart.json", function( data ) {
          if(data.item_count > 0){
            $(".tableCART").show();
            // location.href = '/cart';
            //console.log("test");
            $('#trid_'+productId ).remove();
            $('.cart_qui').text(data.item_count);
            var q = data.item_count
       
            $('.cart_subtotal').html(theme.Currency.formatMoney(data.total_price, theme.settings.moneyFormat));
          } else {
            //console.log("else");
            $(".emptyCart").hide();
            $(".emptyCartDiv").show();
            $(".tableCART").hide();
            $(".cartDiv2").hide();

            var cartpage = $(".currentPage").val();
            //console.log(cartpage+"sdfsd");
            if(cartpage == "cartpage"){
              location.reload();
            }
          
          }
        })
      }
      ,
      complete: function(){ $('.ajax-loader1').css("visibility", "hidden");
                           $('.ajax-loader').hide();
                          },
    });

  });
//cart bubble
  setInterval(function(){ 

    $.getJSON( "/cart.json", function( data ) {

      //$('#CartContainer1 > tbody').empty();
      if(data.item_count > 0){
        $(".cart-link__bubble").addClass("cart-link__bubble--visible");
      }else{
        
        $(".cart-link__bubble").removeClass("cart-link__bubble--visible");
      }
    })

  }, 3000);

});