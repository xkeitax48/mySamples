<?php
function connectDb(){
	try {
		return new PDO("mysql:host=mysql009.phy.lolipop.lan;
						dbname=LAA0564038-hotaiceweb;
						charset=utf8",
						"LAA0564038", "shinod");
	} catch (PDOException $e) {
		echo $e->getMessage();
		exit;
	}
}




//誰の日記か判定して絞り込みます
//指定が無い場合はdefaultでおおせき
$id = 1;
if(isset($_REQUEST["id"])){
	$id = $_REQUEST["id"];
}

// 指定された人の日記だけ取り出します
$sql =<<< SQL_END
SELECT 
	a_person.name,
	a_diary.create_day,
	DATE_FORMAT(a_diary.create_day, "%m/%d") AS month_day,
	DATE_FORMAT(a_diary.create_day, "%Y%m%d") AS yyyymmdd,
	SUBSTR(a_diary.post, 1, 5) AS post_head,
	a_diary.post
FROM a_diary
LEFT JOIN a_person
	ON	a_person.person_id = a_diary.person_id
WHERE a_diary.person_id = :id
ORDER BY create_day
;
SQL_END;

$dbh = connectDb();

$sth = $dbh->prepare($sql);
$sth->execute(array(':id' => $id));

//１行ずつ表示します
//詳細ページへのリンクも設定しておきます
while($data_1day = $sth->fetch(PDO::FETCH_ASSOC)){
	printf( "%s<a href=\"diary.php?date=%s\">【%s】</a>%s<br>\n",
		$data_1day["month_day"],
		$data_1day["yyyymmdd"],
		$data_1day["post_head"],
		$data_1day["name"] );
}


exit;
?>
