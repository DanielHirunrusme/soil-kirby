/**
*	@desc module control for Product Items
*/

module.exports = function( el ) {
	
	var $el = $(el),
  $window = $(window);
    
	init();
  
	function init(){
    if (!$('html').hasClass('touch'))
      $('*[data-blur="content"]').on('mouseover', blurContent).on('mouseout', notBlurContent);
	}
  
  function blurContent(){
    $('body').addClass('blur-content');
  }
  
  function notBlurContent(){
    $('body').removeClass('blur-content');
  }

	
}; 
  