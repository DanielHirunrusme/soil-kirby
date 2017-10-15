var shop = module.exports = {
 	   
	$window: $(window),
	
	init: function (){
    console.log('shop init')
		shop.attachItemEvents();
		shop.preloadImages();
	},
	
	preloadImages: function(){
		var preload = [];
		for(var i=0; i<$('.grid__item-image').length; i++) {
			preload.push($('.grid__item-image').eq(i).attr('src'));
		}
		
		//console.log(preload)
		
		var promises = [];
		for (var i = 0; i < preload.length; i++) {
		    (function(url, promise) {
		        var img = new Image();
				img.id = i;
		          img.onload = function() {
		          promise.resolve();
				      $('.grid__item-image').eq(img.id).closest('.grid__item').addClass('loaded')
		        };
		        img.src = url;
		    })(preload[i], promises[i] = $.Deferred());
		}
		$.when.apply($, promises).done(function() {
		  //alert("All images ready sir!");
		});
	},
	
	attachItemEvents: function(){
		$('.grid__item-image').on('mouseover', shop.gridItemOver).on('mouseout', shop.gridItemOut).on('click', shop.gridItemClick);
	},
	
	gridItemOver:function(e) {
		//$('.grid__item').addClass('disabled');
		$(e.currentTarget).closest('.grid__item').removeClass('disabled');
	},
  
  reset:function(){
    $('.grid__item.clicked').removeClass('clicked');
  },
	
	gridItemOut: function(e) {
		$('.grid__item').removeClass('disabled');
	},
	
	gridItemClick: function(e) {
    console.log('clicked')
		$(e.currentTarget).closest('.grid__item').addClass('clicked');
    $('.main__logo-link').removeClass('clicked over');
		$('body').addClass('grid-item-clicked');
	}
		
};
  