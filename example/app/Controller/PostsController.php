<?php
class PostsController extends AppController
{
	//ヘルパーを指定
	public $helpers = array("Html", "Form", "Session");
	public $components = array("Session");
	public $uses = array("Post", "Gender");

	//index.ctp
	public function index() {
		//全件取得
		$posts = $this->Post->find("all");
		$this->set("posts", $posts);

		//性別を設定
		$genders = $this->Gender->find("list");
		$this->set("genders", $genders);
	}

	public function add() {
		//性別を設定
		$genders = $this->Gender->find("list");
		$this->set("genders", $genders);

		//postで来たなら
		if($this->request->is("post")) {
			//まずは初期化して、
			$this->Post->create();

			//DBに保存します
			if($this->Post->save($this->request->data)) {

				//indexへGO
				return $this->redirect(array("action" => "index"));
			}
		}
	}

	public function edit($id=null) {
		//idがあるか確認
		if(!$id) {
			throw new NotFoundException(__('Invalid post'));
		}

		//idから記事を探す
		$post = $this->Post->findById($id);

		//記事があるか確認
		if(!$post) {
			throw new NotFoundException(__('Invalid post'));
		}

		//性別を設定
		$genders = $this->Gender->find("list");
		$this->set("genders", $genders);

		//putで来たなら
		if($this->request->is("put")) {
			//まずはIDを格納し、
			$this->Post->id = $id;

			//DBに保存します
			if($this->Post->save($this->request->data)) {
				
				//indexへGO
				return $this->redirect(array("action" => "index"));
			}
		}

		//リクエストにデータがなければ
		if (!$this->request->data) {
			//リクエスト変数に記事を保存
			$this->request->data = $post;
		}
	}

	public function delete($id=null) {
		//getリクエストはだめです
		if($this->request->is("get")) {
			throw new MethodNotAllowedException();
		}

		//削除するよ
		if($this->Post->delete($id)) {

			//indexへGO
			return $this->redirect(array("action" => "index"));
		}
	}
}