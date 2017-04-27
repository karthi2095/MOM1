<?php include('header.php'); ?>


<div class="container">
<div><h2 class="pl_list">All NFL Players</h2></div>

<div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	<div class="row">
    	
    	<div class="col-sm-12">
		
        	<table id="example"  class="table table-bordered table-hover">
                <thead>
                <tr>
				  <th>S.no</th>
				  <th>Team Name</th>
				  <th>player Name</th>
                 <th>position</th>
                 <th>team</th>
                </tr>
                </thead>
                <tbody>
			<?php
	$query = mysql_query("select * from teams where TeamNae = '".$_GET['id']."' ");
	$counts = 1;
	while($results = mysql_fetch_array($query)) {
		echo '<tr>
     <td>'.$counts.'</td>
     <td>'.$results['TeamNae'].'</td>
      <td>'.$results['playerName'].'</td>
      <td>'.$results['position'].'</td>
      <td>'.$results['team'].'</td>
                </tr>';
		$counts++;
			}
			
?>	</tbody>
                
           </table>
        </div>
    </div>
    </div>
</div>