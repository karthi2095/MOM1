<?php include('header.php'); ?>
<style>

.pl_list{background:#C4000E; color:#fff; padding:10px; font-size:20px;}
.scedule_main span {
  display: block;
  font-weight: bold;
}
.scedule_main .date {
  background: #515151 none repeat scroll 0 0;
  border-radius: 0 0 3px 3px;
  color: #ffffff;
  font-size: 17px;
  margin-bottom: 22px;
  padding: 7px;
  text-transform: uppercase;
  word-wrap: break-word;
}
.week1 {
  background: #f3f3f3 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  float: left;
  margin: 18px 0;
  width: 100%;
}
h3.team_name {
  font-size: 18px;
  font-weight: bold;
  margin: 12px 0;
}
.scedule_main p{color:#707070; font-size:16px;}
.scedule_main p.playing_on {
    color: #c4000e;
    font-weight: bold;
}
</style>
<body>
<div class="container">
  <div class="scedule_main">
	 <h2 class="pl_list">Season Schedule</h2>
		 <div class="row">
		 <?php  if ($display == "schedule") {

	$schedule = $ffn->getSchedule();
	foreach($schedule['Schedule'] AS $game) {
		echo '<div class="col-md-6 col-sm-6 col-xs-12">
				  <div class="week1">
					  <div class="col-md-2 col-sm-2 col-xs-12 text-center">
					   <div class="date">
						'.$game['gameDate'].'
					  </div>
					  </div>
					  <div class="col-md-10 col-sm-10 col-xs-12">
						<h3 class="team_name">'.$game['awayTeam']. ' at '. $game['homeTeam'].'</h3>
						<p>'.$game['gameTimeET'].' ET</p><p class="playing_on"> playing on '. $game['tvStation'].'</p>
					  </div>
				  </div>
			 </div>';
	}
}  ?>
		 </div>
  </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>