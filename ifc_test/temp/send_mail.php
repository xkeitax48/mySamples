<?php
//--------------------------------------------------------------------
// メール送信テスト。
//--------------------------------------------------------------------
	require_once('config.php');
	require_once( DIR_LIB . 'SetUpPC.php');
	require_once( DIR_LIB_FUNCTION . 'Mail/SendController.php');		// メール送信系

	$mail = new MailSendController();

	//To設定
//	$mail->addTo("hiroto.tsuchiya@i-studio.co.jp");
	$mail->addTo("ooseki@i-fc.jp", "to大関");
	//Cc設定
//	$mail->addCc("nobuhito.oozeki@i-studio.co.jp", "cc大関");
	//Bcc設定
//	$mail->addBcc("nobuhito.oozeki@i-studio.co.jp", "bcc大関");
	//From設定
	$mail->setFrom("ooseki@i-fc.jp", "from大関");
	//ReplyTo設定
	$mail->setReplyTo("ooseki@i-fc.jp", "replyTo大関");
	//添付ファイル追加
	$mail->addAttachment(DIR_DATA . "test_data/Attachment.txt");
	$mail->addAttachment(DIR_DATA . "test_data/Attachment.xls");
	//題名設定
	$mail->setSubject("テストメールです");
	//本文設定
	$mail->setBody("テストメールの本文です");

	//送信
	$mail->sendMail(MAIL_HOST);

print "メール送信しました";

	exit;

?>
