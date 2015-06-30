<?php
require_once (DIR_LIB.'aws/aws-autoloader.php');

// 利用クラスの定義
use Aws\S3\S3Client;
// use GuzzleHttp\EntityBody;

// アクセスキーとか設定
define('AWS_ACCESS_KEY_ID', '');
define('AWS_SECRET_ACCESS_KEY', '');
define('AWS_DEFAULT_REGION', 'ap-northeast-1');

// バケット名の設定
define('S3_BUCKET_NAME', 'krowl-preview');

class S3Controller{

	static function fileUpload($dir_name)
	{
		// ファイルがないとfalse返す
		if(!$_FILES['tmp_file']) {
			return false;
		}

		// S3オブジェクトを生成
		$s3 = S3Client::factory(array(
				'key' 		=>　AWS_ACCESS_KEY_ID,
				'secret' 	=>　AWS_SECRET_ACCESS_KEY,
				'region' 	=>　AWS_DEFAULT_REGION
		));

		// ダメだったらfalse返す
		if(!$s3) {
			return false;
		}

		// アップロードするファイル
		$file = $_FILES['tmp_file'];

		// アップロード後のファイル名
		$file_name = date('Y-m-d-H-i-s_').$_FILES['tmp_file']['name'];

		// アップロードします
		$result = $s3->putObject(array(
				'Bucket' 	=> S3_BUCKET_NAME,
				'Key' 		=> $dir_name.'/'.$file_name,
				'Body'		=> fopen($file, 'r'),
				// 'Body'		=> EntityBody::factory(fopen($tempFileName, 'r'))
		));

		// S3内のファイルのURLを返します
		return $result['ObjectURL'];
	}
}