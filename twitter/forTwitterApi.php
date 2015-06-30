<?php
require_once 'twitteroauth/autoload.php';

// // デベロッパー情報
// define('CONSUMER_KEY', '');
// define('CONSUMER_SECRET', '');
// define('ACCESS_TOKEN', '');
// define('ACCESS_TOKEN_SECRET', '');

// class forTwitterApi
// {
	// static function getTweets($keyword)
	function getTweets($keyword)
	{
		// twitteroauthのインスタンス生成
		$twitterOAuth = new TwitterOAuth(
				CONSUMER_KEY,
				CONSUMER_SECRET,
				ACCESS_TOKEN,
				ACCESS_TOKEN_SECRET
		);

		// APIに渡すパラメータを設定
		$param = array(
				"q" => $keyword,
				"lang" => "ja",
				"count" => 10,
				"result_type" => "recent"
		);

		// TwitterのAPIへ
		$json = $twitterOAuth->OAuthRequest("https://api.twitter.com/1.1/search/tweets.json", "GET", $param);

		// jsonデコードして返す
		return json_decode($json, true);
	}
// }



// 表示はテンプレートに書きましょう

/* ↓↓↓　ここから表示　↓↓↓ */

// $result = forTwitterApi::getTweets("#ハッシュタグ");
$result = getTweets("#ハッシュタグ");

// 全件表示
if($result['statuses']){
	foreach($result['statuses'] as $tweet){
		echo file_get_contents($tweet["user"]["profile_image_url"]);
	}
}

// 1つも見つからなかったら...
else {
	echo "Not Found Tweets";
}