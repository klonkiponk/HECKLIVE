$(document).ready(function() {
	$(".swiper").swipe({
		swipe:function(event, direction, distance, duration, fingerCount) {
	        slideInMenu();
		},
		 threshold:50
	});    
});

document.body.addEventListener('touchmove',function(event){
  event.preventDefault();
});