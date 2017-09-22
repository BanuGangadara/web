function validateForm() {
	if (validateFname()) {

	}
	return false;
}
function validateFname(){
	var x=document.getElementById('fname').value;
    var regex = /^[a-zA-Z\s]+$/;
    if(regex.test(fname.value) == false){
    document.getElementById('msg1').innerHTML="The First Name field is requiered";
    return false;
    }
    else{
    document.getElementById('msg1').innerHTML="";
    return true;
    }
}