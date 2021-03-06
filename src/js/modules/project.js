/**
*	@desc module control for Product Items
*/

var settings = require('modules/settings'),
slideshow = require("modules/slideshow");

module.exports = function( el ) {
	
	var $el = $(el),
		$window = $(window),
    $overviewBtn = $('.overview-btn'),
    $imagesBtn = $('.images-btn'),
    body_padding = $('.dummy-box').height(),
    ot = $('.content-inner').position().top,
    inner_padding = $('.related .inner').outerWidth() - $('.related .inner').width(),
    scrollPos = 0;
    
	init();
  
	function init(){
    
    console.log('%c [project.init]', 'color:blue')
    
		
    if(!$('body').hasClass('writing')) {
  		$overviewBtn.on('click', showOverview);
      $imagesBtn.on('click', showImages);
 
      $('.close').attr('href', $('.project_link').data('url')).on('click', closeClick);
    
      slideshow.init();
      slideshow.setBlocks( $('.project-block').toArray() );
      
      if ( $('body').hasClass('single-slideshow') ) {
        slideshow.showSlideshow();
      }
      
      if ( !$('html').hasClass('touch') ) {
        $('.project-block').on('click', projectBlockClick);
        $(window).on('scroll', projectScroll);
        projectScroll();
      } else {
        slideshow.showMobileSlideshow();
      }
    
      $(window).on('resize', winResize);
      
    }
    
    
    
    
	}
  
  function projectScroll(){
    if($('html').hasClass('touch')) return true;
    
    if($('body').hasClass('overview'))
      scrollPos = $(window).scrollTop();
    
    console.log('project scroll')
    
    if ( $('.related .inner').height() > $window.height() - ot/2 )
      scrollRelatedOut();
    else
      scrollRelatedIn();
    
    if ( $('.text .inner').height() > $window.height() - ot/2 )
      scrollOverviewTextOut();
    else
      scrollOverviewTextIn();
    
    if ( $('.project-images .container').height() > $window.height() - ot/2 )
      scrollImageSetOut();
    else
      scrollImageSetIn();
    
  }
  
  function scrollRelatedOut(){
    
    if ( $('.related .inner').height() > $('.project-images .container').height() && $('.related .inner').height() >  $('.text .inner').height() ) return false;
    
    if ( $('.related .inner').height() > $window.height() ) {
      if ( $window.scrollTop() > $('.related .inner').height() - $window.height() + ot + body_padding) {
        $('.related .inner').addClass('fixed').css('width', $('.related').width() - inner_padding)
      } else {
        $('.related .inner').removeClass('fixed').css('width', '');
      }
    } else {
      if ( $window.scrollTop() < ot - body_padding) {
        $('.related .inner').removeClass('fixed').css('width', '').css('top', '');
      }
    }
    
    
    
  }
  
  function scrollRelatedIn(){
    
    if ( $window.scrollTop() > ot - body_padding) {
      $('.related .inner').addClass('fixed top').css('width', $('.related').width() - inner_padding).css('top', body_padding)
    } else {
      $('.related .inner').removeClass('fixed top').css('width', '').css('top', '');
    }
    
  }
  
  function scrollOverviewTextOut(){
    
    if ( $('.text .inner').height() > $('.related .inner').height() && $('.text .inner').height() >  $('.project-images .container').height() ) return false;
    
    if ( $('.text .inner').height() > $window.height() ) {
      if ( $window.scrollTop() > $('.text .inner').height() - $window.height() + ot + body_padding) {
        $('.text .inner').addClass('fixed').css('width', $('.text').width() - inner_padding)
      } else {
        $('.text .inner').removeClass('fixed top').css('width', '');
      }
    } else {
      if ( $window.scrollTop() < ot - body_padding) {
        $('.text .inner').removeClass('fixed').css('width', '');
      }
    }
    
  }
  
  function scrollOverviewTextIn(){
    
    if ( $window.scrollTop() > ot - body_padding ) {
      $('.text .inner').addClass('fixed top').css('width', $('.text').width() - inner_padding)
    } else {
      $('.text .inner').removeClass('fixed top').css('width', '');
    }
  }
    
  
  function scrollImageSetOut(){
    
    if ( $('.project-images .container').height() > $('.related .inner').height() && $('.project-images .container').height() >  $('.text .inner').height() ) return false;
    
    if ( $window.scrollTop() > $('.project-images .container').height() - $window.height() + ot + body_padding) {
      $('.project-images .container').addClass('fixed').css('width', $('.project-images').width())
    } else {
      $('.project-images .container').removeClass('fixed top').css('width', '');
    }
  }
  
  function scrollImageSetIn(){
    
    if ( $window.scrollTop() > ot/2 ) {
      $('.project-images .container').addClass('fixed').css('width', $('.project-images').width())
    } else {
      $('.project-images .container').removeClass('fixed top').css('width', '');
    }
  }
  
  
  
  
  
  function projectBlockClick(e){
    
    if(!$('body').hasClass('slideshow')) {
      slideshow.setBlock( $(e.currentTarget).index() );
      slideshow.showSlideshow();
      console.log('scrollPos ' + scrollPos);
    }
    
  }
  
  function closeClick(e){
    if($('body').hasClass('overview')) {
      //e.preventDefault();
      //slideshow.hideSlideshow();
      //console.log('scroll to ' + scrollPos);
      //$(window).scrollTop(scrollPos);
    }
    
  }
  
  function showOverview(e){
    e.preventDefault();
    slideshow.hideSlideshow();
    $('body').addClass('overview');
  }
  
  function showImages(e){
    e.preventDefault();
    slideshow.showSlideshow()
    $('body').removeClass('overview');
  }
  
  
  function winResize(){
    body_padding = $('.dummy-box').height();
    ot = $('.content-inner').position().top;
    inner_padding = $('.related .inner').outerWidth() - $('.related .inner').width();
    
    if(!$('body').hasClass('slideshow') && !$('html').hasClass('slideshow') && !$('html').hasClass('touch')){
      projectScroll();
    }
    
  }

	
}; 
  