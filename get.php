<?php 
// Include the database config file 
include_once 'database.php'; 
 
if(!empty($_POST["loc_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM sub WHERE loc_id = ".$_POST['loc_id']." AND status = 1 ORDER BY name ASC"; 
    $result = $conn->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Sub</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Sub Location not available</option>'; 
    } 
}elseif(!empty($_POST["sub_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM village WHERE sub_id = ".$_POST['sub_id']." AND status = 1 ORDER BY name ASC"; 
    $result = $conn->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select village</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Village not available</option>'; 
    } 
} 
?>