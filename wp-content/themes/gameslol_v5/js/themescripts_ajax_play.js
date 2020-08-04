
jQuery(document).ready(function($) {
		
		
			var thePage = $(".playpage").first();
			var thePlayer = $('#game_player');
			
			$(document).on('click','.goPlay',function (e) {
				
			  var postid = thePage.data('postid');
			  var playerlink = thePage.data('playerlink');

			  if( thePlayer.length !== 0 ) {
				  
				  var theButton = $(this);

				  $.ajax({
					url : wp_ajax.ajax_url,
					type : 'get',
					data : {
					action : 'download_go',
					thepost : postid,
				  },
					success : function( response ) {	
						
						// - Send Event to Google Analytics:
						var gaCat = theButton.data('ga-category'); 	// - Game or Article
						var gaAction = theButton.data('ga-action');	// - [Button]-Play
						var gaLabel = thePage.data('gametitle');	// - Game Title

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
						
						// - Show Player
						console.log('Going to Player Page: ' + playerlink );
						thePlayer.modal('show');
				  }

				});
			  }
		  	});
	
});