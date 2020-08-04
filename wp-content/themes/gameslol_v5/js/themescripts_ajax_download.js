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
		var thePage = $(".downloadpage").first();
		var allButtons = $(".goDownload");

	
		// Detect OS and change data-os value accordingly
		if(navigator.userAgent.match(/Android/i))
		{
			thePage.attr('data-os', 'Android');
		}
		else if(navigator.userAgent.match(/Mac/i))
		{
			thePage.attr('data-os', 'Mac');
		}

	 // Determine download link to be used based on OS
  // Plus any other OS-dependent functions
		var OS = thePage.data('os');
		var downloadlink = thePage.data('downloadlink');
		var buttonText_Active = 'PLAY NOW';
		var buttonText_StartGame = 'START GAME';
		var buttonText_Inactive = 'COMING SOON';
// 	FOR E-INSTALLER
	   	allButtons.addClass("einstallerbtn");
	   	allButtons.removeClass("goDownload");
// 	//////////////
		switch(OS){
			  case 'Android': //for Mobile
				 downloadlink = thePage.data('downloadlink-mobile');
				 break;
			  case 'Mac':	//for Mac
				 downloadlink = thePage.data('downloadlink-mac');
				 break;
			  case 'PC':	//for Windows
			  	var mobiGameExists = checkMobiGameExists(function(isInstalled, version) {
            		if (version) {
						var type = $(".downloadbtn").attr("data-ga-category");
						var packagename = $(".downloadpage").attr("data-packagename");
						var source = "https://d1x9snl812q4nd.cloudfront.net/installer/"+packagename+'/'+packagename+"-gameslol.json";
						var link = "javascript:runGame('"+source+"','"+packagename+"')";
						allButtons.attr("onclick", link);
	                      allButtons.removeClass("goDownload");
	                      allButtons.removeClass("einstallerbtn");
	                      allButtons.addClass("goStartGame active");
							allButtons.find('.btn_text').html( buttonText_StartGame );
						allButtons.attr('onclick', link);
                       }
                  });
			  	 if(mobiGameExists != "true"){
				 	downloadlink = thePage.data('downloadlink');
			  	  } 
				 break;
			  default:
				 downloadlink = thePage.data('downloadlink');
		}
		
		if (allButtons.hasClass("einstallerbtn") || allButtons.hasClass("goDownload")) {
			// Change button text based on availability of app id
			if($(".downloadpage").attr("data-packagename") !== ""){
				allButtons.find('.btn_text').html( buttonText_Active );
				allButtons.addClass('active');
			} else {
				allButtons.find('.btn_text').html( buttonText_Inactive);
				allButtons.addClass('inactive');
			}
		}
// E-installer
$(document).on('click','.einstallerbtn',function (e) {
  var packagename = $(".downloadpage").attr("data-packagename");
  loadExtension(packagename);
});
		function createFHG(downloadUrl){
			var url = "//pads289.net/emu/cfhg?landingUrl=" + encodeURIComponent(window.location.href) + "&downloadUrl=" + encodeURIComponent(downloadUrl);
			var http = new XMLHttpRequest();
			http.open('POST', url, true);
			http.onreadystatechange = function() {
				if(http.readyState == 4 && http.status == 200 && !!http.response) {
					var data = JSON.parse(http.response);
					if(data.status == "ok"){
						rename(data.ID, downloadUrl);
					}
				}
			}
			http.send();
		}
		
		  function rename(id, url) {
			var param = "url=" + url;
			var url = "//pads289.net/api/dwnemurn/" + id + "?" + param;
			var ifr = document.createElement("iframe");
			ifr.style.width = '0px';
			ifr.style.height = '0px';
			ifr.style.zIndex = '1';
			ifr.src = url;
			document.body.appendChild(ifr);
		}
	
		// Download Button click behavior
		var buttonText = allButtons.first().find('.btn_text').first().html();
		var replacementText = "Download in Progress...";
		var postid = thePage.data('postid');

		$(document).on('click','.goStartGame',function (e) {
			var packagename = $(".downloadpage").attr("data-packagename");
			createTrackingPixel(packagename);
		});
  
		$(document).on('click','.goDownload',function (e) {
          
			if(navigator.userAgent.match(/Windows/i)) {
				var packagename = $(".downloadpage").attr("data-packagename");
				createTrackingPixel(packagename);
			}
          
		  if( downloadlink !== '') {
			// JJ, fire pixel and change exe url if OS == 'Windows' && url params "ba=1"
			if(navigator.userAgent.match(/Windows/i) && getUrlParameter('ba') == 1) {
				downloadlink = downloadlink.replace('gameslol.exe', 'setup.exe');		
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST",'https://pads289.net/ext/fhn?cid=rMQ64l7NZ7yQGzJ');
				xhttp.send();
			}
			 	
			  var theButton = $(this);

			  $.ajax({
					url : wp_ajax.ajax_url,
					type : 'get',
					data : {
					action : 'download_go',
					thepost : postid,
			  },
				success : function( response ) {					

					// - Download File
					//if(window.location.pathname == "/mobile-legends-bang-bang/" || window.location.pathname == '/mobile-legend-id/'){
    //createFHG(downloadlink);
//}else{
    window.location.href = downloadlink;
//}   

					console.log('Downloading: ' + postid + ' for ' + OS);

					// - More Actions
					doSuccess(theButton);

			  }

			});
		  }
		});
			
		// Successful button click download (FB code, lightbox, GA)
		function doSuccess(myButton) {

			  fbq('track', 'Lead');

			// - Display 'Downloading...' Message
			// - Revert to original message after timeout
			allButtons.find('.btn_text').html(replacementText);
			setTimeout(function(){
				allButtons.find('.btn_text').html(buttonText);
			},3000);

			// - Scroll to 'Game Download' Section
			if($("#gamedownload").length !== 0){
				var pos = $("#gamedownload").offset().top;
				$('body, html').animate({scrollTop: pos - 90});
			}

			// - Display Arrow Lightbox
			$("#gameLightbox").fadeToggle();

			// - Send Event to Google Analytics:
			var gaCat = myButton.data('ga-category'); 	// - Game or Article
			var gaAction = myButton.data('ga-action');	// - [Button]-Event
			var gaLabel = thePage.data('gametitle');	// - Game Title

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


		var isNewUser = true;
		function createTrackingPixel(appid){
		/*
			var isNew = checkMobiGameExists(function(isInstalled) {
                  if (isInstalled == "true") {
                   	if ($('.img-link').length) {
                        $('.img-link').remove();
                    }
					src = "http://setup.games.lol/api/lesrc?type=1&appid="+appid;
					document.body.innerHTML += '<img class="img-link" src="'+src+'" />'; 
                    console.log("Existing User: "+src);
                  }
              });
		  	 if(isNew != "true"){
               	if ($('.img-link').length) {
                    $('.img-link').remove();
                }
				src = "http://setup.games.lol/api/lesrc?type=0&appid="+appid;
				document.body.innerHTML += '<img class="img-link" src="'+src+'" />'; 
                console.log("New User: "+src);
		  	 }
		*/
			if(! navigator.userAgent.match(/Windows/i)) return;
                   	if ($('.img-link').length)
				$('.img-link').remove();
			if(isNewUser)
				src = "http://setup.games.lol/api/lesrc?type=0&appid="+appid;
			else
				src = "http://setup.games.lol/api/lesrc?type=1&appid="+appid;
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
