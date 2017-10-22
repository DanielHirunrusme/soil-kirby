/**
*	@desc module control for Newsletter
*/

module.exports = function( el ) {
	
	var $el = $(el),
		$window = $(window),
  $newsletterBtn = $el.find('.show-newsletter-form');
    
	init();
  
	function init(){
    
    console.log('%c [newsletter.init]', 'color:blue')
    
    $newsletterBtn.on('click', toggleNewsletter);
	}
  
  function toggleNewsletter(){
    $el.find('form').toggleClass('show');
  }

	
}; 
  