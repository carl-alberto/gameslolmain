
jQuery(document).ready(function($) {
		
	/*** EASY PAGINATE FOR FAQ PAGES **
		
	$('#easyPaginate').easyPaginate({
    paginateElement: '.divi',
    elementsPerPage: 5,
    effect: 'climb'
		}); */
		
	var term_video = $("#term_video");
	if( term_video.length !== 0 && navigator.userAgent.match(/Android/i))
	{
			$("#term_video").addClass("mobile");
			$("#term_video").find("#video_player").remove();
	}
		
	/*** FLOATING BUTTONS ***/
	var gamebutton = $("#gamebutton");
    var content = $("#gamebanner");
	
	if( gamebutton.length !== 0 && content.length !== 0) {
			
		var cpos = content.position();
			
		$(window).scroll(function() {
			
			var windowpos = $(document).scrollTop();
			if (windowpos >= (cpos.top + 150)) {
				gamebutton.addClass("stick");
			} else {
				gamebutton.removeClass("stick");
			}
			
		});
	}
	
	/*** SEARCH TWEAKS ***/
	$( ".mega-search" ).submit(function( event ) {
		var url = "https://games.lol/search/";
		var query = $(this).find("input[name=s]").val();
		window.location.href = url+query;
		event.preventDefault();
	});
	
	/*** BROWSER DETECT ***/
		var BrowserDetect = {
			init: function () {
				this.browser = this.searchString(this.dataBrowser) || "Other";
				this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
			},
			searchString: function (data) {
				for (var i = 0; i < data.length; i++) {
					var dataString = data[i].string;
					this.versionSearchString = data[i].subString;

					if (dataString.indexOf(data[i].subString) !== -1) {
						return data[i].identity;
					}
				}
			},
			searchVersion: function (dataString) {
				var index = dataString.indexOf(this.versionSearchString);
				if (index === -1) {
					return;
				}

				var rv = dataString.indexOf("rv:");
				if (this.versionSearchString === "Trident" && rv !== -1) {
					return parseFloat(dataString.substring(rv + 3));
				} else {
					return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
				}
			},

			dataBrowser: [
				{string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
				{string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
				{string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
				{string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
				{string: navigator.userAgent, subString: "Opera", identity: "Opera"},  
				{string: navigator.userAgent, subString: "OPR", identity: "Opera"},  
				{string: navigator.userAgent, subString: "Chrome", identity: "Chrome"}, 
				{string: navigator.userAgent, subString: "Safari", identity: "Safari"}, 
				{string: navigator.userAgent, subString: "YaBrowser", identity: "YaBrowser"}       
			]
		};
    	BrowserDetect.init();
	
	/*** LIGHTBOX BROWSER DETECTION ***/
	if( $("#gameLightbox").length !== 0) {
		
		var arrow = $("#gameLightbox").find("#gameArrow");
		var replaceText = 'Run the game installer';
		
		switch(BrowserDetect.browser){
			case 'Chrome':
				var str = navigator.userAgent;
				if( str.match(/CrOS/i) ){
					arrow.addClass("chrome_os");
				} else {
					arrow.addClass("chrome");
				}
				break;
			case 'Firefox':
				arrow.addClass("firefox");
				replaceText = 'Click Save and Install Game';
				break;
			case 'Explorer':
			case 'MS Edge':
				arrow.addClass("edge");
				replaceText = 'Click Run to Start Game';
				break;
			case 'Safari':
				arrow.addClass("safari");
				replaceText = 'Start Game in Downloads';
				break;
			case 'Opera':
				arrow.addClass("opera");
				replaceText = 'Click Save and Install Game';
				break;
			case 'YaBrowser':
				arrow.addClass("yabrowser");
				break;
			default:			
				arrow.addClass("chrome");
		}
		
	}
	
	/*** LIGHTBOX DISPLAY TOGGLE ***/
	$("#gameLightbox").on('click', function() {
		$("#gameLightbox").fadeOut();
	});
	
	/*** TOPNAV BOOTSTRAP DROPDOWN-ON-HOVER TWEAK ***/
	$(".nav-link.dropdown-toggle").hover( function () {
		// Open up the dropdown
		$(this).removeAttr('data-toggle'); // remove the data-toggle attribute so we can click and follow link
		$(this).parent().addClass('show'); // add the class show to the li parent
		$(this).next().addClass('show'); // add the class show to the dropdown div sibling
	}, function () {
		// on mouseout check to see if hovering over the dropdown or the link still
		var isDropdownHovered = $(this).next().filter(":hover").length; // check the dropdown for hover - returns true of false
		var isThisHovered = $(this).filter(":hover").length;  // check the top level item for hover
		if(isDropdownHovered || isThisHovered) {
			// still hovering over the link or the dropdown
		} else {
			// no longer hovering over either - lets remove the 'show' classes
			$(this).attr('data-toggle', 'dropdown'); // put back the data-toggle attr
			$(this).parent().removeClass('show');
			$(this).next().removeClass('show');
		}
	});
	// Check the dropdown on hover
	$(".dropdown-menu").hover( function () {
	}, function() {
		var isDropdownHovered = $(this).prev().filter(":hover").length; // check the dropdown for hover - returns true of false
		var isThisHovered= $(this).filter(":hover").length;  // check the top level item for hover
		if(isDropdownHovered || isThisHovered) {
			// do nothing - hovering over the dropdown of the top level link
		} else {
			// get rid of the classes showing it
			$(this).parent().removeClass('show');
			$(this).removeClass('show');
		}
	});
	
	$(".nav-search").click(function() {
    var selector = $(this).data("target");
    $(selector).toggleClass('in');
	});

	// SLICK
	
		$('.carousel').each( function() {
			
			var columnTotal = $(this).attr("data-column-total");
				
				// if (isEmpty($('.gamepreviews .video'))){
				// 	var countScreenshot = 2;
				// }

				$(this).slick({
					dots: false,
					infinite: true,
					arrows: false,
					autoplay: false,
					speed: 300,
					slidesToShow: columnTotal,
					responsive: [
						{
						  breakpoint: 480,
						  settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						  }
						}
					]
			
				});
		});
	
		$('div[data-carousel].prevArrow').click(function(e){
		e.preventDefault();
		var carName = $(this).data('carousel');
		$('.'+carName+'.carousel').slick("slickPrev");
		});
		$('div[data-carousel].nextArrow').click(function(e){
		e.preventDefault();
		var carName = $(this).data('carousel');
		$('.'+carName+'.carousel').slick("slickNext");
		});

		$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		  event.preventDefault();
		  $(this).ekkoLightbox();
		});

});