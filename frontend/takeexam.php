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

  //echo $test['problem'][3];
  //print_r($test);
  //echo $test['problem'][0];
?>

<!-- <meta charset="utf-8" /> -->
 <link rel="stylesheet" href="input.css">
 <!-- <center><div style="background-color:aliceblue;color:slategray;font-size:20px;text-align:center;">Time left = <span id="timer"></div></center> -->
 <div class="left">
 <?php for($x=0; $x<sizeof($test['problem']); $x++){
   $y=$x+1?>

     <textarea name="textarea">Q<?php  echo $y; ?> scrapwork</textarea><br>
 <?php } ?>
  </div>

<div class="container">
<center><h1>Student Exam</h1></center>

<?php for($x=0; $x<sizeof($test['problem']); $x++){
  $y=$x+1?>
<div class="questionPane" id=<?php echo $y; ?>>

  <p id="question"><font color=#4499cc>Q<?php  echo $y; ?>:</font><?php echo $test['problem'][$x]; ?> </p>
  <textarea name="answer<?php  echo $y; ?>" style="width:90%;height:70%;resize: none;display: inline-block; vertical-align:bottom" input type="text" id="answer<?php echo $y; ?>" placeholder="Question"></textarea>
<div class="id<?php echo $x; ?>">
Points:<?php echo $test['points'][$x]; ?>
   </div>
  <!-- -<button onclick="Question()" class="checkbtn">?</button> -->

<p id="answerPane<?php echo $y;  ?>"></p>
</div>
<?php } ?>



</div>
</div>
<center><button type="button" onclick="send()">Submit exam</button></center>



<div id="test"></div>
<script>

// function timeout(){
// myVar = setTimeout(codeAddress, 1000);
// }
  // if(document.getElementById("question") === " "){       //supposed to hide div when empty, not show test
  //   document.getElementById("2").style.display="none";
  // }
  // if(document.getElementById("question") === " "){
  //   document.getElementById("2").style.display="none";
  // }


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
    document.getElementById("test").innerHTML=this.responseText; //make sure php file this gets sent to echoes "EXAM SUBMITTED"
    }
  }
xhttp.open("POST","https://web.njit.edu/~aem39/beta/submit.php",true); //ANYTHING HERE WILL BE ECHO'd

xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");


if(document.getElementById("answer1")){
var ans1= document.getElementById("answer1").value;}
else{
ans1="";}
if(document.getElementById("answer2")){
var ans2= document.getElementById("answer2").value;}
else{
ans2="";}
if(document.getElementById("answer3")){
var ans3= document.getElementById("answer3").value;}
else{
ans3="";}
if(document.getElementById("answer4")){
var ans4= document.getElementById("answer4").value;}
else{
ans4="";}

// var ans1 = document.getElementById("answer1").value;
// var ans2 = document.getElementById("answer2").value;
// var ans3 = document.getElementById("answer3").value;
// var ans4 = document.getElementById("answer4").value;
//var ans4 = document.getElementById("answer4").value;







xhttp.send("&answer1="+encodeURIComponent(ans1)
+"&answer2="+encodeURIComponent(ans2)
+"&answer3="+encodeURIComponent(ans3)
+"&answer4="+encodeURIComponent(ans4)


);

document.write("Exam Complete, You will be redirected in 3 seconds to your homepage");
setTimeout('Redirect()', 3000);


}
function Redirect()
{
window.location="student.php";
}

var textareas = document.getElementsByTagName('textarea');
var count = textareas.length;
for(var i=0;i<count;i++){
    textareas[i].onkeydown = function(e){
        if(e.keyCode==9 || e.which==9){
            e.preventDefault();
            var s = this.selectionStart;
            this.value = this.value.substring(0,this.selectionStart) + "\t" + this.value.substring(this.selectionEnd);
            this.selectionEnd = s+1;
        }
    }
}
      </script>
