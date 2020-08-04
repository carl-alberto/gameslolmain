
jQuery(document).ready(function($) {
	 $('.gameinfo_remove').click(function() {
		 
		metaname = $(this).data("metaname");
			
		$('input#'+metaname).val('');
		$('img.gameinfo-preview.'+metaname).attr('src','');
		 return false;
		 
	});
	  
	$('.gameinfo_button').click(function() {
		
		metaname = $(this).data("metaname");
		var send_attachment_bkp = wp.media.editor.send.attachment;

		wp.media.editor.send.attachment = function(props, attachment) {

		$('input#'+metaname).val(attachment.url);
		$('img.gameinfo-preview.'+metaname).attr('src',attachment.url);
		wp.media.editor.send.attachment = send_attachment_bkp;
			
		}

		wp.media.editor.open();

		return false;
	});
});