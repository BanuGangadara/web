<?php
	$menufields=array("contacts","leads","cases");
	function databaseConnect(){
		$conn = mysqli_connect('localhost','root','Root','sugar') or die('database connection failed');
		return $conn;
	}
	mainMenu($menufields);
	function mainMenu($menufields){
		echo "Select your Choice\n";
		$length=count($menufields);
		$count=0;
		foreach ($menufields as $value) {
			$count=$count+1;
			echo "Choose $count to select $value\n";
		}
		$choice=readline();
		$selected=intval($choice);
		$status=validateChoice($selected, $length);
		if ($status==true) {
			$modulename=$menufields[$selected-1];
			showSubmenu($modulename);
		}
		else
			return(mainMenu($menufields));
	}
	function validateChoice($choice, $length){
		if ($choice>0 && $choice<=$length) 
		{
			return true;
		}
		else
			echo "please enter valid choice\n";
			return false;
	}
	function showSubmenu($modulename){
		$actions=array("create","edit","view");
		$length=count($actions);
		echo "Enter your choice to select\n";
		$count=0;
		foreach ($actions as $value) {
			$count=$count+1;
			echo "select $count to $value $modulename\n";
		}
		$choice=readline();
		$modulechoice=intval($choice);
		$status=validateChoice($modulechoice, $length);
		if ($status==true) {
			$action=$actions[$modulechoice-1];
			menuDeatails($modulename, $action);
		}
		else
			return(showSubmenu($modulename));

	}
	function menuDeatails($modulename, $action){
		echo "$modulename $action\n";
		$fieldsarray=array();
		$connection=databaseConnect();
		$sql="select * from $modulename";
		$result=mysqli_query($connection, $sql) or die("error in selecting data" . mysqli_error($connection));
		while ($fieldinfo=mysqli_fetch_field($result))
	    {
	    	array_push($fieldsarray, $fieldinfo->name);
	    }
	    foreach ($fieldsarray as $value) {
	    	echo "$value\n";
	    }
		switch ($action) {
			case "create":
				createRecord($fieldsarray, $modulename);
				break;
			case "edit":
				editModule($modulename);
				break;
			case "view":
				viewModule($modulename);
				break;
			default:
				break;
		}
		mysqli_close($connection);
	}
	function createRecord($fields, $modulename){
		$fieldarray=$fields;
		$fieldvalues=array();
		foreach($fieldarray as $value){
			print "please enter $value \n";
			$fieldvalue=readline();
			array_push($fieldvalues, "$fieldvalue");
		}
	 	$valuestring=implode("','",$fieldvalues);
	 	$connection=databaseConnect();
	 	$mname=$modulename;
		$query="insert into $mname values('$valuestring') ";
		$result=mysqli_query($connection, $query) or die("error in inserting data" . mysqli_error($connection));
		mysqli_close($connection);
		echo "Please enter C if you want to continue with inserting \n";
		echo "enter S to go $modulename menu\n";
		echo "enter M to go  main menu\n";
		echo "enter 0 to exit\n";
		$case=readline();
		switch ($case) {
			case 'C':
				return(createRecord($fields,$modulename));
				break;
			case 'S':
				echo "$modulename";
				if ($modulename=="contacts") {
					$choice=1;
				}
				else if($modulename="leads"){
					$choice=2;
				}
				else{
					$choice=3;
				}
				menuDeatails($choice);
				break;
			case 'M':
				readChoice();
				break;
			case '0':
				exit(0);
				break;
			default:
				# code...
				break;
		}


	}
	function editModule($modulename){
		$connection=databaseConnect();
		$primarykey="helo";
		$query="select * from  $modulename";
		$result=mysqli_query($connection, $query);
		if ($result = mysqli_query($connection, $query)) {

	        /* Get field information for all columns */
	        $finfo = mysqli_fetch_fields($result);

	        foreach ($finfo as $val) {
	        	if ($val->flags & MYSQLI_PRI_KEY_FLAG) {  
			        $primarykey=$val->name;
			    }
		    }
	    }
	    echo "$primarykey\n";
		$count=0;
		while ($row=mysqli_fetch_assoc($result)) {
			$count=$count+1;
			echo "\n==================\n";
			echo "\nRow number $count\n";
			echo "\n==================\n";
			$fieldcount=0;
			foreach ($row as $key => $value) {
				echo "{$key} = {$value} \n";
			}
		}
		echo "enter the row number you want to edit\n";
		$rownumber=readline();
		$rownumber=$rownumber-1;
		mysqli_data_seek($result, $rownumber);
		$selectedrow=mysqli_fetch_assoc($result);
		$primaryvalue=$selectedrow[$primarykey];
		$fieldcount=0;
		foreach ($selectedrow as $key => $value) {
			$fieldcount=$fieldcount+1;
			echo "$fieldcount\t";
			echo "{$key} = {$value} \n";
		}
		$update=1;
		while($update==1){
			echo "enter the field number to be updated \n";
			global $DB;
			$fieldnumber=readline();
			$count=0;
			foreach ($selectedrow as $key => $value) {
				
				$count=$count+1;
				if ($count==$fieldnumber) {
					$fieldname=$key;
					$fieldvalue=$value;
					echo "$fieldname\n";
					echo "enter the new value you want to update\n";
					$value=readline();
					$updatequery="update $modulename set $fieldname='$value' where $primarykey = '$primaryvalue'";
					$updateresult=mysqli_query($connection, $updatequery);
					if (!$updateresult) {
				    	die('Invalid query: ' . mysqli_error($connection));
					}
					else{
						echo "updated successfully\n";
					}
					echo "Plese enter 0 if you have done with your update or if you want to continue press 1\n";
					$update=readline();
				}
			}
		}
		mysqli_close($connection);
	}
	function viewModule($modulename){
		$connection=databaseConnect();
		$query="select * from  $modulename";
		$result=mysqli_query($connection, $query);
		$count=0;
		while ($row=mysqli_fetch_assoc($result)) {
			$count=$count+1;
			echo "\n==================\n";
			echo "\nRow number $count\n";
			echo "\n==================\n";
			foreach ($row as $key => $value) {
				echo "{$key} = {$value} \n";
			}
		}
		mysqli_close($connection);
	}
?>