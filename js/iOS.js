$(document).ready(function() {
	$(".swiper").swipe({
		swipe:function(event, direction, distance, duration, fingerCount) {
	        slideInMenu();
		},
		 threshold:50
	});    
});