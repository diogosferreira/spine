



var imgi=2;

//-- IMAGES CHANGING --


setInterval( function(){
    var src = "images/magazine" + imgi + ".jpg";
  //  console.log("changed orb image to: "+ src);
    
    $('#firstPage').css('background-image', 'url(' + src + ')');
    
    imgi++;
    if(imgi==5)
        imgi=1;
},2000);



//-- SCROLL ANIMATION --

function onScrollInit( items, trigger ) {
  items.each( function() {
    var osElement = $(this),
        osAnimationClass = osElement.attr('data-os-animation'),
        osAnimationDelay = osElement.attr('data-os-animation-delay');
      
        osElement.css({
          '-webkit-animation-delay':  osAnimationDelay,
          '-moz-animation-delay':     osAnimationDelay,
          'animation-delay':          osAnimationDelay
        });

        var osTrigger = ( trigger ) ? trigger : osElement;
        
        osTrigger.waypoint(function() {
          osElement.addClass('animated').addClass(osAnimationClass);
          },{
              triggerOnce: true,
              offset: '90%'
        });
  });
}

 onScrollInit( $('.os-animation') );
 onScrollInit( $('.staggered-animation'), $('.staggered-animation-container') );




var $container = $('.dropdown-menu'),
    $list = $('.dropdown-menu ul'),
    listItem = $list.find('li');

$(".dropdown .title").click(function () {
  if( $container.height() > 0) {
    closeMenu(this);
  } else {
    openMenu(this);
  }
});

$(".dropdown-menu li").click(function () {
  closeMenu(this);
});

function closeMenu(el) {
  $(el).closest('.dropdown').toggleClass("closed").find(".title").text($(el).text());
  $container.css("height", 0);
  $list.css( "top", 0 );
}

function openMenu(el) {
  $(el).parent().toggleClass("closed");
  
  $container.css({
    height: 200
  })
  .mousemove(function(e) {
    var heightDiff = $list.height() / $container.height(),
        offset = $container.offset(),
        relativeY = (e.pageY - offset.top),
        top = relativeY*heightDiff > $list.height()-$container.height() ?
              $list.height()-$container.height() : relativeY*heightDiff;

    $list.css("top", -top);
  });
}



$(document).ready(function() {
	// Test for placeholder support
    $.support.placeholder = (function(){
        var i = document.createElement('input');
        return 'placeholder' in i;
    })();

    // Hide labels by default if placeholders are supported
    if($.support.placeholder) {
        $('.form-label').each(function(){
            $(this).addClass('js-hide-label');
        });  

        // Code for adding/removing classes here
        $('.form-group').find('input, textarea').on('keyup blur focus', function(e){
            
            // Cache our selectors
            var $this = $(this),
                $parent = $this.parent().find("label");

            if (e.type == 'keyup') {
                if( $this.val() == '' ) {
                    $parent.addClass('js-hide-label'); 
                } else {
                    $parent.removeClass('js-hide-label');   
                }                     
            } 
            else if (e.type == 'blur') {
                if( $this.val() == '' ) {
                    $parent.addClass('js-hide-label');
                } 
                else {
                    $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                }
            } 
            else if (e.type == 'focus') {
                if( $this.val() !== '' ) {
                    $parent.removeClass('js-unhighlight-label');
                }
            }
        });
    } 
});