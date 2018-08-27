<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link href="https://fonts.googleapis.com/css?family=Bellefair|Dancing+Script|Inconsolata|Open+Sans|Zilla+Slab" rel="stylesheet"> -->
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css"> -->
<head>
<h3> Avaliable Exams</h3>
<style>


body {
  color: #666;
  font: 14px/24px "Open Sans", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", Sans-Serif;
}
table {
  border-collapse: separate;
  border-spacing: 0;
  width: 100%;
}
th,
td {
  padding: 6px 15px;
}
th {
  background: #42444e;
  color: #fff;
  text-align: left;
}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>

<table class="highlight bordered ">
  <thead>
    <tr>
      <th>EXAM ID</th>
      <th>LENGTH</th>
      <th>SUBMISSION</th>
      <th></th>
    </tr>
  </thead>

  <tbody>
      <td>First Quiz</td>
      <td>30 Minutes</td>
      <!-- <td><i class="material-icons">check</i></td> -->
      <td><button class="btn" id="myBtn">Solve now</button></td>
    </tr>
  </tbody>
</table>
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Once you open this Exam, you have 30 minutes to do it. Press anywhere else to return, but click the button when you are ready.<br>
    <center>  <button onclick="location.href = 'takeexam.php';" id="myButton" class="float-left submit-button" >Take Exam</button></center>

    </p>
  </div>

</div>

<script>
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
