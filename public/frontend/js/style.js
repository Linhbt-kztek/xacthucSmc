$(function() {
	$("document").keydown(function(e) {
		if(e.keyCode == 13) {
			search();
		}
	});

	/* tab */
	$(".tab-item").click(function() {
		$(".tab-item").removeClass("active");
		$(this).addClass("active");
		$(".tab-panel").removeClass("active-tab");
		$($("a", $(this)).attr("href")).addClass("active-tab");
	});
	/*menu mobile*/
	$("#pull-menu").click(function(e) {
		e.preventDefault();
        $("#parent-mn").toggleClass("toggled");
	});

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$(".fb-like-box iframe").contents().find("._2p3a").attr("style", "width: 100% !important;");
	}
});

function search()
{
	var _key = $("#txtKey").val();
	if(_key.trim() != "") {
		var _url = $("#url_search").attr("data-href");
		window.location.href = _url + "?key=" + _key;
	}
	return false;
}