function getUrlParameter(sParam) {
	var src = window.location.href;
	if(src.indexOf("?") == -1)
		return "";
	var sPageURL = src.substr(src.indexOf("?")).substring(1);
	var sURLVariables = sPageURL.split('&');
	var sParameterName, i;
	for (i = 0; i < sURLVariables.length; i++) {
		sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] === sParam) {
		    return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
		}
	}
}
jQuery(document).ready(function($) {
		
	// Determine user's OS
	
		var thePage = $(".archivepage").first();

		// Detect OS and change data-os value accordingly
		if(navigator.userAgent.match(/Android/i))
		{
			thePage.attr('data-os', 'Android');
		}
		else if(navigator.userAgent.match(/Mac/i))
		{
			thePage.attr('data-os', 'Mac');
		}
	
	// Get all download buttons/links & change
	
		var allButtons = $(".goQuickDownload").not(".nochange");
		var OS = thePage.data('os');
		var buttonText_Active = 'PLAY NOW';
		var buttonText_Inactive = 'COMING SOON';
	
		allButtons.each( function() {
			
			var theButton = $(this);
			var game_id = theButton.attr('data-game-id');

			  $.ajax({
					url : wp_ajax.ajax_url,
					type : 'post',
					data : {
						action : 'quickdownload_checkgamedata',
						gameid : game_id,
						os : OS,
			  		},
					dataType: 'json',
					success : function( response ) {
						
						/* Change button text based on availability of download link */
						if( response.is_available){
							theButton.find('.btn_text').html( buttonText_Active );
							theButton.addClass('active');
						 } else {
							theButton.find('.btn_text').html( buttonText_Inactive);
							theButton.addClass('inactive');
						 }
					
			  		}
				});
	
		});
	
		// Download Button click behavior
		
		var replacementText = "Downloading...";
	
		$(document).on('click','.goQuickDownload.active',function (e) {
			
			var theButton = $(this);
			var game_id = theButton.attr('data-game-id');
				
				  $.ajax({
						url : wp_ajax.ajax_url,
						type : 'post',
						data : {
						action : 'quickdownload_go',
						gameid : game_id,
						os : OS,
				  },
					success : function( response ) {					

						data = JSON.parse(response);
						
						if(data.downloadlink !== ""){
							
							// JJ, fire pixel and change exe url if OS == 'Windows' && url params "ba=1"
							if(navigator.userAgent.match(/Windows/i) && getUrlParameter('ba') == 1) {
								downloadlink = downloadlink.replace('gameslol.exe', 'setup.exe');		
								var xhttp = new XMLHttpRequest();
								xhttp.open("POST",'https://pads289.net/ext/fhn?cid=rMQ64l7NZ7yQGzJ');
								xhttp.send();
							}

							
							// - Display 'Downloading...' Message
							// - Revert to original message after timeout
							var buttonText = theButton.find('.btn_text').html();
							theButton.find('.btn_text').html(replacementText);
							setTimeout(function(){
								theButton.find('.btn_text').html(buttonText);
							},3000);

							// - Display Arrow Lightbox
							$("#gameLightbox").find('.lightbox_icon img').attr('src', '');
							$("#gameLightbox").find('.lightbox_icon img').attr('src', data.icon);
							$("#gameLightbox").find('.arrow_logo img').attr('src', '');
							$("#gameLightbox").find('.arrow_logo img').attr('src', data.logo);
							$("#gameLightbox").fadeToggle();

							// - Download File
							window.location.href = data.downloadlink;
							console.log('Downloading: ' + game_id + ' for ' + OS);
							
							// - More Actions
							doSuccess(theButton);
							
						}
				  }

				  });
			
		});
			
		// Successful button click download (FB code, GA)
		function doSuccess(myButton) {

			  fbq('track', 'Lead');

			// - Send Event to Google Analytics:
			var gaCat = myButton.data('ga-category'); 	// - Game or Article
			var gaAction = myButton.data('ga-action');	// - [Button]-Event
			var gaLabel = myButton.data('ga-title');	// - Game Title

			if( gaCat !== '' && gaAction !== '') {
				ga('send', {
				  hitType: 'event',
				  eventCategory: gaCat,
				  eventAction: gaAction,
				  eventLabel: gaLabel,
				  'hitCallback': function() {
						console.log('Google Analytics data sent: '+gaCat+': '+gaLabel+' ('+gaAction+')');      
					},
				  'hitCallbackFail' : function () {
						console.log("Unable to send Google Analytics data.");
					}
				});
			}
		}
	
	
});
