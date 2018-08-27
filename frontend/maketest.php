<?php //echo $_POST["name"];
$data = array("type"=>"exam_questions");
//$data = array("type"=>"exam_questions");
$string = http_build_query($data);
//$ch = curl_init("https://web.njit.edu/~uk27/middle.php");
$ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$answer = curl_exec($ch);
curl_close($ch);

$test = json_decode($answer, true);

$flag=1;
$points=$_POST['points'];
// print_r($points);
$checkbox=$_POST['check'];

// $array = ['a', 'b', 'c'];
// $key = array_search('c', $array); //$key = 0
// echo "key:".$key;

if(empty($checkbox)){
echo "Please choose at least 1 question for exam";
$flag=0;
}

for($x=0;$x<sizeof($checkbox);$x++){
  $index = array_search("$checkbox[$x]", $test['id']);
  //echo " index:".$index." ";


  if(!empty($points[$index])){
    continue;
    // echo"good";
  }
  else{
    echo "One or more questions did not have points associated with it. Please make sure all questions have points.";
    $flag=0;
    break;
  }
}





//print_r($checkbox);
//print_r($checkbox);if(isset($_POST['exambutton'])){
//print_r($points);
//var_dump($_POST);
$id_string=array();
$points_string=array();


  for($i=0;$i<sizeof($checkbox);$i++){
    $id_string[]=$checkbox[$i];
    $points_string[]=$points[array_search($checkbox[$i],$test['id'])];

  //print_r($points_string);

    //echo $points_string;
  }
  //print_r($id_string);
  $string = rtrim(implode(',', $id_string), ',');
  //print_r($points_string);

if($flag==1){
$data = array("type"=>"exam_created", "id"=>$id_string, "question_points"=>$points_string);
$string = http_build_query($data);
$ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$answer = curl_exec($ch);
curl_close($ch);
$test = json_decode($answer, true);
echo "Your questions have been submitted to the database";
//echo $string;

}

?>
