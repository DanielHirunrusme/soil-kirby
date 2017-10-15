/**
*	@desc mousewheel the right container when over a fixed element
*/

var mousewheel = require('jquery-mousewheel')($),
	settings = require('modules/settings');


module.exports = function( el ) {
	
	var $el = $(el),
		$window = $(window),
    $scrollContainer = '#' + $el.data('scroll-container');
	
    if($window.width() > 900) {
      $window.off('mousewheel', winWheel).on('mousewheel', winWheel);
    } else {
      $window.off('mousewheel', winWheel);
    }
		
		$window.on('resize', winResize);
		
		function winWheel(e) {
			//console.log(e.deltaY)
    
			e.stopPropagation();
      
			if(e.clientX <= $el.position().left + $el.outerWidth() && e.clientX >= $el.position().left && !settings.isMobile) {
				e.preventDefault();
				
				$($scrollContainer).scrollTop( $($scrollContainer).scrollTop() - (e.deltaY) )
			}
		}
    
    function winResize(){
      if(settings.isMobile) {
        $window.off('mousewheel', winWheel);
      }
    }
	
		
}; 
  