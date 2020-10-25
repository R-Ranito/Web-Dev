
<?php
session_start();
if(!empty($_SESSION['id'])){
    echo "Hi ".$_SESSION['nome'].", Welcome <br>";
    echo "What do you want to do?<br>";

    echo '<link rel="stylesheet" type="text/css" href="site.css">';
    echo '<div id="nav">
            <ul>
                <li><a href="form.php">Search a book by Title</a><br></li>
                <li><a href="formAut.php">Search a book by Author</a></li>
                <li><a href="pesqCat.php">Search a book by Category</a></li>
                <li><a href="res.php">Reservations</a></li>

                <li><a href="sair.php">Log off</a></li>
            </ul>
        </div>';
    

    
}else{
    $_SESSION['msg'] = "Restricted area";
    header("Location: login.php");  
}
?>




<?php 

    include_once 'conexao.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reservations</title>
        <style type="text/css">
            .carregando{
                color:#ff0000;
                display:none;
            }
        </style>
    </head>
   
    <title>Ranito's Library</title>
</head>

<body>
    
              
         <?php

                $sql = "SELECT ISBN, username, date FROM reservation";
                $result = mysqli_query($conn, $sql);

                if ($result > 0) {
                // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo " ID: " . $row["ISBN"]. " - userName: " . $row["Username"]. " - reserve Date " . $row["date"]. "<br>";
                    }
                }
                 else 
                 {
                    echo "0 results";
                }

                ?>
                       <form method="POST"><td colspan=7><button name="delete"  class="seperate" value="<?php echo $isbn ?>">delete</button></td></tr></form>'
                       
                <?php
                            
                    
                    if(isset($_POST['delete']))
                {
                    $isbn = $_POST['delete'];
                    $delete = "delete from reservation where ISBN = '$isbn'";
                    $undo = "update books set reserved = 'no' where ISBN = '$isbn'";
                    mysqli_query($conn, $delete);
                    mysqli_query($conn, $undo);
                }
                    
                ?>
               
            
        </main>
    
 
    <footer>
        <div class="footer">
            @ Rui Ranito DT228
        </div>
        
    </footer>
</body>

</html> 







<!-- <?php
session_start();
if(!empty($_SESSION['id'])){
    echo "Hi ".$_SESSION['nome'].", Welcome <br>";
echo "What do you want to do?<br>";

    echo '<link rel="stylesheet" type="text/css" href="site.css">';
    echo '<div id="nav">
            <ul>
                <li><a href="form.php">Search a book by Title</a><br></li>
                <li><a href="formAut.php">Search a book by Author</a></li>
                <li><a href="pesqCat.php">Search a book by Category</a></li>
                

                <li><a href="sair.php">Log off</a></li>
            </ul>
        </div>';
    

    
}else{
    $_SESSION['msg'] = "Restricted area";
    header("Location: login.php");  
}

include_once("conexao.php");


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Reservations</title>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    </head>
    <body>



        <h1>Reservations</h1>
        
         <img src="img.png"/>




        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

       

        <div class="footer">
            @ Rui Ranito DT228
        </div>
    </body>
</html>
 -->