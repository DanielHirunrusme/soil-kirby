/**
*	@desc module control for Product Items
*/

var settings = require('modules/settings');

module.exports = function( el ) {
	
	var $el = $(el),
		$window = $(window),
    $logoLink = $('.product__logo-link')
		
	//$('.product-description').bind('mousewheel', mouseWheel);
	init();
  
	function init(){
    
		$('*[data-fade="in"]').each(function(){
      var $th = $(this);
      setTimeout(function(){
        $th.addClass('fade-in');
      }, 200);
		});
   
		$window.on('resize', winResize);
    
		$el.closest('.main-content').on('scroll', productWinScroll);
    $logoLink.on('click', logoLinkClick).on('mouseover', logoLinkOver).on('mouseout', logoLinkOut);
    
    setMainContainer();
    setForm();
    attachFormEvents();
		attachItemEvents();
		preloadImages();
		//$('.product-images-holder img').on('click', nextImage);
	}
  
  function setMainContainer(){
    $('.main-content').css('height', $window.height());
  }
	
	function preloadImages(){
		var preload = [];
		for(var i=0; i<$('.grid__item-image').length; i++) {
			preload.push($('.grid__item-image').eq(i).attr('data-large-src'));
		}
		
		//console.log(preload)
		
		var promises = [];
		for (var i = 0; i < preload.length; i++) {
		    (function(url, promise) {
		        var img = new Image();
				    img.id = i;
		        img.onload = function() {
		          promise.resolve();
              $('.grid__item-image').eq(img.id).attr('src', $('.grid__item-image').eq(img.id).attr('data-large-src')).addClass('loaded')
				      $('.grid__item-image').eq(img.id).closest('.grid__item').addClass('loaded')
		        };
		        img.src = url;
		    })(preload[i], promises[i] = $.Deferred());
		}
		$.when.apply($, promises).done(function() {
		  //alert("All images ready sir!");
		});
	}
  
  function setForm(){
    $('.product-description-container').css('height', $('.product-description-inner-container').height() ).css('top', $(window).height()/2 - $('.product-description-container').height()/2 )
  }
  
  function attachFormEvents(){
    $('.variant-label').on('touchstart click', variantClick);
    $('.hover').off('touchstart touchend').on('touchstart touchend', function(e) {
        e.preventDefault();
        $(this).toggleClass('hover_effect');
    });
  }
  
  function variantClick(e) {
    console.log('variant click')
    
    e.stopPropagation();
    e.preventDefault();
    
    
    
    if(!$(e.currentTarget).hasClass('selected')){
      //console.log('variant click')
      var $li = $(e.currentTarget).closest('li');
      var $ul = $li.closest('.product-variants');
      var variant_id = $li.attr('data-variant-id');
      var variant_title = $li.attr('data-variant-title');
      var variant_index = $ul.closest('.product-variant').index();
      
      var $select_wrapper = $('.selector-wrapper').eq(variant_index);
      
      //console.log( variant_id )
      
      $select_wrapper.find('select option[value="'+ variant_title +'"]').prop('selected', 'selected').change();
      
      $ul.find('.variant-label.selected').removeClass('selected');
      $(e.currentTarget).addClass('selected');
  		$ul.find('input[type="radio"]').attr("checked", false);
  		$li.find('input[type="radio"]').attr("checked", true).trigger("click"); 
    }
    
  }
  
  function logoLinkClick(e) {
    console.log('-------------click------------');
    e.preventDefault();
    
    $('.main__logo-link').addClass('clicked');
    $('.product__logo-link').addClass('clicked');
    
  }
  
  function logoLinkOver(){
    $('.main__logo-link').addClass('over')
  }
  
  function logoLinkOut(){
    $('.main__logo-link').removeClass('over')
  }
	
	function attachItemEvents(){
		
	}
  
  function productWinScroll(){
    //console.log('scroll')
    var testY = $('.main__logo-link').height() + $('.main__logo-link').position().top;
    //console.log( $('.product-single').offset().top );
    //console.log( testY );
    if( $('.product-single').offset().top < testY  ){
      //console.log('change z-index')
    }
  }
	
	function winResize(){
    setMainContainer();
		setForm();
	}
	
}; 
  