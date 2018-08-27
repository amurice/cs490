<!doctype html>
<html>

<body>
  <?php include 'sheader.php';?>
<div class="container">
  <!-- Header -->

<style>
/* decided to use keyframes to test out front page*/

/*trying to make a keyframe that will fade out and leave a nice afteraffect after done glowing, this will take me a long time to finalize but I wanted to put it in the RC to get credit for it in the RV*/

@keyframes glowing {
  0% {text-shadow:0 0 .1em, 0 0 .1em; from {color:black;}
    to {color: aliceblue;}}
  25% {text-shadow:0 0 .1em, 0 0 .2em;}
  50% {text-shadow:0 0 .2em, 0 0 .1em;}
  75%{text-shadow: 0 0 .2em, 0 0 .2em;}
  100%{text-shadow:0 0 .1em, 0 0 .1em;
  from {color:white;}
    to {color: #5383d3;}
  }
}
@-webkit-keyframes glowing {

  0% {text-shadow:0 0 .1em, 0 0 .1em;}
  25% {text-shadow:0 0 .1em, 0 0 .2em;}
  50% {text-shadow:0 0 .12em, 0 0 .1em;}
  75%{text-shadow: 0 0 .2em, 0 0 .2em;}
  100%{text-shadow:0 0 .1em, 0 0 .1em;}
}
body{background:'offwhite';text-align:center;}
h1{font-size:4em;color:#5383d3;animation: glowing 3s}
h4{font-size:2em;color:#ffFFFF;animation: glowing 2s infinite;}

p{color:white;}
</style>
<h1>Welcome To CodingQuiz!</h1>
<h4>Student Homepage </h4>
</html>

</div>
<!-- Main Container Ends -->
</body>
</html>
