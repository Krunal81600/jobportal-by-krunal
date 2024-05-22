<?php
//Include database configuration file
include('../config.php');

if(isset($_POST["country_id"]) && !empty($_POST["country_id"])){
	
    //Get all City data
    $query = mysqli_query($con,"SELECT * FROM city WHERE country_id = '".$_POST['country_id']."' ORDER BY citynm ASC");
    
    //Count total number of rows
    $rowCount = mysqli_num_rows($query);
    
    //Display City list
    if($rowCount > 0){
        echo '<option value="">-----Choose City-----</option>';
        while($row = mysqli_fetch_array($query)){ 
            echo '<option value="'.$row['id'].'">'.$row['citynm'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}

?>