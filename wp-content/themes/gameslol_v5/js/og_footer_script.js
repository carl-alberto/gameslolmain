/*
function switchToOsExe(OS, wordReplace) {
	if(OS == 'Android')
		$('.downloadbtn').each(function(){
			var exeUrl = $(this).attr('data-downloadlink');
			var paths = exeUrl.split('/');
			var appId = paths[4];
			$(this).attr('data-downloadlink', 'https://d1x9snl812q4nd.cloudfront.net/PlayStore/apk/'+appId+'.apk');
		});
	if(wordReplace)
		$(".goDownload, .downloadbtn").find('.btn_text').each(function(){
			$(this).contents().filter(function() {
			    return this.nodeType == 3;
			}).
			each(function(){
				this.textContent = this.textContent.replace('on PC', wordReplace);
			});
		});
}
var buttonDefaultTitle = null;
function changeButtonTitle() {
	if(buttonDefaultTitle !== null)
		return;
	buttonDefaultTitle = $(".goDownload, .downloadbtn").find('.btn_text').first().text();
	$(".goDownload, .downloadbtn").find('.btn_text').text('Downloading... Please wait');
	setTimeout(function(){
		$(".goDownload, .downloadbtn").find('.btn_text').text(buttonDefaultTitle);
		buttonDefaultTitle = null;
	},30000);
}
function downloadLinkReplaceMent() {
	$(".goDownload, .downloadbtn").find('.btn_text').each(function(){
		document.addEventListener('click', function(){
			changeButtonTitle();
		});
		//$(this).on('click',function(){
		//	changeButtonTitle();
		//	return false;
		//});
	});
	document.addEventListener('click', downloadLinkReplaceMent);
	if(navigator.userAgent.match(/Android/i))
		switchToOsExe('Android', 'on Mobile');
	else if(navigator.userAgent.match(/Mac/i))
		switchToOsExe(null, 'on Mac');
}
document.addEventListener('DOMContentLoaded', downloadLinkReplaceMent);
*/
