$(document).ready(function() {
	
	var buttons = ['.btn-default', '.btn-main'];
	
	fade('.main');
	
	function fade(className) {
		
		$(className).hide();
		$(className).fadeIn(1000);
	}
	
	$(window).scroll(function() {	
	
		$('.hide-me').each(function(i) {
			
			var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            
            /* If the object is completely visible in the window, fade it */
            if( bottom_of_window > bottom_of_object ){
                
                $(this).animate({'opacity':'1'},2000);
                    
            }
		});
	});
	
	for (var i = 0; i < buttons.length; i++) {
		$(buttons[i]).mouseenter(function() {
			$(this).animate({backgroundColor: "#c7d6dd" }, 150);
		});
	
		$(buttons[i]).mouseleave(function() {
			$(this).animate({backgroundColor: "#fff" }, 150);
		});
	}
});