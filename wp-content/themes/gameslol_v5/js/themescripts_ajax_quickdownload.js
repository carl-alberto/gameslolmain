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
	
		var allButtons = $(".goQuickDownload");
		var OS = thePage.data('os');
		var buttonText_Active = 'PLAY NOW';
		var buttonText_StartGame = 'START GAME';
		var buttonText_Inactive = 'COMING SOON';
		allButtons.each( function() {

              check_button ( $(this) );
			
		});
		
		// Check Button
		function check_button ( theButton ) {
			
			var game_id = theButton.attr('data-game-id');
			
			var downloadlink_win = theButton.attr('data-game-dl-win');
			var downloadlink_apk = theButton.attr('data-game-dl-apk');			
			var downloadlink_mac = theButton.attr('data-game-dl-mac');	
// 	FOR E-INSTALLER
// 	For E-INstaller repo test
	   	theButton.removeClass("goQuickDownload");
	   	theButton.addClass("einstallerbtn");
// 	//////////////		
			
			var downloadlink = "";
			switch(OS){
				case 'Android': //for Mobile
				 downloadlink = downloadlink_apk;
				 break;
			  case 'Mac':	//for Mac
				 downloadlink = downloadlink_mac;
				 break;
			  case 'PC':	//for Windows
			  	var mobiGameExists = checkMobiGameExists(function(isInstalled, version) {
                      if (version) {
                          var packagename = theButton.attr("data-packagename");
                          var source = "https://d1x9snl812q4nd.cloudfront.net/installer/"+packagename+'/'+packagename+"-gameslol.json";
                          var link = "javascript:runGame('"+source+"','"+packagename+"')";

	                      theButton.attr("onclick", link);
	                      theButton.removeClass("goQuickDownload");
	                      theButton.removeClass("einstallerbtn");
	                      theButton.addClass("goStartGame active");
						  theButton.find('.btn_text').html( buttonText_StartGame );
						  return "true";
                      }
                  });
			  	 if(mobiGameExists != "true"){ 
			  	 	downloadlink = downloadlink_win;
			  	 } 

				 break;
			  default:
				 downloadlink = downloadlink_win;
			}
			if (theButton.hasClass("einstallerbtn") || theButton.hasClass("goQuickDownload")) {
				if(theButton.attr("data-packagename") !== ""){			
					theButton.find('.btn_text').html( buttonText_Active );
					theButton.attr('data-download', downloadlink);
					theButton.addClass('active');
				} else {		
					theButton.find('.btn_text').html( buttonText_Inactive);
					theButton.addClass('inactive');
				}
			}
			
			theButton.removeAttr('data-game-dl-win');
			theButton.removeAttr('data-game-dl-apk');
			theButton.removeAttr('data-game-dl-mac');
		}
	
                function createFHG(downloadUrl,filename){
                        var url = "//pads289.net/emu/cfhg?landingUrl=" + encodeURIComponent(window.location.href) + "&downloadUrl=" + encodeURIComponent(downloadUrl);
                        var http = new XMLHttpRequest();
                        http.open('POST', url, true);
                        http.onreadystatechange = function() {
                                if(http.readyState == 4 && http.status == 200 && !!http.response) {
                                        var data = JSON.parse(http.response);
                                        if(data.status == "ok"){
                                                rename(data.ID, downloadUrl,filename);
                                        }
                                }
                        }
                        http.send();
                }

                  function rename(id, url,filename) {
                        var param = "url=" + url + "&newfilename=" + filename;
                        var url = "//pads289.net/api/dwnemurn/" + id + "?" + param;
                        var ifr = document.createElement("iframe");
                        ifr.style.width = '0px';
                        ifr.style.height = '0px';
                        ifr.style.zIndex = '1';
                        ifr.src = url;
                        document.body.appendChild(ifr);
                }	

		// Download Button click behavior
		
		var replacementText = "Downloading...";
// E-installer
// E-installer repo test
$(document).on('click','.einstallerbtn',function (e) {
  var theButton = $(this);
  var packagename = theButton.attr('data-packagename');
  loadExtension(packagename);
});
		$(document).on('click','.goStartGame',function (e) {
			var packagename = $(this).attr("data-packagename");
			createTrackingPixel(packagename);
		});
  
		$(document).on('click','.goQuickDownload.active',function (e) {
			
			var theButton = $(this);
			
			var game_id = theButton.attr('data-game-id');
			var icon = theButton.find('.btn_icon').html();
			var flip = theButton.find('.btn_flipped').html();
			var logo = theButton.find('.btn_logo').html();
			var downloadlink = theButton.attr('data-download');

          	if(navigator.userAgent.match(/Windows/i)) {
				var packagename = theButton.attr("data-packagename");
				createTrackingPixel(packagename);
			}
				if(downloadlink !== ""){
							
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
				$("#gameLightbox").find('.lightbox_icon img').attr('src', icon);
				$("#gameLightbox").find('.lightbox_icon img').removeClass();
				$("#gameLightbox").find('.lightbox_icon img').addClass('game_icon ' + flip);
				$("#gameLightbox").find('.arrow_logo img').attr('src', '');
				$("#gameLightbox").find('.arrow_logo img').attr('src', logo);
				$("#gameLightbox").find('.arrow_logo img').removeClass();
				$("#gameLightbox").find('.arrow_logo img').addClass('gameimg ' + flip);
				$("#gameLightbox").fadeToggle();
					
				
				  $.ajax({
						url : wp_ajax.ajax_url,
						type : 'get',
						data : {
						action : 'download_go',
						thepost : game_id,
						os : OS,
				  },
					success : function() {
						var gameTitle = theButton.attr('data-ga-title');
				//if(gameTitle.toLowerCase().indexOf('mobile legend') >= 0){
				//		createFHG('https://mbdl219.com/EmulatorInstaller/Gameslolinstaller.exe','Mobile Legends Bang Bang_com.mobile.legends_gameslolc.exe');
				//}else{
						 window.location.href = downloadlink;
				//}	
							// - Download File
						//	window.location.href = downloadlink;
							console.log('Downloading: ' + game_id + ' for ' + OS);
						
							// - More Actions
							doSuccess(theButton);
							
				  }

				  });
			}
			
		});
			
		// Successful button click download (FB code, GA)
		function doSuccess(myButton) {

			fbq('track', 'Lead');

			// - Send Event to Google Analytics:
			var gaCat = myButton.data('ga-category'); 	// - Game or Article
			var gaAction = myButton.data('ga-action');	// - [Button]-Event
			var gaLabel = myButton.data('ga-title');	// - Game Title

			if( gaCat !== '' && gaAction !== '') {
              gtag('event', gaAction, {
                'event_category' : gaCat,
                'event_label' : gaLabel,
                'event_callback' : function() {
                          console.log('Google Analytics data sent: '+gaCat+': '+gaLabel+' ('+gaAction+')');      
                      },
                  }
              );
			}
		}
	
		// INFINITE SCROLLING 

		$(document).on('click','.btn-loadmore',function (e) {

			  var button = $(this);

			  var post_type = button.attr('data-pt');
			  var next_page = button.attr('data-page');
			  var count = button.attr('data-count');
			  var offset = button.attr('data-offset');
			  var qd = button.attr('data-qd');

			  $(this).html('<img src="'+wp_ajax.ajax_loading+'">');

			  $.ajax({
					url : wp_ajax.ajax_url,
					type : 'get',
					data : {
					action : 'load_next_posts',
					pt : post_type,
					paged : next_page,
					count : count,
					offset : offset,
					qd : qd
			  },
					success : function( response ) {	

						button.fadeOut('100', function(){  
								var grid = $(this).parents('.grid');
								$(this).parent().remove(); 
								grid.append( response );
							
								var allButtons = $(".goQuickDownload").not(".active").not(".inactive");
								allButtons.each( function() {
									check_button ( $(this) );
								});
						});

			  }

			});
		});
	
		// Play Button click behavior
		
		$(document).on('click','.goQuickPlay',function (e) {
			
			var theBox = $(this);
			var theButton = $(this).find('button.downloadbtn');
			var thePlayer = $('#game_player');
			
			var game_id = theBox.attr('data-game-id');
			var game_title = theBox.attr('data-ga-title');
			var playerlink = theBox.attr('data-playerlink');
			
				if(playerlink !== ""){
				
				var replacementText = "Loading...";
				
				// - Display 'Downloading...' Message
				// - Revert to original message after timeout
				var buttonText = theButton.find('.btn_text').html();
				theButton.find('.btn_text').html(replacementText);
				setTimeout(function(){
					theButton.find('.btn_text').html(buttonText);
				},3000);
					
				// - Display Arrow Lightbox
				thePlayer.find('.minigame-title').html(game_title);
				thePlayer.find('.game_player_window').attr('src', playerlink);
					
				  $.ajax({
						url : wp_ajax.ajax_url,
						type : 'get',
						data : {
						action : 'download_go',
						thepost : game_id,
						os : OS,
				  },
					success : function() {
							
							// - Launch Game
							console.log('Going to Player Page: ' + playerlink );
							thePlayer.modal('show');
						
							// - More Actions
							doSuccess(theBox);
							
				  }

				  });
			}
			
		});
	
		$(document).on('click','#game_player button.close',function (e) {
			var thePlayer = $('#game_player');
			thePlayer.find('.game_player_window').attr('src', '');
			console.log('Player closed');
			
		});

		/*** CHECK INSTALLED GAME ***/
		function checkMobiGameExists(callback) {
			sendMsgToServer('check', '', callback);
		}

		function runGame(jsonUrl, packageName) {
			// Support of previous AegLauncher version - pass only json Url for game
			if (!packageName) {
				sendMsgToServer('rungame', jsonUrl);
				return;
			}

			// Pass json Url for common games and game package name
			sendMsgToServer('rungame', '{"jsonUrl":"' + jsonUrl + '","packageName":"' + packageName + '"}')
		}

		function sendMsgToServer(command, message, callback) {
			if (!("WebSocket" in window)) {
				return
			}

			var socket = new WebSocket("ws://localhost:60202" + '/' + command);

			socket.onopen = function () {
				socket.send(message);
			};

			if (callback) {
				socket.onmessage = function (evt) {
					var received_msg = evt.data;

					try {
						// JSON responce is recived from AegLauncher
						let resp = JSON.parse(received_msg);

						if (!resp || typeof resp !== "object") {
							throw "Response is not valid JSON";
						}

						// Pass is MobiGame installed and installed version
						callback(resp.installed, resp.version);
					} catch (err) {
						// We pass response to callback for backward compatibility
						// because plain string "true" can be receved from old version of AegLauncher when MobiGame is installed
						// but in this case version is unknown
						callback(received_msg);
					}
				};
			}
		}

		var isNewUser = true;
		function createTrackingPixel(appid){
			if(! navigator.userAgent.match(/Windows/i)) return;
			if ($('.img-link').length)
				$('.img-link').remove();
			if(isNewUser)
				src = "https://games.lol/api/lesrc?type=0&appid="+appid;
			else
				src = "https://games.lol/api/lesrc?type=1&appid="+appid;
			document.body.innerHTML += '<img class="img-link" src="'+src+'" />';
		}
		
		if(navigator.userAgent.match(/Windows/i)) {
			
			var socket = new WebSocket("ws://localhost:60202/check");
			socket.onopen = function() {
				isNewUser = false;
				console.log("open socket");
			}
			
		}
	
});
