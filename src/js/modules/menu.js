var settings = require( "modules/settings" ),
	throttle = require("modules/throttle"),
  cart = require("modules/cart");



var menu = module.exports = {

hamburger: $('#main-hamburger'),
  menuTimer: 0, 

init: function(){
	
	menu.hamburger.on('click', menu.toggleMenu);
	$('.site-header__logo-link').on('click', menu.logoClick);
	
	if($('.site-nav a').length > 0) {
		$('.site-nav a').on('click', menu.toggleSiteNav);
		 
	}
},

logoClick: function(e){
	e.preventDefault();
	
	console.log('logoClick')
  cart.hide();
  
	if($('body').hasClass('menu-open')){
		menu.hideMenu();
	} else {
		$(settings.scrollContainer).animate({scrollTop:0}, 1000, 'easeInOutCubic');
	}
	
},

toggleMenu: function(e){
	e.preventDefault();
  console.log(settings.page.current)
  if(settings.page.current == 'product') {
    
  } else {
    
  	if( !$('body').hasClass('menu-open') ) {
		  
  		menu.showMenu();
		
  	} else {
		
  		menu.hideMenu();
		
  	}
  }
	
	
},

toggleSiteNav: function(e){
	
	e.preventDefault();
	console.log('click')
	if($(e.currentTarget).parent().find('.site-nav__page-content').length > 0 ){
		
    if( !$(e.currentTarget).parent().hasClass('open') ) {
        $('.site-nav li.open').removeClass('open');
        $(e.currentTarget).parent().addClass('open');
    } else {
        $(e.currentTarget).parent().removeClass('open');
    }
    
		//$(e.currentTarget).parent().toggleClass('open');
	}
	
},

showMenu: function(){
	
  //console.log($('#shopify-section-frontpage-collection')[0].scrollHeight)
  //console.log('scrolled ' + ( $('#shopify-section-frontpage-collection').scrollTop() + ($(window).height() * 2) ))
  if($('#shopify-section-frontpage-collection').scrollTop() + ($(window).height() * 2) > $('#shopify-section-frontpage-collection')[0].scrollHeight) {
    $('#shopify-section-frontpage-collection').addClass('animate-height');
  } else {
    $('#shopify-section-frontpage-collection').removeClass('animate-height');
  }
  
  $('.main__logo-link').removeClass('over clicked');
	$('body').addClass('menu-open');	
	this.hamburger.addClass('menu-open');
	$(window).on('click', menu.windowClickMenu);
  
  var destY = 0;
  
  $('#shopify-section-frontpage-collection').removeClass('animating-out');
  
  //console.log('show menu')
  //console.log($('#shopify-section-frontpage-collection').scrollTop())
  //console.log($('.frontpage-content-holder').offset().top)
  
  
  
  /*
  $('.frontpage-content-holder').css('-webkit-transform', 'translate(25vw, '+ destY +'px) scale(.5)')
                  .css('-ms-transform', 'translate(25vw, '+ destY +'px) scale(.5)')
                  .css('transform', 'translate(25vw, '+ destY +'px) scale(.5)')
  */
  
  //$('#shopify-section-frontpage-collection').animate({ scrollTop: $('#shopify-section-frontpage-collection').scrollTop() * .5 }, 1000, 'easeInOutCubic');

  //$('.frontpage-content-holder').css('top', -$('.frontpage-content-holder').height()*.25)
  
},

hideMenu: function(){
	
	$(window).off('click', menu.windowClickMenu);
	$('body').removeClass('menu-open');	
	this.hamburger.removeClass('menu-open');
	$('.site-nav li.open').removeClass('open');
  
  if($('#shopify-section-frontpage-collection').scrollTop() + ($(window).height() * 2) > $('#shopify-section-frontpage-collection')[0].scrollHeight) {
    $('#shopify-section-frontpage-collection').addClass('animate-height');
  } else {
    $('#shopify-section-frontpage-collection').removeClass('animate-height');
  }
  
  $('#shopify-section-frontpage-collection').addClass('animating-out');
  clearTimeout(menu.menuTimer);
  menu.menuTimer = setTimeout(function(){
    $('#shopify-section-frontpage-collection').removeClass('animating-out');
  }, 1000);
  
  var destY = 0;

  
},

windowClickMenu: function(e){
	
	if(e.clientX > $(window).width()/2) {
		menu.hideMenu();
	}
	
}
	
};
