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
    	////////////////////////////////////////////////////////////////////





        //INSERT INTO `shudidoo`.`activities` (`activity`) VALUES ('billiards');




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
        ////////////////////////////////////////////////////////////////////////


        //GET All
        ////////////////////////////////////////////////////////////////////////
        public function getAllUsers() {
            $query = "SELECT * FROM users";

            return $this->db->query($query)->result_array();
        }
        public function getAllTags() {
            $query = "SELECT * FROM tags";

            return $this->db->query($query)->result_array();
        }
        public function getAllActivities() {
            $query = "SELECT * FROM activities";

            return $this->db->query($query)->result_array();
        }
        ////////////////////////////////////////////////////////////////////////
    }
?>
