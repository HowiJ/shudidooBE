<?php
class Task extends CI_Controller {
    public function __Construct () {
        parent::__Construct();

        $this->load->model('User');
    }

    public function index($username, $results) {
        $returnArray = array();
        $filterArray = ["social", "sosick"];
        //DO 5 TIMES

        while (count($returnArray) < $results) {
            $userTags = $this->User->getUserTagsSorted($username);

            $arr = array();

            $randA = rand(1,100);
            $choice;
            //low: 20%, 30%, 50%
            if ($randA > 25) {
                $choice = 0;
            } else if ($randA > 6) {
                $choice = 3;
            } else {
                $choice = count($userTags)-4;
            }

            if (count($userTags) > 3) {
                for ($i=0; $i < 3; $i++) {
                    array_push($arr, $userTags[$i+$choice]['tag']);
                }
            } else {
                for ($i=0; $i < count($userTags); $i++) {
                    array_push($arr, $userTags[$i]['tag']);
                }
            }

            $tagsOne = $this->User->getActivitiesWithTags($arr[0]);
            $tagsTwo = $this->User->getActivitiesWithTags($arr[1]);
            $tagsThree = $this->User->getActivitiesWithTags($arr[2]);

            $activitiesArray = array();

            foreach ($tagsOne as $key => $value) {
                if (!isset($activitiesArray[$value['activity']])) {
                    $activitiesArray[$value['activity']]=array($value['tag']);
                } else {
                    array_push($activitiesArray[$value['activity']], $value['tag']);
                }
            }
            foreach ($tagsTwo as $key => $value) {
                if (!isset($activitiesArray[$value['activity']])) {
                    $activitiesArray[$value['activity']]=array($value['tag']);
                } else {
                    array_push($activitiesArray[$value['activity']], $value['tag']);
                }
            }
            foreach ($tagsThree as $key => $value) {
                if (!isset($activitiesArray[$value['activity']])) {
                    $activitiesArray[$value['activity']]=array($value['tag']);
                } else {
                    array_push($activitiesArray[$value['activity']], $value['tag']);
                }
            }

            $tagsArray = array();

            foreach ($activitiesArray as $key=>$value) {
                $tmp = $this->User->getTagsByActivityName($key);
                foreach ($tmp as $k => $val) {
                    if (!in_array($val['tag'], $activitiesArray[$key])) {
                        array_push($activitiesArray[$key], $val['tag']);
                    }
                }
            }

            $t1 = array();
            $t2 = array();
            $t3 = array();

            foreach($activitiesArray as $key=>$value) {
                if (in_array($arr[0], $value) && in_array($arr[1], $value) && in_array($arr[2], $value)) {
                    $t3[$key] = $value;
                } else if ((in_array($arr[0], $value) && in_array($arr[1], $value)) ||
                            (in_array($arr[0], $value) && in_array($arr[2], $value)) ||
                            (in_array($arr[1], $value) && in_array($arr[2], $value))) {
                    $t2[$key] = $value;
                } else {
                    $t1[$key] = $value;
                }
            }
            //rand for which T to choose.
            //T3: 50%
            //T2: 30%
            //T1: 20%
            $randT = rand(1, 100);
            // echo 'RAND: '.$randT;

            if ($randT > 50 && count($t3) >= 1) {
                // var_dump('T3:<br />', $t3);
                //Filter
                //Pick One if not empty
                //$returnArray push ONE random thing in
                $temp = array();

                foreach($t3 as $key=>$value) {
                    array_push($temp, $key);
                }
                $thing = $temp[rand(0, count($t3)-1)];
                if (!in_array($thing, $returnArray)) {
                    array_push($returnArray, $thing);
                }
            } else if ($randT > 30 && count($t2) >= 1) {
                // var_dump('T2:<br />', $t2);
                //Filter
                //Pick One if not empty
                $temp = array();
                foreach($t2 as $key=>$value) {
                    array_push($temp, $key);
                }
                $thing = $temp[rand(0, count($t2)-1)];
                if (!in_array($thing, $returnArray)) {
                    array_push($returnArray, $thing);
                }
            } else {
                if (count($t1) >= 1) {
                    // var_dump('T1:<br />', $t1);
                    //Filter
                    //Pick One if not empty
                    $temp = array();
                    foreach($t1 as $key=>$value) {
                        array_push($temp, $key);
                    }
                    $thing = $temp[rand(0, count($t1)-1)];
                    if (!in_array($thing, $returnArray)) {
                        array_push($returnArray, $thing);
                    }
                }
            }
        }

        echo json_encode(array('suggestions'=>$returnArray));
        // var_dump($returnArray);
        // echo "==========================================<br />";
        // echo "============ T1 =============<br />";
        // var_dump($t1);
        // echo "==========================================<br />";
        // echo "============ T2 =============<br />";
        // var_dump($t2);
        // echo "==========================================<br />";
        // echo "============ T3 =============<br />";
        // var_dump($t3);
        //
        // echo "==========================================<br />";
        // echo "============ ACTIVITIES ARRAY =============<br />";
        // var_dump($activitiesArray);
        // echo "==========================================<br />";
        // var_dump($arr);
        // echo "______________________________________________________________<br />";
        // var_dump($userTags);
    }
}
?>
