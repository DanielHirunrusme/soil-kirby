/**
*	@desc module control for slideshows
*/

var settings = require("modules/settings"),
slideshow = require("modules/slideshow");

module.exports = function( el ) {
	
	var $el = $(el),
  $window = $(window),
  currImage = 0,
  totalImages = $('.block').length - 1,
  $video = $el.find('video'),
  vidID = $video.attr('id'),
  playing = false,
  looped = false;
  
  
	init();
  
  function init(){
    console.log('%c [video init]', 'color:blue')
    
    
    
    
    var hd_source = '';
    
    $el.find('source').each(function(){
      //console.log($(this).attr('data-src'))
      if($(this).attr('src').indexOf("hd.mp4") >= 0) {
        hd_source = $(this).attr('src');
      }
    });
    
    
    var _src = $video.find('source').attr('src');
    
    $el.find('video').attr('src', hd_source)
    
    
    //return true;
    
    var options = {};
    //videojs.options.autoplay = true;
    options.muted = true;
    options.autoplay = true;
    options.controls = false;
    options.hls = { withCredentials: true }
    
    $('.video-positioner').on('click', function(){
      console.log('mousedown')
    })
    
    $('.play-button').on('click mouseup touchdown', function(e){
      e.stopPropagation();
      console.log('play mobile video');
      player.play();
      player.requestFullscreen();
    });
    
    console.log('src ' + _src)
    console.log('vidID ' + vidID)
    
    var notEnded = true;
    
    
    
    var player = window.player = videojs(vidID, options);
    player.on('ready', function(){
      console.log('player ready');
      player.play();
      playing = true;
      
      /*
      player.on('timeupdate', function(e){
          var duration = player.duration();
          var currentTime = player.currentTime();
         
          if(currentTime < duration) {
            notEnded = true;
          } else {
            notEnded = false;
          }
          if(notEnded && duration>0 && (duration-player.currentTime()<0.15)) {
              //console.log('ended');
              player.trigger('ended');
              
          }
      });
      */
  
      /*
      this.on('timeupdate', function(){
        console.log('timeupdate')
      });
      */
    });
    
    player.on('pause', function(){
      if(!$('body').hasClass('slideshow'))
      player.play();
    });
    
    player.on('timeupdate', function(){
      var ct = player.currentTime();
      var dur = player.duration();
      
      //looped
      if (ct == 0) {
        if(!looped) {
          looped = true;
          player.trigger('ended');
        }
        
      }
    })
    
    player.on('ended', function(){
      if(looped) {
        console.log('player ended 1');
        //if in slideshow mode and this player is active, go to next block
        
        if ($('body').hasClass('slideshow') && $el.closest('.video-block').hasClass('active')) {
          slideshow.nextBlock();
        }
        
        setTimeout(function(){
          looped = false;
        }, 1000);
      }
      
    });
    
    
 

    return true;
    
    var player = videojs(vidID, options, function onPlayerReady() {
      //videojs.log('Your player is ready!');
      
      //player.controls = false;
      
      
      var _p = this;
      
      this.play();
      
      this.options.poster = $el.data('poster');
      
      if(!settings.isMobile) {
        //$el.find('video').attr('src', $el.find('source').eq(1).attr('data-src'))
      }
      
      /*
      var hd_source = '';
      
      $el.find('source').each(function(){
        //console.log($(this).attr('data-src'))
        if($(this).attr('data-src').indexOf("hd.mp4") >= 0) {
          hd_source = $(this).attr('data-src');
        }
      });
      
      $el.find('video').attr('src', hd_source)
      */
      
      
    
      
      /*
      *
        var hd_source = '';
        
        $el.find('source').each(function(){
          //console.log($(this).attr('data-src'))
          if($(this).attr('data-src').indexOf("hd.mp4") >= 0) {
            hd_source = $(this).attr('data-src');
          }
        });
        
        console.log(hd_source)
        
        $el.find('video').attr('src', hd_source)
      
      */
      
 
      // In this context, `this` is the player that was created by Video.js.
      //this.pause();
      
 
      // How about an event listener?
      this.on('ended', function() {
        videojs.log('Awww...over so soon?!');
      });
    });
    
    player.on('ready', function(){
      
      console.log('player ready');
      console.log(player.src())
    });
    
    player.on('ended', function(){
      console.log('player ended');
    });
  }
	
}; 
  