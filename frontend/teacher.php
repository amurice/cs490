
<!---<link href="css/simpleGridTemplate.css" rel="stylesheet" type="text/css"> --->
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php include 'theader.php';?>
<style>
/* decided to use keyframes to test out front page*/

/*trying to make a keyframe that will fade out and leave a nice afteraffect after done glowing, this will take me a long time to finalize but I wanted to put it in the RC to get credit for it in the RV*/

@keyframes glowing {
  0% {text-shadow:0 0 .1em, 0 0 .1em; from {color:FireBrick;}
    to {color: FireBrick;}}
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
h1{font-size:4em;color:#FireBrick;animation: glowing 3s}
h4{font-size:2em;color:#ffFFFF;animation: glowing 2s infinite;}

p{color:white;}
</style>
<h1>Welcome To CodingQuiz!</h1>
<h4>Teacher Homepage </h4>

</body>
</html>

</div>
<!-- Main Container Ends -->
</body>
</html>
