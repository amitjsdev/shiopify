<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>

{% include 'currencies' %}
<style>
  span.product-label.sale {
    display: none;
}
  .headline {
    display: none!important;
}
  a.liSectionLoop.menusleftLi-4 {
    color: #d40000!important;
}
  .swatch .tooltip{
    display: none!important;
  }
  .option-selectors.options-2 {
    display: none;
  }
  /* 
  Swatches Styles
  */

  {% assign width = '50px' %}
  {% assign height = '35px' %}
  .swatch { 
    margin:1em 0; 
  }
  /* Label */
  .swatch .header {
    margin: 0.5em 0;
  }
  /* Hide radio buttons.*/
  .swatch input { 
    display:none;
  }
  .swatch label {
    /* Rounded corners */
    -webkit-border-radius:2px;
    -moz-border-radius:2px;
    border-radius:2px;
    /* To give width and height */
    float:left;
    /* Color swatches contain no text so they need to have a width. */
    min-width:{{ width }} !important; 
    height:{{ height }} !important;
    /* No extra spacing between them */
    margin:0;
    /* The border when the button is not selected */
    border:#ccc 1px solid;
    /* Background color */
    background-color:#ddd;
    /* Styling text */
    font-size:13px;
    text-align:center;
    line-height:{{ height }};
    white-space:nowrap;
    text-transform:uppercase;
  }
  .swatch-element label { padding:0 10px; }
  .color.swatch-element label { padding:0; }
  /* Styling selected swatch */
  /* Slightly raised */
  .swatch input:checked + label {
    -webkit-box-shadow:0px 1px 2px rgba(0,0,0,0.8);
    -moz-box-shadow:0px 1px 2px rgba(0,0,0,0.8);
    box-shadow:0px 1px 2px rgba(0,0,0,0.8);
    border-color:transparent;
  } 
  .swatch .swatch-element {
    float:left;
    -webkit-transform:translateZ(0); /* webkit flicker fix */
    -webkit-font-smoothing:antialiased; /* webkit text rendering fix */
    /* Spacing between buttons */
    margin:0px 10px 10px 0;
    /* To position the sold out graphic and tooltip */
    position:relative;
  }
  /* Image with the cross in it */
  .crossed-out { position:absolute; width:100%; height:100%; left:0; top:0; }
  .swatch .swatch-element .crossed-out { display:none; }
  .swatch .swatch-element.soldout .crossed-out { display:block; }
  .swatch .swatch-element.soldout label {
    filter: alpha(opacity=60); /* internet explorer */
    -khtml-opacity: 0.6;      /* khtml, old safari */
    -moz-opacity: 0.6;       /* mozilla, netscape */
    opacity: 0.6;           /* fx, safari, opera */
  }
  /* Tooltips */
  .swatch .tooltip {
    text-align:center;
    background:gray;
    color:#fff;
    bottom:100%;
    padding: 10px;
    display:block;
    position:absolute;
    width:100px;
    left:{{ width | remove: 'px' | to_number | divided_by: 2 | minus: 50 | plus: 2 }}px;
    margin-bottom:15px;
    /* Make it invisible by default */
    filter:alpha(opacity=0);
    -khtml-opacity: 0;
    -moz-opacity: 0;
    opacity:0;
    visibility:hidden;
    /* Animations */
    -webkit-transform: translateY(10px);
    -moz-transform: translateY(10px);
    -ms-transform: translateY(10px);
    -o-transform: translateY(10px);
    transform: translateY(10px);
    -webkit-transition: all .25s ease-out;
    -moz-transition: all .25s ease-out;
    -ms-transition: all .25s ease-out;
    -o-transition: all .25s ease-out;
    transition: all .25s ease-out;
    -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    z-index: 10000;
    -moz-box-sizing:border-box; 
    -webkit-box-sizing:border-box; 
    box-sizing:border-box;
  }
  .swatch .tooltip:before {
    bottom:-20px;
    content:" ";
    display:block;
    height:20px;
    left:0;
    position:absolute;
    width:100%;
  }
  /* CSS triangle */
  .swatch .tooltip:after {
    border-left:solid transparent 10px;
    border-right:solid transparent 10px;
    border-top:solid gray 10px;
    bottom:-10px;
    content:" ";
    height:0;
    left:50%;
    margin-left:-13px;
    position:absolute;
    width:0;
  }
  .swatch .swatch-element:hover .tooltip {
    filter:alpha(opacity=100);
    -khtml-opacity:1;
    -moz-opacity:1;
    opacity:1;
    visibility:visible;
    -webkit-transform:translateY(0px);
    -moz-transform:translateY(0px);
    -ms-transform:translateY(0px);
    -o-transform:translateY(0px);
    transform:translateY(0px);
  }
  .swatch.error {
    background-color:#E8D2D2!important;
    color:#333!important;
    padding:1em;
    border-radius:5px;
  }
  .swatch.error p {
    margin:0.7em 0;
  }
  .swatch.error p:first-child {
    margin-top:0;
  }
  .swatch.error p:last-child {
    margin-bottom:0;
  }
  .swatch.error code {
    font-family:monospace;
  }
  .orderDropDown{
    display:none;
  }
  .detailsDiv{
    display:none;
  }

  .swatch .swatch-element.soldout .crossed-out {
    display: none;
  }
</style>
<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
</script>
<script>
  jQuery(document).ready(function($){

    $('.detailsTitle').click(function () {
      $(".detailsDiv").slideToggle();
    });

    $('.dropdownicon').click(function () {
      $(".dropdownicon").toggleClass("dropIconOrder");
      $(".orderDropDown").slideToggle();
    });

    setTimeout(function(){ 
      $("#clickyboxes-option-color > li a").each(function() {
        var dataColor = $(this).attr("data-value");
        if(dataColor == "Mix Black"){
          $(this).css("background-color", "#000000");
        }else if(dataColor == "oxblood"){
          $(this).css("background-color", "#800020");
        }else{

          $(this).css("background-color", dataColor);
        }

      });
    }, 2000);
  });
</script>
<script>
//size filter
  jQuery(document).ready(function($){
    var filter_color = [];
    var size_filter = [];
    $('.size_filter').click(function () {

      var collectionHandle = $('.collectionHandle').val();
      //  alert(pathname);

      $(".size_filter").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          size_filter.push($(this).find("input.checkedFields").val());
        }
      });
      localStorage.setItem('size_filter_var', size_filter);
      if(size_filter.length != 0){
        if(size_filter.length == 1){
          var sizeFilterVal = localStorage.getItem('size_filter_var')+"+";
        }else{
          const p = localStorage.getItem('size_filter_var');
          const regex = /,/gi;
          var sizeFilterVal = p.replace(regex, '+')+"+";
        }
      }else{
        var sizeFilterVal = "";
      }
      size_filter = [];
      $(".filter_color").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          filter_color.push($(this).find("input.checkedFields").val());
        }
      });

      if(filter_color.length != 0){
        localStorage.setItem('filter_color_var', filter_color);
        if(filter_color.length == 1){
          var colorFilterVal = localStorage.getItem('filter_color_var');
        }else{
          const p = localStorage.getItem('filter_color_var');
          const regex = /,/gi;
          var colorFilterVal = p.replace(regex, '+');
        }
      }else{
        var colorFilterVal = "";
      }
      filter_color = [];

      localStorage.setItem('filter_color_var', "");
      localStorage.setItem('size_filter_var', "");

      var sortByValue = $("input.sortByValue:checked").val()
      if(sortByValue){

      }else{

        var sortByValue ="";
      }
      var searchPageClass = $(".searchPageClass").val();
      if(searchPageClass == "searchPage"){
        $(".productLoop").hide();
        if(colorFilterVal != ""){
          //var colorFilterVal = colorFilterVal.toLowerCase();
          var colorFilterValArr = colorFilterVal.split("+");
          var colorFilterValCount = colorFilterValArr.length;
          var i;
          for (i = 0; i <= colorFilterValCount; i++) {
            $(".variant"+colorFilterValArr[i]).show();
            console.log("variant"+colorFilterValArr[i]);
          }
        }
        if(sizeFilterVal != ""){
          // var sizeFilterVal = sizeFilterVal.toLowerCase();
          var sizeFilterValArr = sizeFilterVal.split("+");
          var sizeFilterValCount = sizeFilterValArr.length;
          console.log(sizeFilterValCount);
          var i;
          for (i = 0; i <= sizeFilterValCount; i++) {
            $(".variant"+sizeFilterValArr[i]).show();
            console.log("variant"+sizeFilterValArr[i]);

          }
        }
        if(sizeFilterVal == "" && colorFilterVal == ""){
          $(".productLoop").show();
        }
      }else{
        if(sortByValue){
          var filterUrl = collectionHandle+'/'+sizeFilterVal+colorFilterVal+"?sort_by="+sortByValue;
        }else{
          var filterUrl =collectionHandle+'/'+sizeFilterVal+colorFilterVal;
        }
        console.log(filterUrl);

        $.ajax({
          url: filterUrl,
          data: {
            txtsearch: $('#appendedInputButton').val()
          },
          type: "GET",
          dataType: "html",
          success: function (data) {
            var result = $('<div />').append(data).find('#showresults').html();
            $('#showresults').html(result);
            var productLoop = $(".productLoop").length;
            if(productLoop == 0){
              $('#showresults').html('<p class="align-centre"><em>Sorry, there are no products matching your search.</em></p>');
            }
          },
          error: function (xhr, status) {
            alert("Sorry, there was a problem!");
          },
          complete: function (xhr, status) {
            //$('#showresults').slideDown('slow')
          }
        });
      }
    });



//     var url_string = window.location.href;
//     var url = new URL(url_string);
//     var sort_by = url.searchParams.get("sort_by");
//     if(sort_by){
//       //$(".filterCollection").slideToggle();  

//     }

    /* start filter */

    // color filter
   $('.filter_color').click(function () {
      var collectionHandle = $('.collectionHandle').val();
      $(".filter_color").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          filter_color.push($(this).find("input.checkedFields").val());
        }
      });

      if(filter_color.length != 0){
        localStorage.setItem('filter_color_var', filter_color);
        if(filter_color.length == 1){
          var colorFilterVal = localStorage.getItem('filter_color_var')+"+";
        }else{
          const p = localStorage.getItem('filter_color_var');
          const regex = /,/gi;
          var colorFilterVal = p.replace(regex, '+')+"+";
        }
      }else{
        var colorFilterVal = "";
      }
      filter_color = [];

      $(".size_filter").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          size_filter.push($(this).find("input.checkedFields").val());
        }
      });
      localStorage.setItem('size_filter_var', size_filter);
      if(size_filter.length != 0){
        if(size_filter.length == 1){
          var sizeFilterVal = localStorage.getItem('size_filter_var');
        }else{
          const p = localStorage.getItem('size_filter_var');
          const regex = /,/gi;
          var sizeFilterVal = p.replace(regex, '+');
        }
      }else{
        var sizeFilterVal = "";
      }
      size_filter = [];
      localStorage.setItem('filter_color_var', "");
      localStorage.setItem('size_filter_var', "");


      var sortByValue = $("input.sortByValue:checked").val()
      if(sortByValue){

      }else{

        var sortByValue ="";
      }
      var searchPageClass = $(".searchPageClass").val();
      if(searchPageClass == "searchPage"){
        $(".productLoop").hide();
        if(colorFilterVal != ""){
          //var colorFilterVal = colorFilterVal.toLowerCase();
          var colorFilterValArr = colorFilterVal.split("+");
          var colorFilterValCount = colorFilterValArr.length;
          var i;
          for (i = 0; i <= colorFilterValCount; i++) {
            $(".variant"+colorFilterValArr[i]).show();
            //  console.log("variant"+colorFilterValArr[i]);
          }
        }
        if(sizeFilterVal != ""){
          //  var sizeFilterVal = sizeFilterVal.toLowerCase();
          var sizeFilterValArr = sizeFilterVal.split("+");
          var sizeFilterValCount = sizeFilterValArr.length;
          console.log(sizeFilterValCount);
          var i;
          for (i = 0; i <= sizeFilterValCount; i++) {
            $(".variant"+sizeFilterValArr[i]).show();
            // console.log("variant"+sizeFilterValArr[i]);

          }
        }

        if(sizeFilterVal == "" && colorFilterVal == ""){
          $(".productLoop").show();
        }
      }else{
        if(sortByValue){
          var filterUrl = collectionHandle+'/'+colorFilterVal+sizeFilterVal+"?sort_by="+sortByValue;
        }else{
          var filterUrl =collectionHandle+'/'+colorFilterVal+sizeFilterVal;
        }
        console.log(filterUrl);

        $.ajax({
          url: filterUrl,
          data: {
            txtsearch: $('#appendedInputButton').val()
          },
          type: "GET",
          dataType: "html",
          success: function (data) {
            var result = $('<div />').append(data).find('#showresults').html();
            $('#showresults').html(result);
            var productLoop = $(".productLoop").length;
            if(productLoop == 0){
              $('#showresults').html('<p class="align-centre"><em>Sorry, there are no products matching your search.</em></p>');
            }
          },
          error: function (xhr, status) {
            alert("Sorry, there was a problem!");
          },
          complete: function (xhr, status) {
            //$('#showresults').slideDown('slow')
          }
        });
      }
    });
    //delte

    /* end fiter*/

//    $(".prctType-"+sort_by).prop("checked", true);
      jQuery(".filter-by").click(function () {
        $(".sortByTitle").removeClass("sortOpen");
//     $(document).on('click', '.filter-by', function(e){
      console.log("filter");
      //   $(".filter-by").addClass("opneFilter");
        if($(".filter-by").hasClass("opneFilter")){
        
           $(".filter-by").removeClass("opneFilter");
          $(".filterSortPrdct").hide();
          $(".filterVarint").slideUp();
          $(".filterArrow").toggleClass("arrowIcon");
          $(".sortByTitle").removeClass("arrowIcon");
      //      
        }else{
          
          $(".filterSortPrdct").hide();
          $(".filterVarint").slideDown();
          $(".filterArrow").toggleClass("arrowIcon");
          $(".sortByTitle").removeClass("arrowIcon");
         $(".filter-by").addClass("opneFilter");
        }

    });

//     $(document).on('click', '.sortByTitle', function(e){
        jQuery(".sortByTitle").click(function () {
 $(".filter-by").removeClass("opneFilter");
          if($(".sortByTitle").hasClass("sortOpen")){
            console.log("sortby");
            $(".filterVarint").hide();
            $(".filterSortPrdct").slideUp();
            $(".filterArrow").removeClass("arrowIcon");
            $(".sortByTitle").toggleClass("arrowIcon");
            $(".sortByTitle").removeClass("sortOpen");
          }else{
            console.log("sortby");
            $(".filterVarint").hide();
            $(".filterSortPrdct").slideDown();
            $(".filterArrow").removeClass("arrowIcon");
            $(".sortByTitle").toggleClass("arrowIcon");
            $(".sortByTitle").addClass("sortOpen");
          }

    });
    //SORT BY
   jQuery(".sortFilter").click(function () {
      var collectionHandle = $('.collectionHandle').val();
      $(".filter_color").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          filter_color.push($(this).find("input.checkedFields").val());
        }
      });

      if(filter_color.length != 0){
        localStorage.setItem('filter_color_var', filter_color);
        if(filter_color.length == 1){
          var colorFilterVal = localStorage.getItem('filter_color_var')+"+";
        }else{
          const p = localStorage.getItem('filter_color_var');
          const regex = /,/gi;
          var colorFilterVal = p.replace(regex, '+')+"+";
        }
      }else{
        var colorFilterVal = "";
      }
      filter_color = [];

      $(".size_filter").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          size_filter.push($(this).find("input.checkedFields").val());
        }
      });
      localStorage.setItem('size_filter_var', size_filter);
      if(size_filter.length != 0){
        if(size_filter.length == 1){
          var sizeFilterVal = localStorage.getItem('size_filter_var');
        }else{
          const p = localStorage.getItem('size_filter_var');
          const regex = /,/gi;
          var sizeFilterVal = p.replace(regex, '+');
        }
      }else{
        var sizeFilterVal = "";
      }
      size_filter = [];
      localStorage.setItem('filter_color_var', "");
    //  var url_string = window.location.href;
    //  var url = new URL(url_string);
      //var sort_by = url.searchParams.get("sort_by");

      localStorage.setItem('filter_color_var', "");
      localStorage.setItem('size_filter_var', "");
      if($(this).find("input.sortByValue").is(':checked')){
        var sortByValue = $(this).find(".sortByValue").val();
      }else{

        var sortByValue ="";
      }

      $(".sortByValue").prop( "checked", false );
      $(".prctType-"+sortByValue).prop( "checked", true );


      if(sortByValue){
        var filterUrl = collectionHandle+'/'+colorFilterVal+sizeFilterVal+"?sort_by="+sortByValue;
      }else{
        var filterUrl =collectionHandle+'/'+colorFilterVal+sizeFilterVal;
      }
      console.log(filterUrl);
      $.ajax({
        url: filterUrl,
        data: {
          txtsearch: $('#appendedInputButton').val()
        },
        type: "GET",
        dataType: "html",
        success: function (data) {
          var result = $('<div />').append(data).find('#showresults').html();
          $('#showresults').html(result);
          var productLoop = $(".productLoop").length;
          if(productLoop == 0){
            $('#showresults').html('<p class="align-centre"><em>Sorry, there are no products matching your search.</em></p>');
          }
        },
        error: function (xhr, status) {
          alert("Sorry, there was a problem!");
        },
        complete: function (xhr, status) {
          //$('#showresults').slideDown('slow')
        }
      });

    });
	//collection filter
	    //SORT BY
   jQuery(".categoryFilter").click(function () {
      var collectionHandle = $('.collectionHandle').val();
      $(".size_filter").find("input.checkedFields").prop("checked", false);
     $(".filter_color").find("input.checkedFields").prop("checked", false);
     $(".sortFilter").find("input.checkedFields").prop("checked", false);
     
     
          var categoryFilter = $(this).find("input.checkedFields").val();
		  if(categoryFilter){
			var collectionHandle = categoryFilter;
          $('.collectionHandle').val(collectionHandle);

		  }else{
			var collectionHandle = collectionHandle;
		  }
	var filterUrl = collectionHandle;
      console.log(filterUrl);
      $.ajax({
        url: filterUrl,
        data: {
          txtsearch: $('#appendedInputButton').val()
        },
        type: "GET",
        dataType: "html",
        success: function (data) {
          var result = $('<div />').append(data).find('#showresults').html();
          $('#showresults').html(result);
          var productLoop = $(".productLoop").length;
          if(productLoop == 0){
            $('#showresults').html('<p class="align-centre"><em>Sorry, there are no products matching your search.</em></p>');
          }
        },
        error: function (xhr, status) {
          alert("Sorry, there was a problem!");
        },
        complete: function (xhr, status) {
          //$('#showresults').slideDown('slow')
        }
      });

    });
	//collection filter end 
	
	//reset filter
   jQuery(".resetFilter").click(function () {
      var collectionHandlemain = $('.collectionHandlemain').val();
	  $('.collectionHandle').val(collectionHandlemain);
      $(".size_filter").find("input.checkedFields").prop("checked", false);
     $(".filter_color").find("input.checkedFields").prop("checked", false);
     //$(".sortFilter").find("input.sortByValue").prop("checked", false);
     $(".categoryFilter").find("input.checkedFields").prop("checked", false);
    
	var filterUrl = collectionHandlemain;
      console.log(filterUrl);
      $.ajax({
        url: filterUrl,
        data: {
          txtsearch: $('#appendedInputButton').val()
        },
        type: "GET",
        dataType: "html",
        success: function (data) {
          var result = $('<div />').append(data).find('#showresults').html();
          $('#showresults').html(result);
          var productLoop = $(".productLoop").length;
          if(productLoop == 0){
            $('#showresults').html('<p class="align-centre"><em>Sorry, there are no products matching your search.</em></p>');
          }
        },
        error: function (xhr, status) {
          alert("Sorry, there was a problem!");
        },
        complete: function (xhr, status) {
          //$('#showresults').slideDown('slow')
        }
      });

    });
	//reset filter end 
	
    $(document).on('click', '#search_modal_popup_head', function(e){
      $("#search-modal_popup").show();
      $("#page-bolongaro-trevor").addClass("modal-active");
      $("#search-modal_popup").addClass("unreveal");
    });

    $(document).on('click', '.serchClose', function(e){
      $("#search-modal_popup").hide();
      $(this).removeClass("reveal");
      $("#page-bolongaro-trevor").removeClass("modal-active");
    });
    $(document).on('click', '.parentLia', function(e){
      $(this).find(".childUl").slideToggle();
    });
  });
</script>

{% if template  != "index" %}
<script>
  jQuery(document).ready(function($){
    $(window).scroll(function(){    
      var scroll = $(window).scrollTop();
      if (scroll > 0) {
        $(".logoDiv").css("visibility","hidden");
      } else {
        $(".logoDiv").css("visibility","visible");
        $(".leftMrnuDiv > .parentUl").css("top","0px");
      }

      var div1 = $(".leftMrnuDiv");
      var div2 = $("#shopify-section-footer");
      var div1_top = div1.offset().top;
      var div2_top = div2.offset().top;
      var div1_bottom = div1_top + div1.height();
      var div2_bottom = div2_top + div2.height();

      var divHeight = div1.height()/2;
      var divHeight = parseInt(divHeight) - 30;
      //console.log(div1_bottom+"div total height");

      //console.log(div2.height());
      //console.log(div2_bottom);

      if (div1_bottom >= div2_top && div1_top < div2_bottom) {
        // console.log("2");
        $(".leftMrnuDiv > .parentUl").css("top","-"+divHeight+"px");
        $(".leftMrnuDiv > .parentUl").css("position","relative");
        $(".leftMrnuDiv > .parentUl").addClass("footerDivMenu");
      } else {
        $(".leftMrnuDiv > .parentUl").css("top","0px");
        $(".leftMrnuDiv > .parentUl").removeClass("footerDivMenu");
        // console.log("1");
      }
    });
  });
</script>

{% else %}
<script>
  jQuery(document).ready(function($){
  var width = $(window).width();
    if(width > 1024){
    $(window).scroll(function(){    
      var scroll = $(window).scrollTop();
      var div1 = $(".leftMrnuDiv");
      var div2 = $("#shopify-section-footer");
      var div1_top = div1.offset().top;
      var div2_top = div2.offset().top;
      var div1_bottom = div1_top + div1.height();
      var div2_bottom = div2_top + div2.height();

      var divHeight = div1.height()/2;
      var divHeight = parseInt(divHeight) - 30;
      console.log(div1_bottom+"div total height");

      //console.log(div2.height());
      //console.log(div2_bottom);

      if (div1_bottom >= div2_top && div1_top < div2_bottom) {
        // console.log("2");
        $(".leftMrnuDiv > .parentUl").css("top","-"+divHeight+"px");
        $(".leftMrnuDiv > .parentUl").css("position","relative");
        $(".leftMrnuDiv > .parentUl").addClass("footerDivMenu");
      } else {
        $(".leftMrnuDiv > .parentUl").css("top","0px");
        $(".leftMrnuDiv > .parentUl").removeClass("footerDivMenu");
        // console.log("1");
      }

      var loopCount = $('.liSectionLoop').length;
      // console.log(loopCount);
      var i;
      for (i = 1; i <= loopCount; i++) {

        var div1 = $(".menusleftLi-"+i);
        var div2 = $(".homePageDiv");
        var div1_top = div1.offset().top;
        var div2_top = div2.offset().top;
        var div1_bottom = div1_top + div1.height();
        var div2_bottom = div2_top + div2.height();
        if (div1_bottom >= div2_top && div1_top < div2_bottom) {

          $(".menusleftLi-"+i).css("color","white");
        } else{
          $(".menusleftLi-"+i).css("color","black");
        }
      }

      var loopCountGrand = $('.liGrandSectionLoop').length;
      // console.log(loopCount);
      var i;
      for (i = 1; i <= loopCountGrand; i++) {

        var div1 = $(".menuGrandChild-"+i);
        var div2 = $(".homePageDiv");
        var div1_top = div1.offset().top;
        var div2_top = div2.offset().top;
        var div1_bottom = div1_top + div1.height();
        var div2_bottom = div2_top + div2.height();
        if (div1_bottom >= div2_top && div1_top < div2_bottom) {

          $(".menuGrandChild-"+i+" > a").css("color","white");
        } else{
          $(".menuGrandChild-"+i+" > a").css("color","black");
        }

      }

      var div1 = $(".rightmenuDiv");
      var div2 = $(".homePageDiv");
      var div1_top = div1.offset().top;
      var div2_top = div2.offset().top;
      var div1_bottom = div1_top + div1.height();
      var div2_bottom = div2_top + div2.height();
      if (div1_bottom >= div2_top && div1_top < div2_bottom) {

        $(".rightMenu").css("color","white");
      } else{
        $(".rightMenu").css("color","black");
      }

      var div1 = $(".logoDiv");
      var div2 = $(".homePageDiv");
      var div1_top = div1.offset().top;
      var div2_top = div2.offset().top;
      var div1_bottom = div1_top + div1.height();
      var div2_bottom = div2_top + div2.height();
      if (div1_bottom >= div2_top && div1_top < div2_bottom) {
        $(".blackLogo").hide();
        $(".whiteLogo").show();
      } else{
        $(".blackLogo").show();
        $(".whiteLogo").hide();
      }
    });
	}
  });
</script>
{% endif %}

<script>
  // registerPage validation
  jQuery(document).ready(function($){

    $( "#create_customer" ).submit(function( event ) {
      
            var newsletterSubs =  $(".newsletterSubs").val();
      console.log(newsletterSubs);
      if(newsletterSubs == "yes"){
       $(".divnewsletter").append('<input id="contact_tags" name="contact[tags]" type="hidden" value="prospect,newsletter">');
        $("form#new_contact").submit();
      }
      var first_name = $("#first_name").val();
      if(first_name.trim() != ""){
        $(".errorFirstName").hide();
      }else{
        $(".errorFirstName").show();
        return false;
      }
      var last_name = $("#last_name").val();
      if(last_name.trim() != ""){
        $(".errorLastName").hide();
        $("#custom_field_text_field_2421833").val(first_name+' '+last_name);
        
      }else{
        $(".errorLastName").show();
        return false;
      }
     
      var customer_email = $("#customer_register_email").val();
      if(customer_email.trim() != ""){
         $("#custom_field_text_field_2421833").val(customer_email);
        $(".errorEmail").hide();
      }else{
        $(".errorEmail").show();
        return false;
      }
      var customer_confirm_email = $("#customer_confirm_email").val();
      if(customer_confirm_email.trim() != ""){
        console.log(customer_email);
        console.log(customer_confirm_email);
        if(customer_confirm_email == customer_email){
          $(".errorConfirmEmail").text("This Field Is Required!");
        }else{
          $(".errorConfirmEmail").text("Email Not Matched!");
          $(".errorConfirmEmail").show();
          return false;
        }

        $(".errorConfirmEmail").hide();
      }else{
        $(".errorConfirmEmail").show();
        return false;
      }      
      var customer_password = $("#customer_password").val();
      if(customer_password.trim() != ""){
        $(".errorPassword").hide();
      }else{
        $(".errorPassword").show();
        return false;
      }
      var customer_confirm_password = $("#customer_confirm_password").val();
      if(customer_confirm_password.trim() != ""){
        console.log(customer_password);
        console.log(customer_confirm_password);
        if(customer_confirm_password == customer_password){
          
          $(".errorConfirmPassword").text("This Field Is Required!");
        }else{
          $(".errorConfirmPassword").text("Password Not Matched!");
          $(".errorConfirmPassword").show();
          return false;
        }
        $(".errorConfirmPassword").hide();
      }else{
        $(".errorConfirmPassword").show();
        return false;
      }     

      var pathname = window.location.pathname; 
      if(pathname.indexOf("register") > -1){

       // $("#myBtn").trigger("click");

        var customerDateOfBirth = $("#customerDateOfBirth").val();
        if(customerDateOfBirth.trim() != ""){
          $(".errorDate").hide();
        }else{
          $(".errorDate").show();
          return false;
        }      
        var customer_geneder_female = $(".customer_geneder_female").val();
        if(customer_geneder_female != ""){
          $(".errorGender").hide();
        }else{
          $(".errorGender").show();
          return false;
        }     
      }
      

    //  return false;
      //event.preventDefault();
    });
  });
</script>

<script>
  jQuery(document).ready(function($){ 

    $(document).on('click', '.classSizeChart', function(e){
      $("#sizeChartContainer").css({'right':'0px' });
      $("#PageContainer").addClass("menuOpen");
      $("body").addClass("menuOpenScroll");
    });

    $(".closeSizeChart").click(function () {
      $("#PageContainer").removeClass("menuOpen");
      $("body").removeClass("menuOpenScroll");
      $("#sizeChartContainer").css({'right':'-100%' });
    });

    jQuery('.swatch :radio').change(function() {

      var optionIndex = jQuery(this).closest('.swatch').attr('data-option-index');
      var optionValue = jQuery(this).val();
      console.log(optionIndex);
      jQuery(this)
      .closest('form')
      .find('.single-option-selector')
      .eq(optionIndex)
      .val(optionValue)
      .trigger('change');
    });

    $(document).on('click', '.swatch-element', function(e){
      if($(this).hasClass("sizeVarinat")){
        var sizeVal = $(this).attr( "data-value" );
        var sizeVal = sizeVal.toLowerCase();
        $(".sizeVarinat").removeClass("varintActive");
        $(".active-"+sizeVal).addClass( "varintActive" );
        //console.log(sizeVal);
      }
      if($(this).hasClass("colorVariant")){
        var colorvar = $(this).attr( "data-value" );
        var colorvar = colorvar.toLowerCase();
        $(".colorVariant").removeClass("colorvarintActive");
        $(".active-"+colorvar).addClass( "colorvarintActive" );
        // console.log(colorvar);
      }
      var colorvarintActive = $(".colorvarintActive").attr("data-value");
      var varintActive = $(".varintActive").attr("data-value");

      var sletediD = varintActive+'/'+colorvarintActive;


      if(typeof(colorvarintActive) == "undefined" && varintActive != "" ){
        console.log(varintActive);
        var sletediD = varintActive;
        $('#ProductSelect-product-template option[id="'+sletediD+'"]').prop('selected', true);       

      }
      if(colorvarintActive != "" && typeof(varintActive) == "undefined" ){

        var sletediD = colorvarintActive;
        $('#ProductSelect-product-template option[id="'+sletediD+'"]').prop('selected', true);       

      }

      if(colorvarintActive != "" && varintActive != "" ){
        var sletediD = varintActive+'/'+colorvarintActive;
        $('#ProductSelect-product-template option[id="'+sletediD+'"]').prop('selected', true);       

      }
    });
    $(document).on('click', '.colorVarint', function(e){
      var maineImage = $(this).attr( "data-img" );
      if(maineImage == ""){
        var maineImage = $(".maineImg").val();
      }
      $(".currentImage-1").attr("src",maineImage);
      //           if($(this).hasClass("sizeVarinat")){
      //          		var sizeVrnt = $(this).attr("data-value");
      //           }
      //           if($(this).hasClass("sizeVarinat")){

      //           }
    });        


 

    var width = $(window).width();
    if(width < 768){
      $(".loginDesktop").html("");
    }else{
      var pathname = window.location.pathname; 
      $(".loginPage").html("");
      if(pathname.indexOf("login") > -1){
        $("#myBtn").trigger("click");
      }
    }
    $(".crossMobile").click(function(e){
      console.log("addds");
      $(".mobile-menu").trigger("click");
      $(".leftMrnuDiv").hide();
    });
//     $(document).on('click', '.crossMobile', function(e){
//       console.log("addds");
//       $(".mobile-menu").trigger("click");
//       $(".leftMrnuDiv").hide();
//     });      

    $(".mobile-menu").click(function(e){
      $(".leftMrnuDiv").toggleClass("openMenu");
      if($(".leftMrnuDiv").hasClass("openMenu")){
        $(".leftMrnuDiv").show();
      }
      console.log("addds");
    });
//     $(document).on('click', '.mobile-menu', function(e){
//       $(".leftMrnuDiv").toggleClass("openMenu");
//       if($(".leftMrnuDiv").hasClass("openMenu")){
//         $(".leftMrnuDiv").show();
//       }
//       console.log("addds");
//       // $(".mobile-menu").trigger("click");
//       // $(".leftMrnuDiv").hide();
//     });          


    //search page filter

    $(document).on('click', '.collectionFilter', function(e){
      var checkedFields = [];

      $(".collectionFilter").each(function() {
        if($(this).find("input.checkedFields").is(':checked')){
          checkedFields.push($(this).find("input.checkedFields").val());
        }
      });
      console.log(checkedFields);
      if(checkedFields != ""){
        $(".productLoop").hide();
        var colorFilterValCount = checkedFields.length;
        console.log(colorFilterValCount);
        var i;
        for (i = 0; i <= colorFilterValCount; i++) {
          $(".variant"+checkedFields[i]).show();
          console.log("variant"+checkedFields[i]);
        }
      }else{
        $(".productLoop").show();
      }
    });
    
      setTimeout(function(){ 
   var width = $(window).width();
    if(width < 768){
      $(".mailmunch-forms-widget-892768").show();
    }else{
    $(".mailmunch-forms-widget-892768").hide();
    
    }
    }, 2000);
 
    
     //$(document).on('click', '.newdDiv.mobileNewsletter:after', function(e){
    $(".newdDiv.mobileNewsletter:after").click(function(){
      $(".mailmunch-embedded").hide();
    });
  });
</script>
{% if template  == "product" %}
<script>
  jQuery(document).ready(function($){ 
    setTimeout(function(){
      var dataVariant = [];
      var dataVariant = $('#ProductSelect-product-template option:selected').attr("data-variant");
      console.log(dataVariant);
      var res = dataVariant.split("/");

      $(".active-"+res[0]).addClass("varintActive");
      $(".active-"+res[1]).addClass("colorvarintActive");

    },3000);  


    //  Looks Better Section
    let looksBetter = jQuery('#looksBetter');
    let looksBetterSettings_slider = {
      autoplay:false,
      arrows: true,
      dots: false,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      speed: 300
    }
    slick_on_mobile( looksBetter, looksBetterSettings_slider);

    // slick on mobile
    function slick_on_mobile(slider, settings){
      $(window).on('load resize', function() {
        if ($(window).width() > 767) {
          if (slider.hasClass('slick-initialized')) {
            slider.slick('unslick');
          }
          return
        }
        if (!slider.hasClass('slick-initialized')) {
          return slider.slick(settings);
        }
      });
    };
  });
</script>
{% endif %}