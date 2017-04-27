<?php
/**
This page will create the FFN object and then show you how to call the different methods
to return the information that you want. The first thing you need to do is register for an
API Key at FantasyFootballNerd.com.  When you register for one, enter into the API_KEY
constant below.  You won't be able to get data without an API key. This is the only
edit you are required to make, here.
**/

// Just to be sure. This error is annoying.
date_default_timezone_set('UTC');

define('API_KEY', 'cfqxeibhwt2v'); // //-- Insert your API key
define('PHP_SELF', htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'));

require_once("FFN.class.php");

$ffn = new FFN(API_KEY);

if (!API_KEY) {
	echo 'You did not set the API_KEY for your application. This is required.';
	exit;
}

$display = isset($_GET['display']) ? $_GET['display'] : FALSE;

mysql_connect('khirod.ipagemysql.com', 'fantasy', 'fantasy') or die('connection error');
mysql_select_db('fantasy') or die('database error');

?>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<link href="css/css_view.css" rel="stylesheet"/>
<link href="css/tb_responsive.css" rel="stylesheet"/>
<style>
.pl_list {
    background: #C4000E;
    padding: 10px;
    font-size: 20px;
    color: rgb(255, 255, 255);margin: 0px;
}
.table.table-bordered.table-hover thead {
    background: #F0F0F0;
}
</style>



<head>
<title>FantasyFootballNerd.com API Test for PHP</title>
</head>

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">FantasyFootballNerd.com</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav pull-right">
       <li class=""><a href="schedule.php?display=schedule">Get Season Schedule</a></li>
            <li><a href="players.php?display=players">Get All NFL Players</a></li>
           <!-- <li><a href="<?php echo PHP_SELF; ?>?display=playerDetails">Get Player Details</a></li>-->
            <li><a href="draftRankings.php?display=draftRankings">Get Draft Rankings</a></li>
          <!--  <li><a href="<?php echo PHP_SELF; ?>?display=injuries">Get Injuries</a></li>-->
            <li><a href="weekly_ranking.php?display=weeklyRankings">Get Weekly Rankings</a></li>
           <li><a href="allteams.php">All Teams</a></li>
          </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-- jQuery --> 
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/custom.min.js"></script>
      
  <script src="js/jquery.dataTables.min.js"></script> 

  <script src="js/dataTables.responsive.min.js"></script>
  <script src="js/responsive.bootstrap.min.js"></script>
<link href="css/datatables.min.css" rel="stylesheet"/>
  
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
						                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
		
                } )
            }
        }
    });
	
});
</script>	
