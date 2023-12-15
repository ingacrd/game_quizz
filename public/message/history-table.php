<?php 
    include_once "../../src/features/history.php";
    // Instantiate the History class
    $gameHistory = getGameHistory();


?>

<!DOCTYPE html>
<html  lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Game History</title>
    <link rel="stylesheet" href="../assets/css/nav.css" />     
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    
</head>

<body>
    <?php include '../template/nav.php'; ?>
    <div class = "container-fluid background ">
        <div class="main">
        <div class="container_2">
            <div class="promo-container ">
                <h2 class = "display-5 text-center fw-bold">Game History</h2>
            </div>
            <!--------- This is where the table will go to show the game history data that will be retreived from the DB --------->
            <div class="main-container">
                <div class="table-responsive w-90">
                    <table class = "table table-striped ">
                    <thead>
                        <tr>
 
                            <th>Name</th>
                            <!-- <th>Last Name</th> -->
                            <th>Outcome</th>
                            <th>Lives Used</th>
                            <th>Date and Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gameHistory as $row) : ?>
                            <tr>
                         
                                <td><?php echo $row['fName']. " ".$row['lName']; ?></td>
                                <td><?php echo $row['result']; ?></td>
                                <td><?php echo $row['livesUsed']; ?></td>
                                <td><?php echo $row['scoreTime']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>


            </div>
            
        </div>
        </div>
    </div>

</body>

</html>