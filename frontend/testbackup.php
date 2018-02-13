 <?php
       $username = $_POST['username'];
        $password = $_POST['password'];
        //$response= $_POST['random'];
        //$post =json_decode(file_get_contents("php://input"),true);
        
        //echo 'ECHO'.$post;
        //echo 'ECHO'.$username;
        //echo 'ECHO'.$pass;
        
     if(isset($_POST['username'] ,$_POST['password'])){   
        
        $data = array("username"=>$username, "password"=>$password);
        $string = http_build_query($data);
        
        //change this link to usman's middle
        $ch = curl_init("https://web.njit.edu/~rl265/php/middle_end.php");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
        
        
     }
     if(isset($_POST['random'])){   
        
        echo 'MADE INSIDE RESPONSE';
     }
?>
 