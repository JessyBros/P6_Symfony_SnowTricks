$(function () {
	// show the first eight figures
	$("article.figure").slice(0, 9).show();

	$("#loadMoreFigure").on("click", function () {
		$("article.figure:hidden").slice(0, 3).slideDown();
		if ($("article.figure:hidden").length === 0) {
			showButtonLessFigure();
		} 
		showArrowUp();
	});

	$("#loadLessFigure").on("click", function () {
		$("article.figure").slice(9, $("article.figure").length).hide();
		showButtonMoreFigure();
	});

	function showButtonLessFigure(){
		$("#loadMoreFigure").hide("slow");
		$("#loadLessFigure").show("slow");
		$("#arrowUp").show("slow");
	}

	function showButtonMoreFigure(){
		$("#loadLessFigure").hide("slow");
		$("#loadMoreFigure").show("slow");
		$("#arrowUp").hide("slow");
	}

	function showArrowUp() {
		if ($("article.figure:visible").length >= 15) {
			$("#arrowUp").show("slow");
		}
	}
});