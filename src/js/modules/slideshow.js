var settings = require( "modules/settings" ),
throttle = require('modules/throttle'),
ellipsis = require('ellipsis.js'),
slick = require('slick-carousel'),
mousewheel = require("jquery-mousewheel");



var slideshow = module.exports = {

  blocks: [],
  currBlock: 0,
  totalBlocks: 0,
  $window: $(window),
  body_padding: $('.dummy-box').height(),
  deltas: [null, null, null, null, null, null, null, null, null],
  lock: 0,
  isSlick: false,
  slickSlider: null,
  timerInt: null,
  timerTimeout: null,


  init: function(){
	  console.log('%c [slideshow.init]', 'color:blue')
  },
  
  setBlocks: function(imgArr){
    slideshow.blocks = imgArr;
    slideshow.totalBlocks = slideshow.blocks.length - 1;
    //hide controls if only 1 block on the page
    if(slideshow.totalBlocks == 0)$('.controls').addClass('single');
    
    if ( $('html').hasClass('touch') && !$('body').hasClass('default') ) {
      $('body').addClass('slick-slideshow');
      slideshow.initSlick();
    }
    
  },
  
  showSlideshow: function(){
    $('body').addClass('slideshow');
    $('body').removeClass('overview');
    
    $('.overview-btn').removeClass('active');
    $('.images-btn').addClass('active');
    
    $('.project-images .container').removeClass('fixed top').css('width', '');
    
    
    
    slideshow.setBackgrounds();
    
    if(!$('body').hasClass('single-slideshow')) {
      if(!$(slideshow.blocks[slideshow.currBlock]).hasClass('video-block')) {
        slideshow.initTimer();
      }
      slideshow.setCaptions();
      slideshow.initControls();
    } else {
      slideshow.initMobileVideo();
    }
    
    
    if(slideshow.isSlick) {
      $('.project-images .inner').slick('setPosition');
    }
    
    //$('.block-holder').addClass('loaded');
    
    
    $(window).on('resize', throttle(slideshow.winResize, 300));
    
  },
  
  initTimer: function(){
    clearInterval(slideshow.timerInt);
    slideshow.timerInt = setInterval(slideshow.nextBlock, 4000);
  },
  
  pauseTimer: function(){
    console.log('pauseTimer');
    clearInterval(slideshow.timerInt);
    clearTimeout(slideshow.timerTimeout);
    slideshow.timerTimeout = setTimeout(slideshow.initTimer, 8000);
  },
  
  clearTimer: function(){
    console.log('clearTimer');
    clearInterval(slideshow.timerInt);
    clearTimeout(slideshow.timerTimeout);
  },
  
  initMobileVideo: function(){
    
  },
  
  showMobileSlideshow: function(){
    //slideshow.setCaptions();
    //slideshow.setBackgrounds();
    //slideshow.initControls();
    slideshow.hideSlideshow();
    //$('.project-images .inner').slick('setPosition');
  },
  
  initSlick: function(){
    console.log('%c [initSlick]', 'color:blue');
    
    $('.block-holder').each(function(){
      var bg;
      if ($(this).find('video').length > 0) {
        bg = $(this).find('.video-positioner').data('poster');
      } else {
        bg = $(this).find('img').attr('src');
      }

      $(this).css('background-image', 'url('+ bg +')')
    });
    
    slideshow.isSlick = true;
    
    if (!$('body').hasClass('overview')) {
      slideshow.switchTextColor();
    }
    
    $('.project-images .inner').slick({
      dots: false,
      arrows: true,
      speed: 500,
      adaptiveHeight: false,
      infinite: false,
      mobileFirst: true
    }).on('beforeChange', function(event, slick, currentSlide, nextSlide){
      slideshow.currBlock = nextSlide;
      if (!$('body').hasClass('overview')) {
        slideshow.switchTextColor();
      }
      
    });
    
    slideshow.setCaptions();
    
    
  },
  
  hideSlideshow: function(){
    if (!$('body').hasClass('single-slideshow')) {
      $('body').removeClass('slideshow black-text white-text');
      $('body').addClass('overview');
      $('.overview-btn').addClass('active');
      $('.images-btn').removeClass('active');
    
      slideshow.unsetBackgrounds();
      slideshow.destroyControls();
      slideshow.unsetCaptions();
      
      $('.video-block').each(function(){
        var vidID = $(this).find('video').attr('id');
        var player = videojs(vidID);
        player.currentTime(0);
        player.play();
      });
    
      if(slideshow.isSlick) {
        $('.project-images .inner').slick('setPosition');
      }
    
      $(window).off('resize', slideshow.winResize);
    }
    
  },
  
  initControls: function(){
    console.log('init controls')
    $('.controls .prev').on('click', slideshow.prevClick);
    $('.controls .next').on('click', slideshow.nextClick);
    
    slideshow.initArrows();
    
    //
    $(window).on('mousedown', slideshow.winDown);
    $(window).on('mousewheel', slideshow.winWheel);
  },
  
  destroyControls: function(){
    $('.controls .prev').off('click');
    $('.controls .next').off('click');
    
    $(window).off('mousedown', slideshow.winDown);
    $(window).off('mousewheel', slideshow.winWheel);
  },
  
  initArrows: function(){
    $(document).keydown(function(e) {
      if($('body').hasClass('slideshow'))
        switch (e.originalEvent.keyCode) {
          case 37:
            slideshow.prevBlock();
          break
        
          case 39:
            slideshow.nextBlock();
          break;
        }
    });
  },
  
  closeClick: function(){
    
  },
  
  prevClick: function(){
    //slideshow.pauseTimer();
    slideshow.prevBlock();
  },
  
  nextClick: function(){
    //slideshow.pauseTimer();
    slideshow.nextBlock();
  },
  
  prevBlock: function(){
    console.log('prev block')
    slideshow.currBlock = slideshow.currBlock > 0 ? slideshow.currBlock-1 : slideshow.totalBlocks;
    slideshow.switchBlock();
  },
  
  nextBlock: function(){
    console.log('next block');
    slideshow.currBlock = slideshow.currBlock < slideshow.totalBlocks ? slideshow.currBlock+1 : 0;
    slideshow.switchBlock();
  },
  
  switchBlock: function(){
    console.log('switch block')
    $(slideshow.blocks).removeClass('active first');
    $(slideshow.blocks[slideshow.currBlock]).addClass('active');
    
    slideshow.switchTextColor();
    
    $('.video-block').each(function(){
      var vidID = $(this).find('video').attr('id');
      var player = videojs(vidID);
      player.currentTime(0);
      player.pause();
    });
    
    if($(slideshow.blocks[slideshow.currBlock]).hasClass('video-block')) {
      //$(slideshow.blocks[slideshow.currBlock]).find('video').currentTime = 0;
      //console.log($(slideshow.blocks[slideshow.currBlock]).find('video').attr('id'))
      var vidID = $(slideshow.blocks[slideshow.currBlock]).find('video').attr('id');
      
      var player = videojs(vidID);
      player.currentTime(0.1);
      player.play();
      console.log(player);
      
      slideshow.clearTimer();
    }
    
    if(!$(slideshow.blocks[slideshow.currBlock]).hasClass('video-block')) {
      slideshow.initTimer();
    }
  },
  
  switchTextColor: function(){
    color = $(slideshow.blocks[slideshow.currBlock]).data('text-color');
    $('body').removeClass('black-text white-text').addClass(color + '-text');
  },
  
  setBlock: function(num) {
    
    slideshow.currBlock = num;
    slideshow.switchBlock();
    
    
  },
  
  setBackgrounds: function(){
    $(slideshow.blocks).each(function(){
        
      var fit = $(this).data('fit-browser');
      if(fit == '0'){
        
        if ($(this).find('.video-positioner').length > 0) {
          slideshow.fitImage($(this).find('.video-positioner'), $(this).find('.video-positioner').data('ratio'));
        } else {
          slideshow.fitImage($(this).find('img'), $(this).data('ratio'));
        }
        
        
        
      } else {
        if ($(this).find('.video-positioner').length > 0) {
          slideshow.fullBleed($(this).find('.video-positioner'), $(this).find('.video-positioner').data('ratio'));
        } else {
          slideshow.fullBleed($(this).find('img'), $(this).data('ratio'));
        }
      }
        
    });
    
  },
  
  fullBleed: function(img, ratio){
    
    console.log('full bleed')
    
    var h = $(window).height();
    var w = h * ratio;
    var l = $(window).width()/2 - w/2;
    var t = $(window).height()/2 - h/2;
    
    if (w < $(window).width()){
      
      console.log('make bigger')
      w = $(window).width();
      h = w/ratio;
      l = $(window).width()/2 - w/2;
      t = $(window).height()/2 - h/2;
      
    }
    
    $(img).css({ 'height': h, 'width': w, 'left': l, 'top': t })
    
  },
  
  fitImage: function(img, ratio){
    
    var ho = $('.main-nav').height() * 3.5;
    
    //if caption exists get the height
    var caption_height = $('.caption-text').length > 0 ? $('.caption-text').height() : $('.main-nav').height();
    
    if (caption_height/2 >= $('.main-nav').height())
      ho = $('.main-nav').height() * 2 + caption_height;
    
    
    
    var h = $(window).height() - (ho*2);
    var w = h * ratio;
    var l = $(window).width()/2 - w/2;
    var t = $(window).height()/2 - h/2 - ( caption_height - $('.main-nav').height() )/2;
    
    
    
    //image width is larger than browser width
    if (w > $(window).width() ) {
      
      w = $(window).width() - (slideshow.body_padding * 2);
      h = w/ratio;

      l = $(window).width()/2 - w/2;
      t = $(window).height()/2 - h/2;
    }
    
    $(img).css({ 'height': h, 'width': w, 'left': l, 'top': t })
    
  },
  
  unsetBackgrounds: function(){
    $(slideshow.blocks).each(function(){
        
        $(this).find('img').css({ 'height': '', 'width': '', 'left': '', 'top': '' })
        $(this).find('.video-positioner').css({ 'height': '', 'width': '', 'left': '', 'top': '' })
        
    });
    
  },
  
  setCaptions: function(){
    var ellipsis = Ellipsis({
      ellipsis: '[…]', //default ellipsis value
      debounce: 0, //if you want to chill out your memory usage on resizing
      responsive: false, //if you want the ellipsis to move with the window resizing
      class: '.caption-description', //default class to apply the ellipsis
      lines: 2, //default number of lines when the ellipsis will appear
      portrait: null, //default no change, put a number of lines if you want a different number of lines in portrait mode,
      break_word: false //default the ellipsis can truncate words
    });
    
    $('.caption-description').each(function(){
      $(this).attr('data-ellipsis', $(this).text())
    })
    
    $('.caption-text p').on('mouseover click', function(e){
      e.stopPropagation();
      $(this).find('.caption-description').text( $(this).find('.caption-description').data('original') )
    }).on('mouseout', function(){
      var ellipsis = Ellipsis({
        ellipsis: '[…]', //default ellipsis value
        debounce: 0, //if you want to chill out your memory usage on resizing
        responsive: false, //if you want the ellipsis to move with the window resizing
        class: '.caption-description', //default class to apply the ellipsis
        lines: 2, //default number of lines when the ellipsis will appear
        portrait: null, //default no change, put a number of lines if you want a different number of lines in portrait mode,
        break_word: false //default the ellipsis can truncate words
      });
    })
    
  },
  
  unsetCaptions: function(){
    $('.caption-text p').off('mouseover mouseout');
    $('.caption-text p').each(function(){
       $(this).find('.caption-description').text( $(this).find('.caption-description').data('original') )
    });
  },
  
  winDown: function(e){

    if ($(e.target).hasClass('ignore-slideshow')) return true;
    
    if (e.clientX < $(window).width()/2) {
      slideshow.pauseTimer();
      slideshow.prevBlock();
      
    } else {
      slideshow.pauseTimer();
      slideshow.nextBlock();
      
    }
  },
  
  winResize: function(){
    if ($('body').hasClass('slideshow')) {
      slideshow.setBackgrounds();
      slideshow.setCaptions();
    } else {
      slideshow.unsetCaptions();
    }
      
  },
  
  winWheel: function(e){
    //console.log(e)
  	e.preventDefault()
  	var delta = 0;
	
  	if (e.type == 'mousewheel'){
  	  delta = e.originalEvent.wheelDeltaY * -1
  	} else {
  	  delta = 40 * e.originalEvent.detail
  	}
  
  	//console.log('delta ' + delta)
	
  	if (slideshow.hasPeak()) {
      slideshow.lock = 10;
      slideshow.fire(e)
  	} else if ((slideshow.deltas[8] == null || slideshow.deltas[8] == 120) && Math.abs(slideshow.delta) == 120) {
  	  slideshow.fire(e)
  	}
  
  	slideshow.deltas.shift()
  	slideshow.deltas.push(Math.abs(delta))
  },
  
  fire: function(e){
    if (e.deltaY < 0)
      slideshow.nextBlock();
    else
      slideshow.prevBlock();
  },
  
  hasPeak: function(){

  	if (slideshow.lock > 0) {
  	  slideshow.lock-=.38;
      return false;
  	}
    
    if (slideshow.deltas[0] == null) {
      return false
    }
  		
  	if (slideshow.deltas[0] <  slideshow.deltas[4] && slideshow.deltas[1] <= slideshow.deltas[4] && slideshow.deltas[2] <= slideshow.deltas[4] && slideshow.deltas[3] <= slideshow.deltas[4] && slideshow.deltas[5] <= slideshow.deltas[4] && slideshow.deltas[6] <= slideshow.deltas[4] && slideshow.deltas[7] <= slideshow.deltas[4] && slideshow.deltas[8] <  slideshow.deltas[4]
  	)  {
  	  return slideshow.hasPeak;
  	}
  		
  	return false;
  }
  
  

	
};
