/**
*	@desc module control for slideshows
*/

var mousewheel = require("jquery-mousewheel"),
throttle = require("modules/throttle"),
slideshow = require("modules/slideshow");

module.exports = function( el ) {
	
	var $el = $(el),
  $window = $(window),
  currImage = 0,
  totalImages = $('.project-block').length - 1;
  
  var lastAnimation = 0;
  var animationTime = 500; // in ms
  var quietPeriod = 500; // in ms, time after animation to ignore mousescroll

	init();
  
  function init(){
    console.log('%c [slideshow init]', 'color:blue')
    
    $window.on('mousedown', winDown);
    
    
    
    enableArrows();
    enableMouseWheel();
    enableControls();
    
    if ($('body').hasClass('slideshow')) {
      
      setupBackgrounds();
    }
    
    $window.on('resize', throttle(winResize, 300));
    
  }
  
  function enableMouseWheel() {
    
    $(window).on('mousewheel', winWheel);
    
  }

  function enableControls(){
    
    $('.controls .prev').off('click').on('click', backClick);
    $('.controls .next').off('click').on('click', nextClick);
    
  }
  
  function backClick(e){
    prevImage();
  }
  
  function nextClick(e){
    nextImage();
  }
  
  function setupBackgrounds(){
    
    $('.project-block').each(function(){
        
      var fit = $(this).data('fit-browser');
      if(fit == '0'){
        
        if ($(this).find('.video-positioner').length > 0) {
          fitImage($(this).find('.video-positioner'), $(this).find('.video-positioner').data('ratio'));
        } else {
          fitImage($(this).find('img'), $(this).data('ratio'));
        }
        
        
        
      } else {
        if ($(this).find('.video-positioner').length > 0) {
          fullBleed($(this).find('.video-positioner'), $(this).find('.video-positioner').data('ratio'));
        } else {
          fullBleed($(this).find('img'), $(this).data('ratio'));
        }
      }
        
    });
    
  }
  
  function fullBleed(img, ratio){
    
    var h = $window.height();
    var w = h * ratio;
    var l = $window.width()/2 - w/2;
    var t = $window.height()/2 - h/2;
    
    if (w < $window.width()){
      
      w = $window.width();
      h = w/ratio;
      l = $window.width()/2 - w/2;
      t = $window.height()/2 - h/2;
      
    }
    
    $(img).css({ 'height': h, 'width': w, 'left': l, 'top': t })
    
  }
  
  function fitImage(img, ratio){
    
    var ho = $('.main-nav').height() * 3.5;
    
    //if caption exists get the height
    var caption_height = $('.caption-text').length > 0 ? $('.caption-text').height() : $('.main-nav').height();
    
    if (caption_height/2 >= $('.main-nav').height())
      ho = $('.main-nav').height() * 2 + caption_height;
    
    
    
    var h = $window.height() - (ho*2);
    var w = h * ratio;
    var l = $window.width()/2 - w/2;
    var t = $window.height()/2 - h/2 - ( caption_height - $('.main-nav').height() )/2;
    
    
    
    //image width is larger than browser width
    if (w > $window.width() ) {
      
      w = $window.width() - (body_padding * 2);
      h = w/ratio;

      l = $window.width()/2 - w/2;
      t = $window.height()/2 - h/2;
    }
    
    console.log(img)
    console.log(ratio)
    $(img).css({ 'height': h, 'width': w, 'left': l, 'top': t })
    
  }
  
  function winWheel(e){
    
    if(!$('body').hasClass('slideshow')) return true;
    
    var timeNow = new Date().getTime();
    
        // change this to deltaX/deltaY depending on which
        // scrolling dir you want to capture
        deltaOfInterest = e.deltaY;
    
        if (deltaOfInterest == 0) {
            // Uncomment if you want to use deltaX
            // event.preventDefault();
            return;
        }
    
        //console.log(e.deltaY)
        
        // Cancel scroll if currently animating or within quiet period
        if(timeNow - lastAnimation < quietPeriod + animationTime) {
            //event.preventDefault();
            return;
        }
        
        if(Math.abs(e.deltaY) < 20) {
          return;
        }
        
        if (deltaOfInterest < 0) {
        
                lastAnimation = timeNow;
                nextImage();

            
        } else {
            
                lastAnimation = timeNow;
                prevImage();
        
            
        }

  }
  
  function enableArrows() {
    
    $(document).keydown(function(e) {
      switch (e.originalEvent.keyCode) {
        case 37:
          prevImage();
        break
        
        case 39:
          nextImage();
        break;
      }
    });
    
  }
  
  
  function prevImage(){
    currImage = currImage > 0 ? currImage - 1 : totalImages;
    console.log('prevImage ' + currImage);
    
    switchBlock();
  }
  
  function nextImage(){
    
    currImage = currImage < totalImages ? currImage + 1 : 0;
    console.log('nextImage ' + currImage);
    
    switchBlock();
  }
  
  function switchBlock(){
    
    $('.project-block.first').removeClass('first');
    $('.project-block.active').removeClass('active');
    $('.project-block').eq(currImage).addClass('active');
    
  }
  
  function winDown(e){
    console.log($(e.target))
    if ($(e.target).hasClass('ignore-slideshow')) return true;
    
    if (e.clientX < $window.width()/2) {
      prevImage();
      
    } else {
      nextImage();
      
    }
  }
  
  function winResize(){
    setupBackgrounds();
  }

	
}; 
  