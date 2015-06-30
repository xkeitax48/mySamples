// ajax書き方2
$(function() {
	$("#send_button").click(function() {
		$.get("nippo.php", {
				running: $(".running").val(),
				impression: $(".impression").val()
			}, function(data) {
				$("#date_today").html(data.date_today);
				$("#date_tomorrow").html(data.date_tomorrow);
				$("#weekday").html(data.weekday);
				$("#taikin").html(data.taikin);
				$("#running").html(data.running);
				$("#impression").html(data.impression);
			}
		);
	});

	$("#send_button").click(function() {
		$(".notEmpty").remove();
		$("#today_category0").html($(".today_category0").val());
		$("#today_category1").html($(".today_category1").val());
		$("#today_category2").html($(".today_category2").val());
		$("#tomorrow_category0").html($(".tomorrow_category0").val());
		$("#tomorrow_category1").html($(".tomorrow_category1").val());
		$("#tomorrow_category2").html($(".tomorrow_category2").val());
		$("#today_content0").html($(".today_content0").val().replace(/\r?\n/g, '<br>'));
		$("#today_content1").html($(".today_content1").val().replace(/\r?\n/g, '<br>'));
		$("#today_content2").html($(".today_content2").val().replace(/\r?\n/g, '<br>'));
		$("#tomorrow_content0").html($(".tomorrow_content0").val().replace(/\r?\n/g, '<br>'));
		$("#tomorrow_content1").html($(".tomorrow_content1").val().replace(/\r?\n/g, '<br>'));
		$("#tomorrow_content2").html($(".tomorrow_content2").val().replace(/\r?\n/g, '<br>'));
		$(".category:not(:empty)").before("<a class='notEmpty'>▼</a>").after("<br class='notEmpty'>");
		$(".content:not(:empty)").after("<br class='notEmpty'><br class='notEmpty'>");
	});
});