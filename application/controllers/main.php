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
		$post = $this->input->post();
		// echo json_encode(array('someting'));
		$users = $this->User->checkUser($post['username']);
		//uname, pass, age, mobile?
		if (count($users) == 1) {
			//User already created
			// echo json_encode(array('Account already created. Please sign in. Tell howard'));
		} else if (count($users) < 1) {
			//Add User
			// $this->User->registerUser($post);
			$insert = array($post['username'], $post['password'], $post['age']);
			$this->User->registerUser($insert);
		} else {
			//wtf... fix pls
		}
		redirect('/');
		// echo json_encode(array('WTFWORK'));
	}
	public function jsonRegister() {
		$post = $this->input->post();

		$users = $this->User->checkUser($post['username']);
		if (count($users) == 1) {
			//User already created
			echo json_encode(array('Account already created. Please sign in.'));
		} else if (count($users) < 1) {
			//Add User
			$insert = array($post['username'], $post['password'], $post['age']);
			$this->User->registerUser($insert);


			$users = $this->User->checkUser($post['username']);
			echo json_encode($users);
		} else {
			//wtf... fix pls
			echo json_encode(array('dafuq...contact admin plox'));
		}
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect('/');
	}
	public function deleteUser($id) {
		$connections = $this->User->getAllUserTagsById($id);
		// var_dump($connections);
		if (count($connections) > 0) {
			foreach ($connections as $key => $value) {
				//DELETE EACH BY $value['id']
				$this->User->deleteUserTagByTagId($value['id']);
			}
		}
		$tasks = $this->User->getTasksById($id);
		if (count($tasks) > 0) {
			foreach ($tasks as $key => $value) {
				$this->User->deleteTaskByTaskId($value['id']);
			}
		}
		// var_dump($tasks);

		$this->User->deleteUser($id);
		redirect('/');
	}
	////////////////////////////////////////////////////////////////////////










	//Add Tags and Activities
	////////////////////////////////////////////////////////////////////
	public function addTag (){
		$post = $this->input->post();
		$postLower = array();

		foreach ($post as $key=>$value) {
			array_push($postLower, strtolower($value));
		}
		$check = $this->User->checkTag($postLower);

		if (count($check) < 1) {
			$this->User->addTag($postLower);
		}

		redirect('/');
	}
	public function addActivity (){
		$post = $this->input->post();
		$postLower = array();

		foreach ($post as $key=>$value) {
			array_push($postLower, strtolower($value));
		}
		$check = $this->User->checkActivity($postLower);

		if (count($check) < 1) {
			$this->User->addActivity($postLower);
		}

		redirect('/');
	}
	////////////////////////////////////////////////////////////////////









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
	public function addActivityTag() {
		$post = $this->input->post();

		$check = $this->User->checkActivityTab($post);

		if (count($check) < 1) {
			//Add to activity_tags
			// var_dump($post);
			$this->User->addActivityTag($post);
		}
		redirect('/');
	}
	////////////////////////////////////////////////////////////////////







	//Tasks
	////////////////////////////////////////////////////////////////////
	public function addTasks() {
		$poste = $this->input->post();								//[[String]]
		echo json_encode($poste);
		// $poste = array('object'=>array(
		// 	array('username'=>'howi', 'task'=>'Pls WERQAAA', 'priority'=>'Cupertino', 'locationRequired'=>'1'),
		// 	array('username'=>'howi', 'task'=>'Pls WERQ2', 'priority'=>'Saratoga', 'locationRequired'=>'1')
		// 		)
		// 	);
		$post = $poste['object'];

		$username = $post[0]['username'];							//username : String
		$userDetails = $this->User->checkUser($username);	//Details : [String]
		$userId = $userDetails[0]['id'];								//userId : String

		$connections = $this->User->getTasksByName(array($username));	//[[String]]
		foreach ($connections as $key => $value) {
			$this->User->deleteTaskByTaskId($value['id']);
		}
		foreach ($post as $key => $value) {
			$insert = array($value['task'], $userId, $value['priority'], $value['locationRequired']);
			$this->User->addTasks($insert);
		}

		// echo json_encode(array('status'=>'Done.'));
	}
	public function addOneTask() {
		$post = $this->input->post();

		$user = $this->User->checkUser($post['username']);

		$insert = array($post['task'], $user['id'], $post['priority'], $post['map_request']);
		$this->User->addTasks($insert);

		echo json_encode($insert);
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
		$input = array($post['username'], $post['password']);
		$users = $this->User->checkLogin($input);

		if (count($users) > 1) {
		} else if (count($users) == 1) {
			echo json_encode($users);
		} else {
			echo json_encode(array('bad login'));
		}
	}
	public function getTasksByName() {
		$post = $this->input->post();
		$users = $this->User->getTasksByName($post);


		if (count($users) < 1) {
		} else {
			echo json_encode($users);
		}
	}
	////////////////////////////////////////////////////////////////////////
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
