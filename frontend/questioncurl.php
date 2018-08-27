<?php
$problem = urldecode($_POST['problem']);
//$pdata = $_POST;
//print_r($pdata);
echo $problem;
$difficulty = $_POST['difficulty'];
$points  = $_POST['points'];
$topic = $_POST['topic'];
$testcase1 = $_POST['testcase1'];
$testcase2 = $_POST['testcase2'];
$testcase3 = $_POST['testcase3'];
$testcase4 = $_POST['testcase4'];
$testcase5 = $_POST['testcase5'];
  $data = array ('type'=>'create_questions', 'problem'=>$problem, 'difficulty'=>$difficulty, 'points'=>$points, 'topic'=>$topic, 'test_case_1'=>$testcase1,'test_case_2'=>$testcase2,'test_case_3'=>$testcase3,'test_case_4'=>$testcase4,'test_case_5'=>$testcase5);
  $string = http_build_query($data);
  $ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);
  $test = json_decode($answer, true);
  //print_r($test);
  //echo $answer;
  echo "SENT :)"
?>
