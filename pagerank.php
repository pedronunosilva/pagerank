<?php 
	
	// Inicialization 
	$k = 100;
	$precision = 5;
	
	
	$start_Nodes = array();
	$end_Nodes = array();
	$nodes = array();
	$shares = array();
	$ranks = array();
	$old_ranks = array();
	$sort_ranks = array();

	// Path of nodes
	$path = array (
		array("A","B"),
		array("A","D"),
		array("B","C"),
		array("B","F"),
		array("C","D"),
		array("C","E"),
		array("D","B"),
		array("E","A"),
		array("E","D"),
		array("F","D")
	);
	
	// Print Graph of Nodes
	echo '<b> Path:  </b><br />';
  
	$size = count( $path );
	
	for ( $i=0; $i<$size; $i++ ){
	  
	  echo ' '. $path[$i][0]. ' => '. $path[$i][1] . '<br />';
   
   	} 
  
	// get start nodes
	$start_Nodes = array_column( $path, 0 );

	// get end nodes
	$end_Nodes = array_column( $path, 1 );
   
	// get unique nodes
	$nodes = array_unique( $start_Nodes );
	
	// Sort nodes, order the nodes
	sort( $nodes );
	
	// Number of unique nodes
	$number_Nodes = count( $nodes );
  
	// Populate rank arrays (1/n)
	$ranks = array_fill_keys( $nodes, round( ( 1 / $number_Nodes ), $precision ) );
	
	// Count number of paths for each nodes
	$countOut = array_count_values( $start_Nodes );
		
	// Print Page Rank inicialization
	echo '<br \> Page Rank Inicialization <br \> <br \> <b>Page Rank: </b>  &nbsp;';
	
	foreach ( $ranks as $key => $value ) {
	 
		echo ' <b>['.$key.']</b> => '.( $ranks[$key] );
	}
	
	$j = 1;
  
	// Get shares and ranking
	do {
	
		echo '<br \><br \>Iteration nº '. $j . '<br \>';
		echo '<hr>';
	
		echo '<br \><b>Shares:</b>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	
		
		foreach ($ranks as $key => $value) {
		
			$shares[$key] = round(($ranks[$key] / $countOut[$key]), $precision);
	 
			echo ' <b>['.$key.']</b> => '.($shares[$key]);
		}
	
		echo '<br \> <br \><b>Page Rank:</b>  &nbsp;';
		
		$size2 = count($end_Nodes);
		
		$old_ranks = $ranks;
		
		foreach ($ranks as $key => $value) {
	 
	 		$pr = 0;
	 	
	 		for ($i=0; $i<$size2; $i++){
	 		
	 			if ($end_Nodes[$i] == $key){
		   			
		   			$pr += $shares[ $start_Nodes[$i] ]; 
		   	   
		   		}
			}

			$ranks[$key] = $pr;
		
			echo ' <b>['.$key.']</b> => '.($pr);

		}
	
		
		$sort_ranks = $ranks;
		
		arsort($sort_ranks);	
		
		echo '<br \> <br \> <b>Ranking: </b>';
  
		foreach ($sort_ranks as $key => $value) {
	   	   
	   	   echo '<b>'.$key.'</b> ';
	   	}	
		
		 
		$j++;

	    $result_array = array_intersect_assoc($old_ranks, $ranks);
	    
	     if ($j==$k) break;
	
	} while (count($result_array)!=$number_Nodes);
	
	