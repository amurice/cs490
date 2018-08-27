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
?>

<head>
<script type="text/javascript" src="script.js"></script>
<script>
$(function(){
        $( "#myform" ).submit(function( event ) {
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

        $("myforum input[type=submit]").live("click", function() {
                   $("myform").submit();
             });
       });


</script>
</head>
<body>
<?php include 'theader.php';?>
<link rel="stylesheet" type="text/css" href="makeexamnew.css" />
<div class="container">
  <!-- <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);"> -->
  <div class="flex-item">
      <h6>Exam Table</h6>
      <input type="text" id="search" placeholder="Type to search with regex (i.e. Math easy )">
      <button id="hide">Show Checked Questions</button>
      <button id="unhide">Show All Questions</button>
      <table id="myTable">
        <!-- <tbody> -->
        <!-- <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);"> -->
        <form id="myform">
        <tr class="header">
          <th style="width:20%;">Question<br>ID</th>
          <th style="width:20%;">Question</th>
          <th style="width:20%;">Difficulty</th>
          <th style="width:20%;">Topic</th>
          <th style="width:20%;">Points</th>
        </tr>
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
      <button type="submit">Submit</button>
      </form>
</div>
</div>
<!-- <form id=myform> -->
<!-- <form method="POST" name="check" action="maketest.php" onsubmit="return submitForm(this);"> -->
<!--<div class="fixed"></div>-->
  <!--

                <table id="two">
                  <h6>Exam Table</h6>
                  <tr class="header">
                    <th style="width:20%;">Question<br>ID</th>
                    <th style="width:20%;">Question</th>
                    <th style="width:20%;">Difficulty</th>
                    <th style="width:20%;">Topic</th>
                    <th style="width:20%;">Points</th>
                  </tr>
                </table>
                <!-- <button type="submit">Submit</button>
                </form> -->

</div>
  <!-- <button type="submit" name="exambutton" formmethod="post">Submit Exam</button> -->


<!-- <div id="test2">TEST</div> -->
<div id="response"></div>
</body>
<script>
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
</script>
<script>

// $('body').on('click','#myTable tbody tr td input.checkbox', function(){
//     if( $(this).attr('checked')){
//     var row = $(this).closest('tr').clone();
//      $('#myTable1 tbody').append(row);
//          $(this).closest('tr').remove();
//     }
//
// });
// $('body').on('click','#myTable1 tbody tr td input.checkbox', function(){
//
//     var row = $(this).closest('tr').clone();
//      $('#myTable tbody').append(row);
//          $(this).closest('tr').remove();
//
// });
//SEARCH FUNCTION
$(document).ready(function() {
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
//END SEARCHf
$('body').on('click','#hide',function() {
  $('#myTable').find('input:checkbox:not(:checked)').closest('tr').hide();
    //$("#myTable tr").has(".check-box:not(:checked)").hide();

});
$('body').on('click','#unhide',function() {
      $('#myTable').find('input:checkbox:not(:checked)').closest('tr').show();
});
});
</script>
