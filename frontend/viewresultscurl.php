<?php

  $data = array ("type"=>"view_results");
  $string = http_build_query($data);
  $ch = curl_init("https://web.njit.edu/~rl265/php/backend.php");
  //$ch = curl_init("https://web.njit.edu/~uk27/middle.php");
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $answer = curl_exec($ch);
  curl_close($ch);

  $test = json_decode($answer, true);

   if($test['viewable']){
     header("Location: https://web.njit.edu/~kon2/student_view_grades.html"); /* Redirect browser */
exit();
   }
