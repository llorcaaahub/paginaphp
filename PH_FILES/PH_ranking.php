<?php 
    include_once("../lib/devicedetector.php");
    if(isMobileDevice()){
        if(isset($_COOKIE['PHPSESSID'])){
            session_start();
            if(isset($_SESSION['usuari'])){
                    
            }
        }
    }else if(!isMobileDevice()){
        header("Location:../PC_FILES/PC_index.php");
    }

    require_once('../ConexionDB/conexionBD.php');

    $countpersones = "SELECT COUNT(*) AS cantitat FROM puntuacio;";
    $countpersones3 = $db->prepare($countpersones);
    $countpersones3->execute();
    $cantitatpersones2 = $countpersones3->fetch(PDO::FETCH_ASSOC);
    $numeropersones = (int)$cantitatpersones2['cantitat'];

    $select = "SELECT nom_user, puntuacio FROM puntuacio ORDER BY 2 DESC, 2;";
    $ranking2 = $db->prepare($select);
    $ranking2->execute();
    
    

?>

<!DOCTYPE html>
<html>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<head>
	<title>Eduhack - Home</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="./PH_css/PH_ranking.css">
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <script src="myscripts.js"></script>
</head>
<body class="body-create">

<div class="">
    <?php
        echo '
                    <table class="fondo-pc2 card2">
                        <tr class="fuente3 fuente">
                            <th>Usuari</th>
                            <th>Punts</th>
                        </tr>';
        for($i=0;$i<$numeropersones;$i++){
            $ranking = $ranking2->fetch(PDO::FETCH_ASSOC);
            $rankingnumeric = $i + 1;
            if($i==0){
                echo '
                    <tr style="text-align:center;color: #ffffff;" class="fuente2">
                        <td><a style="color:#FFC312">' . $rankingnumeric . ".</a> " . $ranking['nom_user'] . '</td> 
                        <td>' . $ranking['puntuacio'] . '</td>
                    </tr>';
            }elseif($i==1){
                echo '
                    <tr style="text-align:center;color: #ffffff;" class="fuente4">
                        <td><a style="color:#FFC312">' . $rankingnumeric . ".</a> " . $ranking['nom_user'] . '</td> 
                        <td>' . $ranking['puntuacio'] . '</td>
                    </tr>';
            }elseif($i==2){
                echo '
                    <tr style="text-align:center;color: #ffffff;" class="fuente5">
                        <td><a style="color:#FFC312">' . $rankingnumeric . ".</a> " . $ranking['nom_user'] . '</td> 
                        <td>' . $ranking['puntuacio'] . '</td>
                    </tr>';
            }elseif($i>2){
                echo '
                    <tr style="text-align:center;color: #ffffff;" class="fuente6">
                        <td>' . $ranking['nom_user'] . '</td>
                        <td>' . $ranking['puntuacio'] . '</td>
                    </tr>';
            }
        }
        echo "</table>";
    ?>
    
</div>
<div class="navbar">
            <a href="./PH_home.php" class="botons"><img src="./PH_img/btn_home.png" alt="" width="150px" height="150px"></a>
            <a href="./PH_createCTF.php" class="botons"><img src="./PH_img/btn_addctf.png" alt="" width="150px" height="150px"></a>
            <a href="../lib/logout.php" class="botons"><img src="./PH_img/btn_logout.png" alt="" width="150px" height="150px"></a>
            <a href="./PH_ranking.php" class="botons active"><img src="./PH_img/btn_ranking.png" alt="" width="130px" height="150px"></a>
        </div>
</body>
</html>
