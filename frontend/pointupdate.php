<?php
  $data = array("type"=>"release_exam");
//$data = array('username'=>$username,'exam_id'=>$exam_id,'question_id'=>$question_id_array,'original_student_code_array'=>$original_student_code_array,'student_code'=>$student_code_array,'test_case_1_answer'=>$test_case_1_answer_array,'test_case_2_answer'=>$test_case_2_answer_array,'test_case_3_answer'=>$test_case_3_answer_array,'test_case_4_answer'=>$test_case_4_answer_array,'test_case_5_answer'=>$test_case_5_answer_array,'question_points'=>$question_points_array,'reduction_function'=>$reduction_function_array,'reduction_statement'=>$reduction_statement_array,'student_function'=>$student_function_array,'student_statement'=>$student_statement_array,'test_case_1'=>$test_case_1_array,'test_case_2'=>$test_case_2_array,'test_case_3'=>$test_case_3_array,'test_case_4'=>$test_case_4_array,'test_case_5'=>$test_case_5_array,'problem'=>$problem_array,'question_grade'=>$question_grade_array);
  $string = http_build_query($data);
  //$ch = curl_init("https://web.njit.edu/~uk27/middle.php");
  $ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);

  $test = json_decode($answer, true);
  //echo $test['problem'][3];
  //print_r($test);


$array = array_values($_POST);
// $len = count($array);
// $question_id = array_slice($array, 0, $len / 2);
// $points = array_slice($array, $len / 2);
$points = array_slice($array, 0, 4);
$comments_array= array_slice($array, 4, 1);
$comments=$comments_array[0];
//print_r($id);
//print_r($points);
//print_r($comments);
$username="student";


$exam_id=$test['exam_id'];
echo $exam_id;
  $data = array('type'=>'points_update','username'=>$username,'exam_id'=>$exam_id,'question_grade'=>$points,'comments'=>$comments);
  $string = http_build_query($data);
  $ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);
  $test = json_decode($answer, true);
  //print_r($data);
//echo $answer;
  echo "Question Points are Updated"
// ?>
