<head>
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
	<div class="today">
		◆本日やったこと
		<p>▼<input type="text" name="" value="" class="today_category0"></p>
		<p><textarea name="" value="" cols="30" row="5" class="today_content0"></textarea></p>

		<p>▼<input type="text" name="" value="" class="today_category1"></p>
		<p><textarea name="" value="" cols="30" row="5" class="today_content1"></textarea></p>

		<p>▼<input type="text" name="" value="" class="today_category2"></p>
		<p><textarea name="" value="" cols="30" row="5" class="today_content2"></textarea></p>
	</div>

	<div class="tomorrow">
		◆明日の予定
		<p>▼<input type="text" name="" value="" class="tomorrow_category0"></p>
		<p><textarea name="" value="" cols="30" row="5" class="tomorrow_content0"></textarea></p>

		<p>▼<input type="text" name="" value="" class="tomorrow_category1"></p>
		<p><textarea name="" value="" cols="30" row="5" class="tomorrow_content1"></textarea></p>

		<p>▼<input type="text" name="" value="" class="tomorrow_category2"></p>
		<p><textarea name="" value="" cols="30" row="5" class="tomorrow_content2"></textarea></p>
	</div>

	<div class="foot">
		稼働率
		<p><select name="running" class="running">
			<option value="20">20</option>
			<option value="30">30</option>
			<option value="50">50</option>
			<option value="70" selected>70</option>
			<option value="90">90</option></select>
			%</p>
		所感
		<p><textarea name="impression" value="" cols="70" row="10" class="impression"></textarea></p>
		<p><input type="button" value="send" id="send_button"></p>
	</div>

	<div id="result">
		<a id="date_today"></a> 日報 渡会
		<hr>
		みなさま<br>
		<br>
		お疲れ様です。渡会です。<br>
		本日の日報をお送り致します。<br>
		ご確認宜しくお願いします。<br>
		<br>
		<br>
		◆本日やったこと<br>
		-------------------------------------------------------<br>
		<a id="today_category0" class="category"></a>
		<a id="today_content0" class="content"></a>
		<a id="today_category1" class="category"></a>
		<a id="today_content1" class="content"></a>
		<a id="today_category2" class="category"></a>
		<a id="today_content2" class="content"></a>
		-------------------------------------------------------<br>
		<br>
		◆<a id="date_tomorrow"></a>(<a id="weekday"></a>)の予定<br>
		-------------------------------------------------------<br>
		<a id="tomorrow_category0" class="category"></a>
		<a id="tomorrow_content0" class="content"></a>
		<a id="tomorrow_category1" class="category"></a>
		<a id="tomorrow_content1" class="content"></a>
		<a id="tomorrow_category2" class="category"></a>
		<a id="tomorrow_content2" class="content"></a>
		-------------------------------------------------------<br>
		<br>
		出勤:9:30<br>
		退勤:<a id="taikin"></a><br>

		稼働率:<a id="running"></a>%<br>
		<br>
		所感:<br>
		<a id="impression"></a>
	</div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="script.js"></script>
</body>