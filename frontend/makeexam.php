<?php
//$delete_question_id=null;
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
//echo $test['problem'][3];
//print_r($test);
//echo $answer;
?>

<?php include 'theader.php';?>
<link rel="stylesheet" type="text/css" href="style.css" />
<div class="container">

  <div class="fixed">
    <form>
      <div class="leftcolumn">
        <h3 align="center" >Question Creation Form</h3>

        <textarea class="form-control flat" id="problem" rows="3" placeholder="Enter Question Body..."></textarea>
        <br><textarea class="form-control flat" id="topic" rows="3" placeholder="Topic"></textarea>
        <br><textarea class="form-control flat" id="testcase1" rows="3" placeholder="Enter Test Case 1..."></textarea>

        <div id="tc2"><textarea class="form-control flat" id="testcase2" rows="3" placeholder="Enter Test Case 2..."></textarea>
         <!-- <button type="button" onclick="tc2()">Add Test Case 2</button> -->

       <textarea class="form-control flat" id="testcase3" rows="3" placeholder="Enter Test Case 3..."></textarea>
        <!--<button type="button" onclick="tc3(2)">Add Test Case 3</button> -->

        <textarea class="form-control flat" id="testcase4" rows="3" placeholder="Enter Test Case 4..."></textarea>

          <!-- <button type="button" onclick="tc4(2)">Add Test Case 4</button>-->

        <textarea class="form-control flat" id="testcase5" rows="3" placeholder="Enter Test Case 5..."></textarea> </div>
        <button type="button" onclick="tc2()">Add/Show Test Cases</button>
        <!--   <button type="button" onclick="tc5(2)">Add Test Case 5</button> -->
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
        <button type="button" onclick="send1()">Add question</button>
        <div id="test1"></div>

      </div> <!-- /container -->
      <div id="test"></div>
    </form>
    <script>

    function tc2()
{
  var x = document.getElementById('tc2');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
/*
function tc3(a)
{
if(a==1)
document.getElementById("testcase3").style.display="none";
else
document.getElementById("tc3").style.display="block";
}
function tc4(a)
{
if(a==1)
document.getElementById("testcase4").style.display="none";
else
document.getElementById("testcase4").style.display="block";
}
function tc5(a)
{
if(a==1)
document.getElementById("testcase5").style.display="none";
else
document.getElementById("testcase5").style.display="block";
}
*/
    function send1()
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
          window.location=window.location;
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
    );
    //sends post after clicking the button
    //location.reload();
    //parent.document.getElementById("flex-item").reload();\
    //setTimeout(function () {

  }

  </script>
</div>
<div class="flex-item">
<form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);">
  <table id="myTable">
    <tr class="header">
      <th style="width:20%;">Question<br>ID</th>
      <th style="width:20%;">Question</th>
      <th style="width:20%;">Difficulty</th>
      <th style="width:20%;">Topic</th>
      <!-- <th style="width:20%;">Points</th> -->
    </tr>
    <tr>



        <?php
          $x=0;
          $y=0;
          while($y<sizeof($test['id'])){
            echo "<tr>";
              echo "<td>".$test['id'][$x]."</td>";
              echo "<td>".$test['problem'][$x]."</td>";
              echo "<td>".$test['difficulty'][$x]."</td>";
              echo "<td>".$test['topic'][$x]."</td>";
              // echo "<td><input type='textarea' name='points[]' id='points$x'></textarea>";
              // //echo "<input type='checkbox' name='check[]' id='Checkbox$x' value='".$test['id'][$x]."></td>";
              // echo "<input type='checkbox' name='check[]' id='Checkbox$x' value='".$test['id'][$x]."'></td>";
              $x++;
            echo "</tr>";
            $y++;
          }
        ?>

  </table>
  <!--<button type="button" onclick="send()">Submit exam</button>-->
    <button type="button" name="deletebutton" onclick="delete()" style="float: right;">Delete questions</button>
    <!-- <button type="submit" name="exambutton" formmethod="post">Submit Exam</button>
    <div id="test2"></div> -->


</div>

</div>
</form>

<script>

function submitForm(oFormElement)
{
  var xhr = new XMLHttpRequest();
  xhr.onload = function(){ document.getElementById("test2").innerHTML=this.responseText; } // success case
  xhr.onerror = function(){   document.getElementById("test2").innerHTML=this.responseText; } // failure case
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
  return false;
}

function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function difficult() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput1");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
function topic() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
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
      //window.alert("Questions Sent to Exam bank"); //make sure php file this gets sent to echoes "EXAM SUBMITTED"
    }
  }
  xhttp.open("POST","https://web.njit.edu/~aem39/beta/makexamcurl.php",true); //ANYTHING HERE WILL BE ECHO'd

  //I could use multipart/form-data here but since it is not a lot of stuff tos end, urlencoded is fine
  xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  if( document.getElementById('Checkbox1').checked){
    var q1 = document.getElementById("Checkbox1").value;}
    else{
      q1=null;
    }
    if( document.getElementById('Checkbox2').checked){
      var q2 = document.getElementById("Checkbox2").value;}
      else{
        q2=null;
      }
      if( document.getElementById('Checkbox3').checked){
        var q3 = document.getElementById("Checkbox3").value;}
        else{
          q3=null;
        }
        if( document.getElementById('Checkbox4').checked){
          var q4 = document.getElementById("Checkbox4").value;}
          else{
            q4=null;
          }
          if( document.getElementById('Checkbox5').checked){
            var q5 = document.getElementById("Checkbox5").value;}
            else{
              q5=null;
            }
            if( document.getElementById('Checkbox6').checked){
              var q6 = document.getElementById("Checkbox6").value;}
              else{
                q6=null;
              }
              if( document.getElementById('Checkbox7').checked){
                var q7 = document.getElementById("Checkbox7").value;}
                else{
                  q7=null;
                }
                if( document.getElementById('Checkbox8').checked){
                  var q8 = document.getElementById("Checkbox8").value;}
                  else{
                    q8=null;
                  }
                  if( document.getElementById('Checkbox9').checked){
                    var q9 = document.getElementById("Checkbox9").value;}
                    else{
                      q9=null;
                    }
                    if( document.getElementById('Checkbox10').checked){
                      var q10 = document.getElementById("Checkbox10").value;}
                      else{
                        q10=null;
                      }
                      if( document.getElementById('Checkbox11').checked){
                        var q11 = document.getElementById("Checkbox11").value;}
                        else{
                          q11=null;
                        }
                        if( document.getElementById('Checkbox12').checked){
                          var q12 = document.getElementById("Checkbox12").value;}
                          else{
                            q12=null;
                          }
                          if( document.getElementById('Checkbox13').checked){
                            var q13 = document.getElementById("Checkbox13").value;}
                            else{
                              q13=null;
                            }
                            if( document.getElementById('Checkbox14').checked){
                              var q14 = document.getElementById("Checkbox14").value;}
                              else{
                                q14=null;
                              }
                              if( document.getElementById('Checkbox15').checked){
                                var q15 = document.getElementById("Checkbox15").value;}
                                else{
                                  q15=null;
                                }
                                if( document.getElementById('Checkbox16').checked){
                                  var q16 = document.getElementById("Checkbox16").value;}
                                  else{
                                    q16=null;
                                  }
                                  if( document.getElementById('Checkbox17').checked){
                                    var q17 = document.getElementById("Checkbox17").value;}
                                    else{
                                      q17=null;
                                    }
                                    if( document.getElementById('Checkbox18').checked){
                                      var q18 = document.getElementById("Checkbox18").value;}
                                      else{
                                        q18=null;
                                      }
                                      if( document.getElementById('Checkbox19').checked){
                                        var q19 = document.getElementById("Checkbox19").value;}
                                        else{
                                          q19=null;
                                        }
                                        //var q1 = document.getElementById('Checkbox1').value;
                                        //var q2 = document.getElementById('Checkbox2').value;
                                        //var q3 = document.getElementById('Checkbox3').value;
                                        //var q4 = document.getElementById('Checkbox4').value;
                                        //var q5 = document.getElementById('Checkbox5').value;
                                        //var q6 = document.getElementById('Checkbox6').value;
                                        xhttp.send("q1="+encodeURIComponent(q1)
                                        +"&q2="+encodeURIComponent(q2)
                                        +"&q3="+encodeURIComponent(q3)
                                        +"&q4="+encodeURIComponent(q4)
                                        +"&q5="+encodeURIComponent(q5)
                                        +"&q6="+encodeURIComponent(q6)
                                        +"&q7="+encodeURIComponent(q7)
                                        +"&q8="+encodeURIComponent(q8)
                                        +"&q9="+encodeURIComponent(q9)
                                        +"&q10="+encodeURIComponent(q10)
                                        +"&q11="+encodeURIComponent(q11)
                                        +"&q12="+encodeURIComponent(q12)
                                        +"&q13="+encodeURIComponent(q13)
                                        +"&q14="+encodeURIComponent(q14)
                                        +"&q15="+encodeURIComponent(q15)
                                        +"&q16="+encodeURIComponent(q16)
                                        +"&q17="+encodeURIComponent(q17)
                                        +"&q18="+encodeURIComponent(q18)
                                        +"&q19="+encodeURIComponent(q19)

                                      );

                                      //sends post after clicking the button
                                    }//sends post after clicking the button

                                                                    </script>
