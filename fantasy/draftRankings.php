<?php include('header.php'); ?>

<div class="container">
<div><h2 class="pl_list">All NFL Players</h2></div>
	<div class="row">
    	
    	<div class="col-sm-12">
        	<table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Playerb Id</th>
                  <th>Position</th>
                  <th>Display Name</th> 
                  <th>First Name</th> 
                  <th>Last Name</th> 
                  <th>Team</th> 
                  <th>By Week</th> 
                  <th>Stand Dev</th> 
                  <th>Nerd Rank</th> 
                  <th>Position Rank</th> 
                  <th>Overall Rank</th> 
                </tr>
                </thead>
                <tbody>
			<?php if ($display == "draftRankings") {
					$ppr = empty($_GET['ppr']) ? 0 : 1;
					$rankings = $ffn->getDraftRankings($ppr);

					echo '<h3>Rankings. Is PPR enabled? ' . (empty($rankings['PPR']) ? 'No' : 'Yes') . '</h3>';
					
					foreach ($rankings['DraftRankings'] as $rank) {
						echo '<tr>
						  <td>'.$rank['playerId'].'</td>
						  <td>'.$rank['position'].'</td>
						  <td>'.$rank['displayName'].'</td>
						  <td>'.$rank['fname'].'</td>
						  <td>'.$rank['lname'].'</td>
						  <td>'.$rank['team'].'</td>
						  <td>'.$rank['byeWeek'].'</td>
						  <td>'.$rank['standDev'].'</td>
						  <td>'.$rank['nerdRank'].'</td>
						  <td>'.$rank['positionRank'].'</td>
						  <td>'.$rank['overallRank'].'</td>
						  
						</tr>';
						
					}
					
				}
	
?>	</tbody>
                
           </table>
        </div>
    </div>
</div>