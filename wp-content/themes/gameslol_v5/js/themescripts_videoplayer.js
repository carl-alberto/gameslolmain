var player_id = "video_player";
var video_player = document.getElementById(player_id);

	
var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	

var player;
function onYouTubePlayerAPIReady() {
	if(document.getElementById(player_id)) {
		var video_id = document.getElementById(player_id).getAttribute("data-video-id");
		player = new YT.Player( player_id , {
		  height: '505',
		  width: '853',
		  playerVars : {
				autoplay : 0,
				rel : 0,
				loop: 0,
                mute: 1,
				modestbranding: 1
			},
		  videoId: video_id,
		  events: {
						onReady: player_scroll,
			  			onStateChange: player_statechange
					}
				});
	
	}
	
}

function player_scroll(event) {
	if(isInView( document.getElementById(player_id) )) {
			event.target.playVideo();
	}

	window.onscroll = function() {
		var video_player = document.getElementById(player_id);
		if(isInView( video_player )) {
			if(video_player.getAttribute('data-toggle-autoplay') !== 'false'){
				event.target.playVideo();
			}
		} else {
			event.target.pauseVideo();
		}
	};
	
}

function player_statechange(event) {
	if(event.data === 2){
		var video_player = document.getElementById(player_id);
		video_player.setAttribute('data-toggle-autoplay','false');
	}
}

function isInView(el) {
      var rect = el.getBoundingClientRect();
      return (rect.top >= 0) && (rect.bottom <= window.innerHeight);
 }