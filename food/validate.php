<?php
        session_start();
        $servername='localhost:3307';
        $username='root';
        $pass='root';
        $db='food';
        $conn = new mysqli($servername,$username,$pass,$db);

        // Check connection
        if ($conn -> connect_errno) {
          echo "Failed to connect to MySQL: " . $conn -> connect_error;
        }
        
        $Upass=$_POST['pwd'];
        $Umail=$_POST['mail'];
        
        $sql=$conn->prepare('Select * from userInfo where email=? and password=?');
        $sql->bind_param('ss',$Umail,$Upass);
        $sql->execute();

        $result = $sql->get_result();
        $stmt = $result->fetch_assoc();
        if($stmt){
            $_SESSION['uname']=$stmt['username'];
            $_SESSION['islogged']=true;
            $s=$stmt['plan'];
            $_SESSION['plan']=$s;
        
            if($s=='no pack')header("location:http://localhost/food/notpaid.php");
            if($s=='starter')header("location:http://localhost/food/paidstarter.php");
            if($s=='complete')header("location:http://localhost/food/paidpremium.php");
        
        }
        else{
            // echo"<p style='color:yellow;'>Enter valid Details</p>";
            header("location:http://localhost/food/index.php");
        }
    ?>