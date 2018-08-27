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
 //  TO aDD TWO fUNCTIONS a and b, both ints, to get all points reuction

//DO DIS NAOO make sure to use loop for testong
// $column_names=array('Question_id',$test['problem'],$test['topic'],$test['difficulty'],$test['student_function'],$test['reduction_function'],$test['student_statement'],$test['reduction_statement'],$test['original_student_code_array'],$test['student_code'],$test['test_case_1'],$test['test_case_1_answer'],$test['question_points'],$test[''],$test['question_id'],$test['question_grade'],$test['question_id'])
  //echo $test['problem'][3];
  print_r($test);
?>
<style>
table {
  /* border-collapse: separate;


  width: 100%; */
  border-spacing: 0;
  text-align:center;
  vertical-align:middle;
  border: 1px solid aliceblue;
}
th {
  background: #42444e;
  color: #fff;
}
.textarea {
  /* box-sizing:border-box; */
 display:block;
 width:50%;
}
</style>
<?php include 'theader.php';?>
<h4>Exam ID is: <?php echo $test['exam_id']; ?></h4>
<h4><?php echo $test['username'];?>'s results</h4
  <form method="POST" name="check" action="pointupdate.php" onsubmit="return submitForm(this);">
  <table id="myTable">
    <tr class="header">
      <th style="width:5%;">Question ID</th>
      <th style="width:10%;">Problem</th>
      <th style="width:5%;">Difficulty</th>
      <th style="width:5%;">Topic</th>
      <th style="width:10%;">Student Method</th>
      <th style="width:3%;">Points Reduced for <br>Wrong Method</th>
      <th style="width:10%;">Student Closing Statement</th>
      <th style="width:3%;">Points Reduced for<br> Wrong Closing Statement:</th>
      <th style="width:10%;">Original Student Answer</th>
      <th style="width:20%;">Corrected Student Answer</th>
      <th style="width:30%;">Original Test Cases</th>
      <th style="width:25%;">Test Case Answers<br>0=Fail, 1=Pass</th>
      <th style="width:10%;">Max Points For Question</th>
      <th style="width:10%;">Total Points Reduced</th>
      <th style="width:10%;">Total Score</th>
      <th style="width:5%;">Update Points</th>
    </tr>

    <!-- table for column names -->
    <?php
  $x=0;
  $y=0;
  while($y<sizeof($test['question_id'])){
    echo "<tr>";
      echo "<td>".$test['question_id'][$x]."</td>";
      echo "<td>".$test['problem'][$x]."</td>";
      echo "<td>".$test['difficulty'][$x]."</td>";
      echo "<td>".$test['topic'][$x]."</td>";
      echo "<td>".$test['student_function'][$x]."</td>";
      echo "<td>".$test['reduction_function'][$x]."</td>";
      echo "<td>".$test['student_statement'][$x]."</td>";
      echo "<td>".$test['reduction_statement'][$x]."</td>";
      echo "<td>".$test['original_student_code_array'][$x]."</td>";
      echo "<td>".$test['student_code'][$x]."</td>";
      echo "<td>".$test['test_case_1'][$x]."<br>".$test['test_case_2'][$x]."<br>".$test['test_case_3'][$x]."<br>".$test['test_case_4'][$x]."<br>".$test['test_case_5'][$x]."</td>";
      echo "<td>".$test['test_case_1_answer'][$x]."<br>".$test['test_case_2_answer'][$x]."<br>".$test['test_case_3_answer'][$x]."<br>".$test['test_case_4_answer'][$x]."<br>".$test['test_case_5_answer'][$x]."</td>";
      echo "<td>".$test['question_points'][$x]."</td>";
      $total_reduction = $test['reduction_statement'][$x]+$test['reduction_function'][$x];
      echo "<td>".$total_reduction."</td>";
      echo "<td>".$test['question_grade'][$x]."</td>";
      echo "<td><input type='textarea' id='points$x'></td>";
      $x++;
    echo "</tr>";
    $y++;
  }
?>
  </table>

<center><textarea style="width:200px;height:auto;" input type="text" id="comments" placeholder="Add comments for the exam.."></textarea></center>
</form>
<button type="submit" name="exambutton" formmethod="post">Submit using POST</button>
<?php
?>

<center><button type="button" onclick="send()">Update Points</center></button>
<div id="test"></div>
<script>
function submitForm(oFormElement)
{
  var xhr = new XMLHttpRequest();
  xhr.onload = function(){ document.getElementById("test").innerHTML=this.responseText; } // success case
  xhr.onerror = function(){   document.getElementById("test").innerHTML=this.responseText; } // failure case
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
  return false;
}
function send()
{
var xhttp;
if (window.XMLHttpRequest)
  {
  // for newer browers
  xhttp=new XMLHttpRequest();
  }
else
  {
  // code for njit machines
  xhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xhttp.onreadystatechange=function()
//readyState: 4: request finished and response is ready, status: 200: "OK"  and When readyState is 4 and status is 200, the response is ready:
  {
  if (this.readyState==4 && this.status==200)
    {
    document.getElementById("test").innerHTML=this.responseText;
    }
  }
xhttp.open("POST","https://web.njit.edu/~aem39/beta/pointupdate.php",true); //ANYTHING HERE WILL BE ECHO'd
xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

/*if( document.getElementById('question_type').checked){
    var question_type = document.getElementById("question_type").value;}
    else if( document.getElementById('question_type1').checked){
    var question_type = document.getElementById("question_type1").value;}
    else if( document.getElementById('question_type2').checked){
    var question_type= document.getElementById("question_type2").value;
    }
    else{
    var question_type = null;
    }
*/
var points0 = document.getElementById("points0").value;
if(document.getElementById("points1")){
var points1= document.getElementById("points1").value;}
else{
points1="";}
if(document.getElementById("points2")){
var points2= document.getElementById("points2").value;}
else{
points2="";}
if(document.getElementById("points3")){
var points3= document.getElementById("points3").value;}
else{
points3="";}
var comments = document.getElementById("comments").value;


xhttp.send("&points0="+encodeURIComponent(points0)
+"&points1="+encodeURIComponent(points1)
+"&points2="+encodeURIComponent(points2)
+"&points3="+encodeURIComponent(points3)
+"&comments="+encodeURIComponent(comments)
);
}
</script>
