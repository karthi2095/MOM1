<?php include('header.php'); ?>
<style>
.weekly_rank_main .btn.btn-default {
  background: #C4000E;
  color: #fff;
  border: #C4000E;
  font-size: 16px;
  text-transform: uppercase;
  padding: 9px 15px;
}
.butt{    text-align: center;}
</style>

<?php 

if($_GET['buttons']=='true'){
?>
<div class="butt">
<p><b>categorize the players</b></p>
<a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=QB&week=1&ppr=1&buttons=true">Qb</a>
<a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=RB&week=1&ppr=1&buttons=true">RB</a>
<a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=WR&week=1&ppr=1&buttons=true">WR</a>
<a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=TE&week=1&ppr=1&buttons=true">TE</a>
<a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=DEF&week=1&ppr=1&buttons=true">DEF</a><a class="btn btn-default" href="http://creativedreamrz.in/php/fantasy/weekly_ranking.php?display=weeklyRankings&position=K&week=1&ppr=1&buttons=true">K</a>
</div>

<?php 
}


if ($display == "weeklyRankings") {

	if (empty($_GET['position']) && empty($_GET['week'])) {
	?>
	<div class="container">
		<div class="row weekly_rank_main">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<form action="<?php echo PHP_SELF; ?>" method="get">
					<input type="hidden" name="display" value="weeklyRankings" />
					<div class="form-group">
					   <label>Select Position</label>
						<select class="form-control" name="position" size="1">					
							<option value="QB" selected>QB</option>
							<option value="RB">RB</option>
							<option value="WR">WR</option>
							<option value="TE">TE</option>
							<option value="DEF">DEF</option>
							<option value="K">K</option>
						</select>
					</div>
					<div class="form-group">
					   <label>Select Week</label>
						<select class="form-control"name="week" size="1">
							<?php
							for ($i = 1; $i < 18; $i++) {
								echo "<option value='$i'>$i</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
					   <label>PPR</label>
						<select class="form-control" name="ppr" size="1">
							<option value="1" selected>Yes</option>
							<option value="0">No</option>
						</select> 
					</div>
					 <button type="submit" class="btn btn-default">Submit</button>
					
				</form>
	<?php
	} else {
		$sitStart = $ffn->getWeeklyRankings($_GET['position'], $_GET['week'], $_GET['ppr']);

		?><div class="container"><div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
			<div class="row">
    	
    	<div class="col-sm-12">
			<table id="example"  class="table table-bordered table-hover">
                <thead>
                <tr>				
                 <th>Week</th>
                  <th>Player Id</th>
                  <th>name</th>
                  <th>Team</th>
                  <th>position</th>
                  <th>standard</th>
                  <th>standard Low</th>
                  <th>standard High</th>
                  <th>ppr Low</th>
                  <th>ppr High</th>
                </tr>
                </thead>
                <tbody>
					<?php 
						foreach($sitStart['Rankings'] AS $player) {  
							
							echo '<tr>
									  <td>'.$player['week'].'</td>
									  <td>'.$player['playerId'].'</td>
									  <td>'.$player['name'].'</td>
									  <td>'.$player['Team'].'</td>
									  <td>'.$player['position'].'</td>
									  <td>'.$player['standard'].'</td>
									  <td>'.$player['standardLow'].'</td>
									  <td>'.$player['standardHigh'].'</td> 
									  <td>'.$player['pprLow'].'</td> 
									  <td>'.$player['pprHigh'].'</td> 
									</tr>';
							
						}
					?>
				</tbody>                
           </table>
		</div>
		</div>
		</div>
		</div>
		<?php 
		
		exit;
	}
}

?>