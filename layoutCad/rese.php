<?php
    session_start();
    // include 'dbh.php';
    include_once 'conexao.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css">
  
    <title>Umer's Library</title>
</head>

<body>
    <div class="page-wrap">
        <header>
            <div class="container">
              
                <nav>
                    <ul>
                        <li><a href="login_index.php"><span>HOME</span></a></li>
                    </ul>
                </nav>
            </div>
        </header>
        <main>
            <div class="container">
              
                <table id="resulttable">
                <tr>
                    <th>ISBN</th>
                    <th>UserName</th>
                    <th>Date</th>
                    
                </tr>
                
                <?php
                   $sql = "select * from Reservations";
                    $result = mysqli_query($conn,$sql);
                    $quaryresult = mysqli_num_rows($result); 
                    if($quaryresult > 0)
                {
                    while($row = mysqli_fetch_assoc($result))
                {
                    $isbn = $row['ISBN'];
                   
                    echo "<tr>
                        <td>".$row['ISBN']."</td>
                        <td>".$row['UserName']."</td>
                        <td>".$row['ReservedDate']."</td>";
                        ?>
                       <form method="POST"><td colspan=7><button name="delete"  class="seperate" value="<?php echo $isbn ?>">delete</button></td></tr></form>'
                       <?php
                            
                }
               
                }
                else
                {
                    echo"no records found";
                }
                    
                    if(isset($_POST['delete']))
				{
					$isbn = $_POST['delete'];
					$delete = "delete from Reservations where ISBN = '$isbn'";
					$undo = "update books set Reserved = 'N' where ISBN = '$isbn'";
					mysqli_query($conn, $delete);
					mysqli_query($conn, $undo);
				}
                    
                ?>
                </table>
            </div>
        </main>
    </div>

    <footer>
        <div class="container">
            <p class="footer-left">&copy; Umer Waleed</p>
            <p class="footer-right">Call Me: 0899630455</p>
        </div>
    </footer>
</body>

</html>