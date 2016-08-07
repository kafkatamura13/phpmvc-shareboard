<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM shares ORDER BY create_date DESC');
		$rows=$this->resultSet();
		return $rows;
	}
	public function add(){
		$post=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
		// die("!!");
		if($post['submit']){
			if($post['title']=='' || $post['body']=='' || $post['link']==''){
			Messages::setMsg('Please fill in all field','error');
			return;
			}
			$user_id=$_SESSION['user_data']['id'];
			$this->query("INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body,:link, :user_id)");
			// echo $post['link'];die();
			$this->bind(':title', $post['title']);
			$this->bind(':body', $post['body']);
			$this->bind(':link', $post['link']);
			$this->bind(':user_id',	$user_id);
			$this->execute();
			// die("!!");
			if($this->lastInsertId()) 
			{ 
				header('Location: '.ROOT_URL.'shares');
			}
		}
		return;
	}
}