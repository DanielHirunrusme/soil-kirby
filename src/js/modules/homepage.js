/**
*	@desc module control for the homepage
*/

var slideshow = require("modules/slideshow");

module.exports = function( el ) {

	init();
  
	function init(){
    
    console.log('%c [homepage.init]', 'color:blue')
    
    slideshow.init();
    slideshow.setBlocks( $('.project-block').toArray() );
    
    if ( !$('html').hasClass('touch') ) {
      slideshow.showSlideshow();
    }
    

	}

	
}; 
  