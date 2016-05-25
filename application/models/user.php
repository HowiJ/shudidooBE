<?php
    class User extends CI_Model {
        //Construct
        ////////////////////////////////////////////////////////////////////////
        public function __Construct() {
            parent::__Construct();
        }
        ////////////////////////////////////////////////////////////////////////






    	//Login & Registration
    	////////////////////////////////////////////////////////////////////////
        public function checkLogin($post) {
            $query = "SELECT * FROM users WHERE username = ? AND password = ?;";
            $insertion = $post;

            return $this->db->query($query, $insertion)->result_array();
        }
        public function checkUser($username) {
            $query = "SELECT * FROM users WHERE username = ?";
            $insertion = array($username);

            return $this->db->query($query, $insertion)->result_array();
        }
        public function registerUser($post) {
            $query =
            "INSERT INTO `shudidoo`.`users`
            (`username`, `password`, `age`)
            VALUES (?, ?, ?);";

            $insertion = $post;

            $this->db->query($query, $insertion);
        }
        public function deleteUser($id) {
            $query = "DELETE FROM `shudidoo`.`users` WHERE `id`=?;";

            $insertion = array($id);

            $this->db->query($query, $insertion);
        }
        public function deleteUserTagByTagId($id) {
            $query = "DELETE FROM `shudidoo`.`user_tags` WHERE `id`=?";

            $insertion = array($id);

            $this->db->query($query, $insertion);
        }
        public function getAllUserTagsById($id) {
            $query = "SELECT * FROM user_tags WHERE user_id = ?;";

            $insertion = array($id);

            return $this->db->query($query, $insertion)->result_array();
        }
    	////////////////////////////////////////////////////////////////////////






    	//User Tag & Activity Tag
    	////////////////////////////////////////////////////////////////////
        public function checkUserTag($post) {
            $query =
                "SELECT id, user_id, tag_id, count FROM user_tags
                WHERE user_id = ? AND tag_id = ?;";

            $insertion = $post;

            return $this->db->query($query, $insertion)->result_array();
        }
        public function addUserTag($post) {
            $query =
                "INSERT INTO `shudidoo`.`user_tags`
                (`user_id`, `tag_id`, `count`)
                VALUES (?, ?, ?);";

            $insertion = $post;

            $this->db->query($query, $insertion);
        }
        public function updateUserTag($count, $tag_id) {
            //UPDATE `shudidoo`.`user_tags` SET `count`='4' WHERE `id`='4';
            $query =
                "UPDATE `shudidoo`.`user_tags`
                SET `count`=? WHERE `id`=?;";

            $insertion = array($count, $tag_id);

            $this->db->query($query, $insertion);
        }



        public function checkActivityTab($post) {
            $query =
                "SELECT activity_tags.id, activity, tag FROM activity_tags
                JOIN activities ON activities.id = activity_tags.activity_id
                JOIN tags ON activity_tags.tag_id = tags.id
                WHERE activity_id = ? AND tag_id = ?;";

            $insertion = $post;

            return $this->db->query($query, $insertion)->result_array();
        }
        public function addActivityTag($post) {
            $query =
                "INSERT INTO `shudidoo`.`activity_tags`
                (`activity_id`, `tag_id`)
                VALUES (?, ?);";

            $insertion = $post;

            $this->db->query($query, $insertion);
        }
    	////////////////////////////////////////////////////////////////////








        //GET Add Tags and Activities
        ////////////////////////////////////////////////////////////////////////
        //INSERT INTO `shudidoo`.`activities` (`activity`) VALUES ('billiards');
        public function addTag($tag) {
            $query = "INSERT INTO `shudidoo`.`tags` (`tag`) VALUES (?)";

            $insertion = $tag;

            $this->db->query($query, $insertion);
        }
        public function checkTag($tag) {
            $query = "SELECT * FROM tags WHERE tag = ?;";

            $insertion = $tag;

            return $this->db->query($query, $insertion)->result_array();
        }

        public function addActivity($activity) {
            $query = "INSERT INTO `shudidoo`.`activities` (`activity`, `keywords`) VALUES (?, ?)";

            $insertion = $activity;

            $this->db->query($query, $insertion);
        }
        public function checkActivity($activity) {
            $query = "SELECT * FROM activities WHERE activity = ?;";

            $insertion = $activity;

            return $this->db->query($query, $insertion)->result_array();
        }
        ////////////////////////////////////////////////////////////////////////








        //GET All Detailed
        ////////////////////////////////////////////////////////////////////////
        public function getUserTags() {
            $query =
            "SELECT username, age, tag, count FROM users
                JOIN user_tags ON user_tags.user_id = users.id
                JOIN tags ON user_tags.tag_id = tags.id";

            return $this->db->query($query)->result_array();
        }
        public function getActivityTags() {
            $query =
            "SELECT activity, tag FROM activities
                JOIN activity_tags ON activity_tags.activity_id = activities.id
                JOIN tags ON activity_tags.tag_id = tags.id";

            return $this->db->query($query)->result_array();
        }
        public function getUserTagsSorted($username) {
            $query =
            "SELECT username, tag, count FROM users
                JOIN user_tags ON user_tags.user_id = users.id
                JOIN tags ON user_tags.tag_id = tags.id
                WHERE username = ?
                ORDER BY count DESC;";

            $insertion = array($username);

            return $this->db->query($query, $insertion)->result_array();
        }
        ////////////////////////////////////////////////////////////////////////





        //GET All
        ////////////////////////////////////////////////////////////////////////
        public function getAllUsers() {
            $query = "SELECT * FROM users ORDER BY username ASC";

            return $this->db->query($query)->result_array();
        }
        public function getAllTags() {
            $query = "SELECT * FROM tags ORDER BY tag ASC";

            return $this->db->query($query)->result_array();
        }
        public function getAllActivities() {
            $query = "SELECT * FROM activities ORDER BY activity ASC";

            return $this->db->query($query)->result_array();
        }
        public function getActivitiesWithTags($tag) {
            $query =
            "SELECT activities.id, activity, tag FROM activities
                JOIN activity_tags ON activity_id = activities.id
                JOIN tags ON tag_id = tags.id
                WHERE tag = ?;";

            $insertion = array($tag);

            return $this->db->query($query, $insertion)->result_array();
        }
        public function getTagsByActivityName($activity) {
            $query =
            "SELECT activities.id, activity, tag FROM activities
                JOIN activity_tags ON activity_id = activities.id
                JOIN tags ON tag_id = tags.id
                WHERE activity = ?;";

            $insertion = array($activity);

            return $this->db->query($query, $insertion)->result_array();
        }
        ////////////////////////////////////////////////////////////////////////





        //TASKS
        ////////////////////////////////////////////////////////////////////////
        public function getTasksByName($post) {
            $query = "SELECT * FROM tasks JOIN users ON user_id = users.id
                WHERE users.username = ?;";

            $insertion = $post;
            // var_dump($insertion);

            return $this->db->query($query, $insertion)->result_array();
        }
        public function getTasksById($id) {
            $query = "SELECT * FROM tasks WHERE user_id = ?;";

            $insertion = array($id);

            return $this->db->query($query, $insertion)->result_array();
        }
        public function deleteTaskByTaskId($id) {
            $query = "DELETE FROM `shudidoo`.`tasks` WHERE tasks.id = ?;";

            $insertion = array($id);

            $this->db->query($query, $insertion);
        }
        public function addTasks($post) {
            $query = "INSERT INTO `shudidoo`.`tasks` (`task`, `user_id`, `priority`)
            VALUES (?, ?, ?);";

            $insertion = $post;

            $this->db->query($query, $insertion)->result_array();
        }
        ////////////////////////////////////////////////////////////////////////
    }
?>
