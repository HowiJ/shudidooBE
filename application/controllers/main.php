<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
	//Construct
	////////////////////////////////////////////////////////////////////////
	public function __Construct() {
		parent::__Construct();

		$this->load->model('User');
	}
	////////////////////////////////////////////////////////////////////////






	 //Views Loading
	 ////////////////////////////////////////////////////////////////////////
	public function index()
	{
		$users = $this->User->getAllUsers();
		$tags = $this->User->getAllTags();
		$activities = $this->User->getAllActivities();

		$userTags = $this->User->getUserTags();
		$activityTags = $this->User->getActivityTags();

		$insert = array(
			'users'=>$users,
			'tags'=>$tags,
			'activities'=>$activities,
			'userTags'=>$userTags,
			'activityTags'=>$activityTags
		);

		$this->load->view('index', $insert);
	}
	////////////////////////////////////////////////////////////////////////







	//Login & Registration
	////////////////////////////////////////////////////////////////////////
	public function checkLogin() {
		$post = $this->input->post();
		$users = $this->User->checkLogin($post);

		if (count($users) > 1) {
			echo "Too many users by this combo..WTF.";
			die();
		} else if (count($users) == 1) {
			$this->session->set_userdata('currUser', $users[0]);
			$this->session->set_userdata('isAdmin', true);
			redirect('/');
		} else {
			$this->session->set_flashdata('error', 'There was an error logging in, please check login credentials and try again.');
			redirect('/');
		}
	}
	public function register() {
		$post = array();
		$tmp = $this->input->post();
		foreach ($tmp as $key => $value) {
			array_push($post, $value);
		}

		// var_dump($post);

		$users = $this->User->checkUser($post[0]);
		//uname, pass, age, mobile?
		if (isset($post[3]) && $post[3] == 1) {	//if mobile
			if (count($users) == 1) {
				//User already created
				echo json_encode(array('Account already created. Please sign in.'));
			} else if (count($users) < 1) {
				//Add User
				echo json_encode($post);
			} else {
				//wtf... fix pls
			}
		} else {
			if (count($users) == 1) {
				//User already created
			} else if (count($users) < 1) {
				//Add User
				$this->User->registerUser($post);
			} else {
				//wtf... fix pls
			}
			redirect('/');
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
	////////////////////////////////////////////////////////////////////////





	//User Tag & Activity Tag
	////////////////////////////////////////////////////////////////////
	public function addUserTag() {	//Updates user-tag-count
		$post = $this->input->post();

		$check = $this->User->checkUserTag($post);

		if ($post['count'] && $post['count'] == 0) {
			$count = $post['count'];
			$tag_id = $check[0]['id'];
			$this->User->updateUserTag($count, $tag_id);
		} else if (count($check) == 1) {
			//Perform Update
			$count = $check[0]['count']+1;
			$tag_id = $check[0]['id'];
			$this->User->updateUserTag($count, $tag_id);
		} else if (count($check) > 1) {
		} else {
			$this->User->addUserTag($post);
		}
		redirect('/');
	}
	////////////////////////////////////////////////////////////////////





	//JSON Encoded Data
	////////////////////////////////////////////////////////////////////////
	public function allUsers() {
		$users = $this->User->getAllUsers();
		$encoded_users = json_encode($users);

		echo $encoded_users;
	}
	public function allTags() {
		$tags = $this->User->getAllTags();
		$encoded_tags = json_encode($tags);

		echo $encoded_tags;
	}
	public function allActivities() {
		$activities = $this->User->getAllActivities();
		$encoded_activities = json_encode($activities);

		echo $encoded_activities;
	}

	public function allUserTags() {
		$userTags = $this->User->getUserTags();
		$encoded_userTags = json_encode($userTags);

		echo $encoded_userTags;
	}
	public function allActivityTags() {
		$activityTags = $this->User->getActivityTags();
		$encoded_activityTags = json_encode($activityTags);

		echo $encoded_activityTags;
	}
	public function jsonCheckLogin() {
		$post = $this->input->post();
		$users = $this->User->checkLogin($post);

		if (count($users) > 1) {
		} else if (count($users) == 1) {
			echo json_encode($users);
		} else {
			echo json_encode(array('Not valid Login'));
		}
	}
	////////////////////////////////////////////////////////////////////////
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
