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
<head>
<script type="text/javascript" src="script.js"></script>
</head>
<?php include 'theader.php';?>
<link rel="stylesheet" type="text/css" href="makeexamnew.css" />
<div class="container">
  <!-- <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);"> -->
  <div class="flex-item">
      <h6>Question Table</h6>
      <input type="text" id="search" placeholder="Type to search with regex">
      <table id="myTable">
        <tbody>
        <!-- <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);"> -->
        <thead>
          <th style="width:20%;">Question<br>ID</th>
          <th style="width:20%;">Question</th>
          <th style="width:20%;">Difficulty</th>
          <th style="width:20%;">Topic</th>
          <th style="width:20%;">Points</th>
        </thead>
            <?php
              $x=0;
              $y=0;
              while($y<sizeof($test['id'])){
                echo "<tr>";
                  echo "<td>".$test['id'][$x]."</td>";
                  echo "<td>".$test['problem'][$x]."</td>";
                  echo "<td>".$test['difficulty'][$x]."</td>";
                  echo "<td>".$test['topic'][$x]."</td>";
                  echo "<td><input type='textarea' class='points' name='points[]' id='points$x'></textarea>";
                  //echo "<input type='checkbox' name='check[]' id='Checkbox$x' value='".$test['id'][$x]."></td>";
                  echo "<input type='checkbox' name='check[]' class='checkbox' id='Checkbox$x' value='".$test['id'][$x]."'></td>";
                  $x++;
                echo "</tr>";
                $y++;
              }
            ?>
      </tbody>
      </table>
</div>
<div class="fixed">
  <h6>Exam Table</h6>
  <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);">
  <table id="myTable1">
    <tbody>
    <thead>
      <th style="width:20%;">Question<br>ID</th>
      <th style="width:20%;">Question</th>
      <th style="width:20%;">Difficulty</th>
      <th style="width:20%;">Topic</th>
      <th style="width:20%;">Points</th>
    </thead>
    </tbody>
  </table>

</div>
  <!-- </form> -->
</div>
  <button type="submit" name="exambutton" formmethod="post">Submit Exam</button>
  </form>
<button type="button" name="deletebutton" onclick="delete()" style="float: right;">Delete questions</button>
<div id="test2">TEST</div>

<script>

function formplz(){
  $(function(){
          $("#myform").submit(function(event){
              event.preventDefault();
              $.ajax({
                      url:'maketest.php',
                      type:'POST',
                      data:$(this).serialize(),
                      success:function(result){
                          $("#response").text(result);

                      }

              });
          });
      });

}
// function submitForm(oFormElement)
// {
//   $(document).ready(function() {
//   var xhr = new XMLHttpRequest();
//   xhr.onload = function(){ document.getElementById("test2").innerHTML=this.responseText; } // success case
//   xhr.onerror = function(){   document.getElementById("test2").innerHTML=this.responseText; } // failure case
//   xhr.open (oFormElement.method, oFormElement.action, true);
//   xhr.send (new FormData (oFormElement));
//   return false;
//   });
// }

  // function myFunction() {
  //       // Declare variables
  //       var input, filter, table, tr, td, i, occurrence;
  //
  //       input = document.getElementById("myInput");
  //       filter = input.value.toUpperCase();
  //       table = document.getElementById("myTable");
  //       tr = table.getElementsByTagName("tr");
  //
  //       // Loop through all table rows, and hide those who don't match the search query
  //      for (i = 0; i < tr.length; i++) {
  //          occurrence = false; // Only reset to false once per row.
  //          td = tr[i].getElementsByTagName("td");
  //          for(var j=0; j< td.length; j++){
  //              currentTd = td[j];
  //              if (currentTd ) {
  //                  if (currentTd.innerHTML.toUpperCase().indexOf(filter) > -1) {
  //                      tr[i].style.display = "";
  //                      occurrence = true;
  //                  }
  //              }
  //          }
  //          if(!occurrence){
  //              tr[i].style.display = "none";
  //          }
  //      }
  //    }

</script>
<script>

var $checkbox, $row;
//jquery to move tables
$('body')
  .on('click','#mytable input.checkbox', function(){
    $checkbox = $(this);
    $row = $checkbox.closest('tr');

    if( $checkbox.is(':checked')){
      $('#myTable1 tbody').append($row);
    }
    else {
    	$('#myTable tbody').append($row);
    }
  })
;
//});


var $rows = $('#myTable tr');
$('#search').keyup(function() {
  var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase().split(' ');

  $rows.hide().filter(function() {
    var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
    var matchesSearch = true;
    $(val).each(function(index, value) {
      matchesSearch = (!matchesSearch) ? false : ~text.indexOf(value);
    });
    return matchesSearch;
  }).show();
});

</script>
