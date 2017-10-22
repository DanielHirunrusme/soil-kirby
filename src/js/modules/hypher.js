/**
*	@desc module control for hyphenation
*/

module.exports = function( el ) {
  
  var $el = $(el);
  
	init();
  
	function init(){
    
    console.log('%c [hypher.init]', 'color:blue')
    
    $('p, h1').hyphenate();
    

    //$('p').hyphenate();

	}


	
}; 
  