/**
*	@desc module control for the homepage
*/

var slideshow = require("modules/slideshow");

module.exports = function( el ) {

	init();
  
	function init(){
    
    console.log('%c [homepage.init]', 'color:blue')
    
    if(!$('body').hasClass('writing')) {
      initFigures();
    
      slideshow.init();
      slideshow.setBlocks( $('figure').toArray() );
    
      $('.close').on('click', function(e){
        e.preventDefault();
        slideshow.hideSlideshow();
      })
    }
    

	}
  
  function initFigures(){
    
    var index = 0;
    
    var caption_html = '<div class="caption"><div class="caption-inner"><div class="text"><div class="caption-text"><div class="controls"><button class="ignore-slideshow prev">Prev</button>, <button class="ignore-slideshow next">Next</button></div><p><span class="caption-description" data-original=""></span></p></div></div></div></div>';
    
    $('figure').each(function(){
      
      $(this).attr('data-id', index);
      $(this).append(caption_html);
      
      $figCaption = $(this).find('figCaption');
      $(this).find('.caption-description').append($figCaption.text()).attr('data-original', $figCaption.text());
      $(this).find('img').wrap('<div class="block-holder"></div>');
      $figCaption.remove();
      
      index++;
      
    });
    
    $('figure').addClass('project-block').attr('data-fit-browser', '1').attr('data-ratio', '1');
    
    $('figure').first().addClass('first active');
    
    if (!$('html').hasClass('touch')) {
      $('figure').on('click', function(e){
        if (!$('body').hasClass('slideshow')){
          slideshow.setBlock( $(this).data('id') );
          slideshow.showSlideshow();
        }
      });
    }
    
    
  }

	
}; 
  