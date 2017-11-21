<?php 
session_start();
if(!isset($_SESSION['loginname'])){
    echo '<script language=javascript>window.location.href="loginremind.html"</script>';
}
$username=$_POST['username'];
$ptime=$_POST['ptime'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether keyword is null if so then display all products esle just display relevent
$query= "SELECT * FROM project WHERE loginname='{$username}' AND posttime='{$ptime}'";
$result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysql_error());

$line = @mysqli_fetch_array($result, @MYSQL_ASSOC);
$GLOBALS['p_pname']=$line['pname'];
$GLOBALS['p_loginname']=$line['loginname'];
$GLOBALS['p_pdescription']=$line['pdescription'];
$GLOBALS['p_min']=$line['min'];
$GLOBALS['p_max']=$line['max'];
$GLOBALS['p_posttime']=$line['posttime'];
$GLOBALS['p_deadline']=$line['deadline'];
$GLOBALS['p_comptime']=$line['comptime'];
$GLOBALS['p_status']=$line['pstatus'];
$GLOBALS['p_id']=$line['pid'];


function Project_name(){
    echo htmlspecialchars($GLOBALS['p_pname']);
}
function Project_user(){
    echo htmlspecialchars($GLOBALS['p_loginname']);
}
function Project_description(){
    echo htmlspecialchars($GLOBALS['p_description']);
}
function Project_min(){
    echo htmlspecialchars($GLOBALS['p_min']);
}
function Project_max(){
    echo htmlspecialchars($GLOBALS['p_max']);
}
function Project_posttime(){
    echo htmlspecialchars($GLOBALS['p_posttime']);
}
function Project_deadline(){
    echo htmlspecialchars($GLOBALS['p_deadline']);
}
function Project_comptime(){
    echo htmlspecialchars($GLOBALS['p_comptime']);
}
function Project_id(){
    echo htmlspecialchars($GLOBALS['p_id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cloud Funding - Project Detail</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<style>
.div10086{
width:auto;
height:auto;
float:left;
}
</style>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Welcome to cloud funding!</a>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Project Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                <!-- /.col-lg-4 -->
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <?php Project_name();?>
                        </div>
                        <div class="panel-body">
                            <a class="fa fa-user">  <?php Project_user();?></a><br><p></p>
                                <?php 

                                switch ($GLOBALS['p_status']) {
                                    case 'Failed':
                                        echo "<button type='button' class='btn btn-outline btn-danger'>Failed</button>";# code...
                                        break;
                                    case 'Executing':
                                        echo "<button type='button' class='btn btn-outline btn-success'>Executing</button>";
                                        break;
                                    case 'Completed':
                                        echo "<button type='button' class='btn btn-outline btn-default'>Completed</button>";
                                        break;

                                    default:
                                        echo "<button type='button' class='btn btn-outline btn-info'>Raising</button>";
                                        break;
                                }

                                 ?>

                                <br><br>
<?php 
$pid=$GLOBALS['p_id'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());
//Check wether keyword is null if so then display all products esle just display relevent
$query= "SELECT * FROM tag WHERE pid='{$pid}'";
$result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysql_error());
while ($line = @mysqli_fetch_array($result, @MYSQL_ASSOC)) {
    echo "<div class='div10086'><form method='POST' action='projects.php' theme='simple' >";
    echo "<input hidden name='category' value='".$line['catname']."'>";
    echo "<input type='submit' class='btn btn-primary btn-xs' value='".$line['catname']."'>";
    echo "</form></div>";
}
?>
<br><br>

                            <p><?php Project_description();?></p>
                            <p>picture and music</p>
                            <p>Max: <?php Project_max();?></p>
                            <p>Min: <?php Project_min();?></p>
                            <P></P>
                            <p class="fa fa-calendar"> <br>Posted: <?php Project_posttime();?>
                            <br>    Deadline:  <?php Project_deadline();?>
                            <br>    Expected Host On:  <?php Project_comptime();?>
                            </p><br>
                            <form method="POST" action="project_process1.php"><p class="text-muted">
                            <input hidden name="way" value="fol">
                            <input hidden name="p_user" value="<?php Project_user();?>">
                            <input type="submit" class="btn btn-success btn-circle" value="F">
                            &nbsp;Follow the Author </p></form>
                            <form method="POST" action="project_process1.php">
                            <p class="text-muted">
                            <input hidden name="way" value="lik">
                            <input type="submit" class="btn btn-danger btn-circle" value="L">
                            <input hidden name="p_id" value="<?php Project_id();?>">
                            </button>  &nbsp;Like the Project </p></form>
                        </div>
                        <div class="panel-footer">
                            Donate:&nbsp;
                            <form method="POST" action="project_process2.php">
                                <input hidden name="p_id" value="<?php Project_id();?>">
                                <input width="20" placeholder="Amount of Money" name="money" type="text" autofocus> &nbsp;&nbsp;
                                <input type="submit" class="btn btn-warning btn-s" value="Confirm">
                            </form>
                            
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
<?php 
$pid=$GLOBALS['p_id'];
//Test database connection
$connection = @ mysqli_connect("127.0.0.1", "roxanne", "123","fundsys")
or die('Could not connect: ' . @mysql_error());

$query= "SELECT * FROM Updates WHERE pid='{$pid}'";
$result=@mysqli_query($connection, $query) or die('Query failed: ' . @mysql_error());

while ($line = @mysqli_fetch_array($result, @MYSQL_ASSOC)) {
    $ucontent=$line['ucontent'];
    $utime=$line['utime'];
    $uid=$line['uid'];

    echo "       <div class='col-lg-12'>
                    <div class='panel panel-info'>
                        <div class='panel-heading'>
                            Updates
                        </div>
                        <div class='panel-body'>
                            <p>"; echo htmlspecialchars($ucontent); echo "</p><p class='fa fa-calendar'> Posted: ";echo $utime; echo " </p>
                        </div>
                        <div class='panel-footer'>
                           <div class='panel-body'>
                              <div class='panel-group' id='accordion'>";
    $query2="SELECT * FROM updatescomments WHERE uid='{$uid}'";
    $result2=@mysqli_query($connection, $query2) or die('Query failed: ' . @mysql_error());
    while ($line2 = @mysqli_fetch_array($result2, @MYSQL_ASSOC)){
            $uccontent=htmlspecialchars($line2['ucomment']);
            $uctime=$line2['uctime'];
            $ucuser=$line2['loginname'];
            echo "

                                <div class='panel panel-default'>
                                    <div class='panel-heading'>
                                        <h4 class='panel-title'>
                                            <p>Comment of Update</p>
                                        </h4>
                                    </div>
                                    <div id='collapseOne' class='panel-collapse collapse in'>
                                        <div class='panel-body'>
                                            <a class='fa fa-user'>"; echo $ucuser;echo"</a><br>";echo $uccontent; echo"
                                        <br><p class='fa fa-calendar'> Posted: "; echo $uctime; echo"</p>
                                        </div>
                                    </div>
                                </div>
            ";
    }

                        echo" </div>
                           </div>
                           Add Comment to the Update:&nbsp;
                           <form method=POST action=project_process1.php>
                           <input hidden name='way' value='upc'>
                           <input hidden name='u_id' value='".$uid."'>
                            <input width='60' size='60' placeholder='Please Enter Comment' name='ureply' type='text' autofocus> &nbsp;&nbsp;
                            <input type='submit' class='btn btn-primary btn-s' value='Post'>
                            </form>
                        </div>
                    </div>
                </div>";

}


$query3= "SELECT * FROM projectcomments WHERE pid='{$pid}'";
$result3=@mysqli_query($connection, $query3) or die('Query failed: ' . @mysql_error());

while ($line3 = @mysqli_fetch_array($result3, @MYSQL_ASSOC)) {
    $pccontent=htmlspecialchars($line3['pcomment']);
    $pctime=$line3['pctime'];
    $pcuser=$line3['loginname'];

    echo "       <div class='col-lg-12'>
                    <div class='panel panel-danger'>
                        <div class='panel-heading'>
                             Project Comment
                        </div>
                        <div class='panel-body'>
                           <a class='fa fa-user'>"; echo  $pcuser; echo"</a><br>
                            <p>"; echo $pccontent; echo "</p><p class='fa fa-calendar'> Posted: ";echo $pctime; echo " </p>
                        </div>

                    </div>
                </div>";

}

?>

<p></p>

                <!-- /.col-lg-4 -->
                            <div class="input-group">
                                <form method="POST" action="project_process1.php">

                                <span class="input-group-btn">
                                    <input hidden name="way" value="pjc">
                                    <input hidden name="p_id" value="<?php Project_id();?>">
                                    <input size='100' id="btn-input" type="text" class="form-control input-sm" name="pcomment" placeholder="Type your message here..." />
                                    <input type="submit" class="btn btn-warning btn-sm" id="btn-chat" value="Send">
                                   
                                </span>
                                </form>
                            </div>
                            <p><br></p><p></p><p></p><p></p><p></p><p></p><p></p>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
