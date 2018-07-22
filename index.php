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
                    error_reporting(E_ALL ^ E_NOTICE);
                    
                    $adjacents = 5;

                    $query = mysqli_query($con,"SELECT COUNT(*) as num  from diary ORDER BY created_date DESC");
                    $total_pages = mysqli_fetch_array($query);
                
                    $total_pages = $total_pages['num'];



                    $limit = 5;                                //how many items to show per page
                    $page = $_GET['page'];
                
                    if($page) 
                        $start = ($page - 1) * $limit;          //first item to display on this page
                    else
                        $start = 0;                             //if no page var is given, set start to 
                    /* Get data. */
                    $result = mysqli_query($con,"SELECT * from diary ORDER BY created_date DESC LIMIT $start, $limit");
                
                    /* Setup page vars for display. */
                    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
                    $prev = $page - 1;                          //previous page is page - 1
                    $next = $page + 1;                          //next page is page + 1
                    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
                    $lpm1 = $lastpage - 1;                      //last page minus 1
                
                    $pagination = "";
                    if($lastpage > 1)
                    {   
                        $pagination .= "<div class=\"pagination\">";
                        //previous button
                        if ($page > 1) 
                            //$pagination.= "<a href=\"videos-$prev.html\">« previous</a>";
                            $pagination.= "<a href=\"index.php?page=$prev\">« previous</a>";
                        else
                            $pagination.= "<span class=\"disabled\">« previous</span>"; 
                            
                        //next button
                        if ($page < $lastpage) 
                            $pagination.= "<a href=\"index.php?page=$next\">next »</a>";
                        else
                            $pagination.= "<span class=\"disabled\">next »</span>";
                        $pagination.= "</div>\n";       
                    }
                
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
        <?php  echo $pagination; ?>      
    </div> 
</body>
</html>