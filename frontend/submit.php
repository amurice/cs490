<?php
header('Content-Type: text/html; charset=utf-8');


$data = array("type"=>"student_exam");
$string = http_build_query($data);
$ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$answer = curl_exec($ch);
curl_close($ch);


$test = json_decode($answer, true);

//print_r($test);
$answers= array_values($_POST);





//print_r($test_case_1);
//print_r($test_case_2);
//print_r($test_case_3);
//print_r($test_case_4);
//print_r($test_case_5);
//print_r($question_points);
//print_r($id);
//print_r($answers); //split array into two, one for ids and one for answers

$username="student"; //USE INCLUDE.php CHANGE TO $username ASK REUVEN AND SHIEET

//$data = array('type'=>'student_answers','username'=>$username,'question_id'=>$id,'answers'=>$answers,'test_case_1'=>$test_case_1,'test_case_2'=>$test_case_2,'test_case_3'=>$test_case_3,'test_case_4'=>$test_case_4,'test_case_5'=>$test_case_5,'question_points'=>$question_points);
//$data = array('type'=>'student_answers','questions'=>$questions,'question_id'=>$id,'answers'=>$answers,'test_case_1'=>$test_case_1,'test_case_2'=>$test_case_2,'test_case_3'=>$test_case_3,'test_case_4'=>$test_case_4,'test_case_5'=>$test_case_5,'question_points'=>$question_points);


$data = array('type'=>'student_answers','username'=>$username,'question_id'=>$test['question_id'],'problem'=>$test['problem'],'answers'=>$answers,'test_case_1'=>$test['test_case_1'],'test_case_2'=>$test['test_case_2'],'test_case_3'=>$test['test_case_3'],'test_case_4'=>$test['test_case_4'],
'test_case_5'=>$test['test_case_5'],'question_points'=>$test['points']);

  $string = http_build_query($data);
  //$ch = curl_init("https://web.njit.edu/~uk27/middle.php");
  //$ch = curl_init("https://web.njit.edu/~rl265/php/python_test.php");
  //$ch = curl_init("https://web.njit.edu/~rl265/php/python_test.php");
  //$ch = curl_init("https://web.njit.edu/~uk27/python_test.php");
  $ch = curl_init("https://web.njit.edu/~rl265/php/python_test.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);
  $test = json_decode($answer, true);
  // print_r($data);
  //print_r($data);
//echo $answer;
echo "Questions sent for Grading";
// print_r($data);
//echo $answer;
?>
