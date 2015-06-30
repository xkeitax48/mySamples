<?php

class DBCommon
{
	protected $pdo_obj;
	protected $table_name;
	protected $stmt;
	public $column_list;

	function __construct($table_name, $pdo_obj)
	{
		$this->pdo_obj = $pdo_obj;

		// テーブル名を設定
		$this->table_name = $table_name;

		// カラムリスト取得しとく
		$this->column_list = $this->getTableColumnList();
	}

	function getTableColumnList()
	{
		// テーブルを設定
		$table_name = $this->table_name;

		$sql = <<< SQL_END
DESCRIBE {$table_name}
;
SQL_END;

		$this->stmt = $this->pdo_obj->prepare($sql);
		$this->stmt->execute();

		$columns = array();

		//結果取得
		while( ($column = $this->stmt->fetch(PDO::FETCH_ASSOC)) ){
			$columns[] = $column["Field"];
		}

		$this->stmt->closeCursor();

		return $columns;
	}


	function insertOne($value_list)
	{
		// テーブルを設定
		$table_name = $this->table_name;

		// sql用の変数を組み立てます
		list($columns, $values, $params) = $this->makeInsertSqlParts($value_list);

$sql =<<<SQL_END
INSERT INTO {$table_name} (
{$columns}
	)
VALUES(
{$values}
	)
;
SQL_END;

		// sqlをセットし、
		$stmt = $this->pdo_obj->prepare($sql);

		// 実行せよ
		return $stmt->execute($params);
	}


	function makeInsertSqlParts($value_list)
	{
		// まずは設定するカラムを探して、組み立てます
		$columns_array = array();
		$values_array = array();
		$params = array();

		//引数でもらった配列のkeyがカラム名と一致していたらINSERT
		foreach($value_list as $name=>$value) {
			if(in_array($name, $this->column_list)) {
				$columns_array[] = " {$name} ";
				$values_array[] = " :{$name} ";
				$params[":{$name}"] = $value;
			}
		}

		$columns = implode(",", $columns_array);
		$values = implode(",", $values_array);

		return array($columns, $values, $params);
	}


	function selectAllPrimaryKey($sql, $column_name=null, $params=array())
	{
		// テーブルを設定
		$table_name = $this->table_name;

		$pk_sql = <<< SQL_END
SHOW INDEX 
FROM {$table_name}
SQL_END;

		// インデックスを取得
		$indexes = $this->selectAll($pk_sql);

		// インデックスから主キーを取得
		$pk = array();
		foreach($indexes as $column) {
			// カラムが主キーだったら
			if($column["Key_name"] == "PRIMARY") {
				// インデックスの列番号とカラム名をセット
				$pk[$column["Seq_in_index"]] = $column["Column_name"];
			}
		}

		// カラム順にソート
		ksort($key_column_list);

		$result = $this->selectAllKey($sql, $pk, $params);

		return $result;
	}


	function selectAll($sql, $column_name=null, $params=array())
	{
		$this->stmt = $this->pdo_obj->prepare($sql);

		// バインド変数を仕込むよ
		foreach($params as $key=>$value) {
			// 型を取得して、
			$type = $this->getDataType($value);

			// セット！
			$this->stmt->bindValue($key, $value, $type);
		}

		$this->stmt->execute();

		//データを配列に変換します
		$result = array();
		while( ($data = $this->stmt->fetch(PDO::FETCH_ASSOC)) ) {
			if($column_name == null) {
				$result[] = $data;
			}
			elseif(isset($data[$column_name])) {
				$result[] = $data[$column_name];
			}
		}

		$this->stmt->closeCursor();

		return $result;
	}


	function selectAllKey($sql, $key_column_list=array(), $column_name=null, $params=array())
	{
		$this->stmt = $this->pdo_obj->prepare($sql);

		// バインド変数を仕込むよ
		foreach($params as $key=>$value) {
			// 型を取得して、
			$type = $this->getDataType($value);

			// セット！
			$this->stmt->bindValue($key, $value, $type);
		}

		$this->stmt->execute();

		// データを配列に変換します
		$result = array();
		while( ($data = $this->stmt->fetch(PDO::FETCH_ASSOC)) ) {

			$arr = &$result;

			// キーが入れ子状態になった配列を組み立てます
			foreach($key_column_list as $key_column) {
				// まずはキーの中身を取り出し、
				$key_value = $data[$key_column];

				// 配列のキーにセット
				if(!isset($arr[$key_value])) {
					$arr[$key_value] = array();
				}

				// 配列の中身を参照させます
				$arr = &$arr[$key_value];
			}

			if($column_name == null) {
				$arr = $data;
			}
			elseif(isset($data[$column_name])) {
				$arr = $data[$column_name];
			}
		}

		$this->stmt->closeCursor();

		return $result;
	}


	function getDataType($value)
	{
		switch(true){
			case is_bool($value) :
				$type = PDO::PARAM_BOOL;
				break;
			case is_null($value) :
				$type = PDO::PARAM_NULL;
				break;
			case is_int($value) :
				$type = PDO::PARAM_INT;
				break;
			case is_float($value) :
			case is_numeric($value) :
			case is_string($value) :
			default:
				$type = PDO::PARAM_STR;
				break;
		}

		return $type;
	}
}