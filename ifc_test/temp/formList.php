<?php

require_once("form.php");

class formList extends form
{
	function __construct()
	{
		parent::__construct();

		$this->form_list = array(
			"todouhuken" => array(
						 1  => "北海道",	 2  => "青森県",	 3  => "岩手県",	 4  => "宮城県",	 5  => "秋田県",	 6  => "山形県",	 	7  => "福島県",	 8  => "茨城県",
						 9  => "栃木県",	10  => "群馬県",	11  => "埼玉県",	12  => "千葉県",	13  => "東京都",	14  => "神奈川県",	15  => "新潟県",	16  => "富山県",
						17  => "石川県",	18  => "福井県",	19  => "山梨県",	20  => "長野県",	21  => "岐阜県",	22  => "静岡県",		23  => "愛知県",	24  => "三重県",
						25  => "滋賀県",	26  => "京都府",	27  => "大阪府",	28  => "兵庫県",	29  => "奈良県",	30  => "和歌山県",	31  => "鳥取県",	32  => "島根県",
						33  => "岡山県",	34  => "広島県",	35  => "山口県",	36  => "徳島県",	37  => "香川県",	38  => "愛媛県",		39  => "高知県",	40  => "福岡県",
						41  => "佐賀県",	42  => "長崎県",	43  => "熊本県",	44  => "大分県",	45  => "宮崎県",	46  => "鹿児島県",	47  => "沖縄県"
					),

			"seibetsu" => array(
						1   => "男姓",
						2   => "女姓",
						3   => "その他"
					),
			"birth_year" => array_combine(range(2014, 1900), range(2014, 1900)),
			"birth_month" => array_combine(range(1, 12), range(1, 12)),
			"birth_day" => array_combine(range(1, 31), range(1, 31)),
		);

		$this->error = array(
				"email_error"			=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "email"),
												array(	"message" => "正しく入力してください。",					"method" => "isMailAddress",	"field" => "email"),
												array(	"message" => "すでに登録済みです。",					"method" => "isNotMember",		"field" => "email")
											),
				"password_error"		=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "password"),
												array(	"message" => "６～１６文字で入力してください。",			"method" => "lengthBetween",	"field" => "password",		"arg" => array(6, 16)),
												array(	"message" => "英数字で入力してください。",				"method" => "isAlphanumeric",	"field" => "password"),
												array(	"message" => "英語と数字を１文字以上ずつ含めてください。",	"method" => "isStrongPass",		"field" => "password"),
											),
				"re_password_error"		=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "re_password"),
												array(	"message" => "パスワードと一致していません。",			"method" => "myEqual",			"field" => "re_and_password")
											),
				"name_error"			=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "sei"),
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "mei"),
												array(	"message" => "最大１６文字です。",					"method" => "lengthBetween",	"field" => "sei",			"arg" => array(1, 16)),
												array(	"message" => "最大１６文字です。",					"method" => "lengthBetween",	"field" => "mei",			"arg" => array(1, 16)),
												array(	"message" => "使用できない文字が含まれています。",		"method" => "isName",			"field" => "sei"),
												array(	"message" => "使用できない文字が含まれています。",		"method" => "isName",			"field" => "mei")
											),
				"kana_error"			=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "sei_kana"),
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "mei_kana"),
												array(	"message" => "最大１６文字です。",					"method" => "lengthBetween",	"field" => "sei_kana",		"arg" => array(1, 16)),
												array(	"message" => "最大１６文字です。",					"method" => "lengthBetween",	"field" => "mei_kana",		"arg" => array(1, 16)),
												array(	"message" => "ひらがなで入力してください。",				"method" => "isKana",			"field" => "sei_kana",		"arg" => array(true)),
												array(	"message" => "ひらがなで入力してください。",				"method" => "isKana",			"field" => "mei_kana",		"arg" => array(true))
											),
				"seibetsu_error"		=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "seibetsu"),
												array(	"message" => "正しく入力してください。",					"method" => "inEnum",			"field" => "seibetsu",		"arg" => array(array_keys($this->form_list["seibetsu"])))
											),
				"todouhuken_error"		=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "todouhuken"),
												array(	"message" => "正しく入力してください。",					"method" => "inEnum",			"field" => "todouhuken",	"arg" => array(array_keys($this->form_list["todouhuken"])))
											),
				"birthday_error"		=> array(
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "birth_year"),
												array(	"message" => "正しく入力してください。",					"method" => "inEnum",			"field" => "birth_year",	"arg" => array(array_keys($this->form_list["birth_year"]))),
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "birth_month"),
												array(	"message" => "正しく入力してください。",					"method" => "inEnum",			"field" => "birth_month",	"arg" => array(array_keys($this->form_list["birth_month"]))),
												array(	"message" => "このフィールドは入力必須です。",			"method" => "notNull",			"field" => "birth_day"),
												array(	"message" => "正しく入力してください。",					"method" => "inEnum",			"field" => "birth_day",		"arg" => array(array_keys($this->form_list["birth_day"]))),
												array(	"message" => "日付が正しくありません。",				"method" => "myIsDate",			"field" => "birth_date")
											)
				);

		$this->post = array(
						"email",
						"password",
						"re_password",
						"sei",
						"mei",
						"sei_kana",
						"mei_kana",
						"seibetsu",
						"todouhuken",
						"birth_year",
						"birth_month",
						"birth_day"
					);
	}
}
