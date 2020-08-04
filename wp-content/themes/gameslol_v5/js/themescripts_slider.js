jQuery(document).ready(function($) {
	
  setTimeout(
  function(){
    
    console.log('slick intialize');
    // SLICK SLIDER
	
	$('.slick-carousel').slick({
		  dots: false,
		  arrows: false,
		  autoplay: false,
		  infinite: false,
		  variableWidth: true,
		  centerMode: false,
		  easing: 'linear',
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  lazyLoad: 'ondemand',
	});
	
	
	$('.slick-carousel').on('afterChange', function(event, slick, currentSlide){
		if(currentSlide === (slick.slideCount - 1)){
			$(this).siblings('.nextArrow').addClass('end');
		}
	});
	

	$('.screenshots .prevArrow').on('click', function(e) {
		$(this).siblings('.slick-carousel').slick('slickPrev');
	});
	
	$('.screenshots .nextArrow').on('click', function(e) {
		if($(this).hasClass('end')){
			$(this).siblings('.slick-carousel').slick('slickGoTo', 0);
			$(this).removeClass('end');
		} else {
			$(this).siblings('.slick-carousel').slick('slickNext');
		}
	});
    
      }, 3000);
	
});