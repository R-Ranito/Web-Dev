<?php
session_start();
if(!empty($_SESSION['id'])){
    echo "Hi ".$_SESSION['nome'].", Welcome <br>";
    echo '<link rel="stylesheet" type="text/css" href="site.css">';
    echo '<div id="nav">
            <ul>
                <li><a href="form.php">Search a book by Title</a></li>
                <li><a href="formAut.php">Search a book by Author</a></li>
                <li><a href="show.php">Reservations</a></li>

                <li><a href="sair.php">Log off</a></li>
            </ul>
        </div>';
    

    
}else{
    $_SESSION['msg'] = "Restricted area";
    header("Location: login.php");  
}
?>




<!-- <?php
    session_start();
    include_once 'conexao.php';
?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
  
    <title>Ranito's Library</title>
</head>

<body>
    <!-- <div class="page-wrap">
        <header>
            <div class="container">
              
                <nav>
                    <ul>
                        <li><a href="login_index.php"><span>HOME</span></a></li>
                        <li><a href="viewreserve.php"><span>View</span></a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="container"> -->
              
        <?php
                
                
                
                if(isset($_POST['enter']))
                {
                    $isbn = $_POST['enter'];
                    $user = $_SESSION['nome'];
                    $date = date("d-m-Y");

                    
                    $do = "update books set reserved = 'yes' where ISBN = '$isbn'";
				    $insert = "insert into Reservations values ('$isbn','$user', $date)";
				    mysqli_query($conn, $do);
				    mysqli_query($conn, $insert);
                    echo'<h1>Reservation completed</h1>';
        
                }
                  
                
                else
                {
                    echo 'Sorry';
                }
                
                
                
                ?>
            </div>
        </main>
    </div>

    <footer>
        <div class="footer">
            @ Rui Ranito DT228
        </div>
        
    </footer>
</body>

</html>