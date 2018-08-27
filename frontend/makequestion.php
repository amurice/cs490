<?php include 'theader.php';?>

<body>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
button .out {
    width: 60px;
}
</style>
<form action="questioncurl.php" method="POST">
    <div class="container">
            <h3 align="center" >Question Creation Form</h3>

            <textarea class="form-control flat" id="problem" rows="3" placeholder="Enter Question Body..."></textarea>
            <br><textarea class="form-control flat" id="topic" rows="3" placeholder="Topic"></textarea>
            <br><textarea class="form-control flat" id="testcase1" rows="3" placeholder="Enter Test Case 1..."></textarea>
			      <textarea class="form-control flat" id="testcase2" rows="3" placeholder="Enter Test Case 2..."></textarea>
			      <textarea class="form-control flat" id="testcase3" rows="3" placeholder="Enter Test Case 3..."></textarea>
            <textarea class="form-control flat" id="testcase4" rows="3" placeholder="Enter Test Case 4..."></textarea>
            <textarea class="form-control flat" id="testcase5" rows="3" placeholder="Enter Test Case 5..."></textarea>
         <textarea class="form-control flat" id="points" rows="3" placeholder="Assign points.."></textarea>

          <!-- /container  <h4>Question type?</h4>

            <input type="radio" id="question_type" name="question_type" value="tandf"> True Or False<br>
            <input type="radio" id="question_type1" name="question_type" value="choice"> Multiple Choice<br>
            <input type="radio" id="question_type2" name="question_type" value="openended"> Open Ended  <br>
            <!-- /container -->
           <h4>What is the Question Difficulty?<h4>
            <input type="radio" id="difficulty" name="difficulty" value="easy"> Easy<br>
            <input type="radio" id="difficulty1" name="difficulty" value="medium"> Medium<br>
            <input type="radio" id="difficulty2" name="difficulty" value="hard"> Hard
          </p>
          <button type="button" onclick="send()">Add question</button>
          <div id="test">Work</div>

</div> <!-- /container -->
 <div id="test"></div>
 </form>
<script>
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
xhttp.open("POST","https://web.njit.edu/~aem39/beta/questioncurl.php",true); //ANYTHING HERE WILL BE ECHO'd
xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

if( document.getElementById('difficulty').checked){
    var difficulty = document.getElementById("difficulty").value;}
    else if( document.getElementById('difficulty1').checked){
    var difficulty = document.getElementById("difficulty1").value;}
    else if( document.getElementById('difficulty2').checked){
    var difficulty = document.getElementById("difficulty2").value;
    }
    else{
    var difficulty = null;
    }
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
var problem= document.getElementById('problem').value;
var topic= document.getElementById('topic').value;
var points = document.getElementById('points').value;
var testcase1 = document.getElementById('testcase1').value;
var testcase2 = document.getElementById('testcase2').value;
var testcase3 = document.getElementById('testcase3').value;
var testcase4 = document.getElementById('testcase4').value;
var testcase5 = document.getElementById('testcase5').value;
xhttp.send("topic=" + encodeURIComponent(topic)
	+ "&difficulty=" + encodeURIComponent(difficulty)
	+ "&problem=" +encodeURIComponent(problem)
	+ "&testcase1=" +encodeURIComponent(testcase1)
	+ "&testcase2=" +encodeURIComponent(testcase2)
	+ "&testcase3=" +encodeURIComponent(testcase3)
	+ "&testcase4=" +encodeURIComponent(testcase4)
	+ "&testcase5=" +encodeURIComponent(testcase5)
	+ "&points=" +encodeURIComponent(points));
//sends post after clicking the button
}
</script>
