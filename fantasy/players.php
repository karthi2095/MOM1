<?php include('header.php'); ?>


<div class="container">
<div><h2 class="pl_list">All NFL Players</h2></div>
<?php 
error_reporting(0);
if(isset($_POST['createteam'])){
	
	$addPlayers = $_POST['addPlayer'];
	$displayName = $_POST['displayName'];
	$position = $_POST['position'];
	$team = $_POST['team'];
	$TeamName = $_POST['TeamName'];
	if($addPlayers!=""){				
	$counts = 0;
	foreach( $addPlayers as $results ){
		
		if( $results!="" ){
				mysql_query('insert into teams(playerName, position, team, TeamNae) values("'.$displayName[$counts].'", "'.$position[$counts].'", "'.$team[$counts].'", "'.$TeamName.'")');
		}
		
		$counts++;
	}
	}else{
		echo "<p style='color: red;'>Please select players</p>";
	}
	
}

?>
<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	<div class="row">
    	
    	<div class="col-sm-12">
		<form method="post">
        	<table id="example"  class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Player Name</th>
                  <th>Position</th>
                  <th>Team</th>
				  <th>Add Player</th>
                </tr>
                </thead>
                <tbody>
			<?php if ($display == "players") {
	$players = $ffn->getPlayers();
	foreach($players AS $player) {
		echo '<tr>
     <td>'.$player['displayName'].'<input type="hidden" name="displayName[]" value="'.$player['displayName'].'"></td>
     <td>'.$player['position'].'<input type="hidden" name="position[]"  value="'.$player['position'].'"></td>
     <td>'.$player['team'].'<input type="hidden" name="team[]"  value="'.$player['team'].'"></td>
	 <td><input type="checkbox" name="addPlayer[]"  value="1"></td>
                </tr>';
		
			}
			}
?>	</tbody>
                
           </table>
		   <input type="text" placeholder="Team Name" name="TeamName">
		   <input type="submit" name="createteam" value="Create team">
		   </form>
        </div>
    </div>
    </div>
</div>