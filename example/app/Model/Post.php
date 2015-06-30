<?php
class Post extends AppModel
{
	public $validate = array(
			"first_name" => array(
					"rule" => "notEmpty",
				),
			"last_name" => array(
					"rule" => "notEmpty",
				), 
			"gender_id" => array(
					"rule" => "notEmpty",
				), 
			"old" => array(
					"rule" => "notEmpty",
				), 
		);
}