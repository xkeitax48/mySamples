<?php

require_once(DIR_LIB_FUNCTION.'Validate/watarai_MyValidate.php');
require_once(DIR_LIB_FUNCTION . "DB/watarai_Usersql.php");


class form
{
	public $form_list;
	public $error;
	public $post;
	public $validater;
	public $messages;

	function __construct(){
		$this->validater = new FunctionMyValidate();
	}

	public function validate($post)
	{
		$error_flag = false;
		
		foreach($this->error as $error_name=>$error_list) {
			foreach($error_list as $error) {

				// バリデートします
				//　引数が指定されている場合
				if(isset($error["arg"])) {
					array_unshift($error["arg"], $post[$error["field"]]);
					$result = call_user_func_array(array($this->validater, $error["method"]), $error["arg"]);
				}

				// 引数が指定されていない場合
				else {
					$result = $this->validater->$error["method"]($post[$error["field"]]);
				}

				// バリデートしてエラーの場合
				if($result == false) {

					// エラーフラグを立てます
					$error_flag = true;

					// エラーメッセージを保存します
					$this->messages[$error_name] = $error["message"];

					// 次の項目のチェックに移ります
					break;
				}
			}
		}

		// エラーがあればfalseを返します
		if($error_flag == true) {
			return false;
		}

		// エラーがなければtrueを返します
		return true;
	}


}