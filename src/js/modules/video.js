/**
*	@desc module control for slideshows
*/

var settings = require("modules/settings");

module.exports = function( el ) {
	
	var $el = $(el),
  $window = $(window),
  currImage = 0,
  totalImages = $('.block').length - 1,
  vidID = $el.attr('id');
  
	init();
  
  function init(){
    console.log('%c [video init]', 'color:blue')
    
    
    var hd_source = '';
    
    $el.find('source').each(function(){
      //console.log($(this).attr('data-src'))
      if($(this).attr('data-src').indexOf("hd.mp4") >= 0) {
        hd_source = $(this).attr('data-src');
      }
    });
    
    $el.find('video').attr('src', hd_source)
    
    return true;
    
    var options = {};
    videojs.options.autoplay = true;
    //options.muted = true;
    //options.autoplay = true;
    options.controls = true;
    
    $('.video-positioner').on('click', function(){
      console.log('mousedown')
    })
    
    $('.play-button').on('click mouseup touchdown', function(e){
      e.stopPropagation();
      console.log('play mobile video');
      player.play();
      player.requestFullscreen();
    });
    
    var player = videojs(vidID, options, function onPlayerReady() {
      videojs.log('Your player is ready!');
      
      //player.controls = false;
      
      var _p = this;
      
      
      
      this.options.poster = $el.data('poster');
      
      if(!settings.isMobile) {
        //$el.find('video').attr('src', $el.find('source').eq(1).attr('data-src'))
      }
      
      var hd_source = '';
      
      $el.find('source').each(function(){
        //console.log($(this).attr('data-src'))
        if($(this).attr('data-src').indexOf("hd.mp4") >= 0) {
          hd_source = $(this).attr('data-src');
        }
      });
      
      console.log(hd_source)
      
      $el.find('video').attr('src', hd_source)
      
      
      
    
      
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
      this.play();
 
      // How about an event listener?
      this.on('ended', function() {
        videojs.log('Awww...over so soon?!');
      });
    });
  }
	
}; 
  