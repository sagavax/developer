<?php 
    include_once("include/dbconnect.php");
    include_once("include/functions.php");

    if(isset($_POST['new_rec'])){
        header('location:new_record.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Developer's diary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css?<?php echo time(); ?>" />
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel='shortcut icon' href='developer.png'>
    <script src=""></script>
</head>
<body>
    <div id="container">
        <div id="nav"><ul><li><a href="index.php"><i class="fas fa-home"></i></a></li></ul></div><!-- navigacia, menu -->
        <div id="diary">
            <div id="diary_header"><div id="diary_title">DEVELOPER's DIARY</div><div id="diary_action"><form action="" method="post"><button name="new_rec" class="white-button" type="submit"><i class="fas fa-plus-circle"></i> Add</button></form></div></div>
            <div id="diary_content">
                <?php
                    $sql="SELECT * from diary ORDER BY created_date DESC";
                    $result = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($result)) {
                    $diary_date=$row['created_date'];
                    $diary_text=$row['diary_text'];
                    $app_id=$row['project_id'];
                    
                    $diary_app=GetAppName($app_id);
                    
                    echo "<div class='diary_record'>";
                          echo "<div class='diary_date'>$diary_date</div><div class='diary_text'>$diary_text</div><div class='diary_app'>$diary_app</div>";  
                    echo "</div>";
                   
                    } 
                ?>
            </div>
            
        </div>
    </div> 
</body>
</html>