function validateForm(){
		if (validateFname()) {
      if (validateLname()) {
        if (validateBday()) {
          if (validateEmail()) {
            if (validatePlace()) {
              if (validateInstrument()) {
                if (validateTiming()) {

                }
              }

            }

          }

        }
      }

		}
      return false;

	}
	
	function validateFname() {
	  var x=document.getElementById('fname').value;
    var regex = /^[a-zA-Z\s]+$/;
    if(regex.test(fname.value) == false){
    document.getElementById('msg1').innerHTML="field should not be blank and it should contain only alphabets";
    return false;
    }
    else{
    document.getElementById('msg1').innerHTML="";
    return true;
    }
  }
  function validateLname(){
  	var x=document.getElementById('lname');
   	var regex = /^[a-zA-Z\s]+$/;
    if(regex.test(lname.value) == false){
    document.getElementById('msg2').innerHTML="field should contain only alphabets and it should contain only alphabets";
    return false;
    }
    else{
    document.getElementById('msg2').innerHTML="";
    return true;
    }
  }
  function validateBday(){
    var bday=document.getElementById('bday');
    var dob =new Date(bday.value);
        var month = dob.getMonth();
        var day   = dob.getDate();  
        var year  = dob.getFullYear();
        if(year>2017){
        document.getElementById('msg3').innerHTML= "Please enter valid year format"; 
        return false;
      }
      else if(bday.value=="")
      {
        document.getElementById('msg3').innerHTML= "You should not leave this as blank"; 
        return false;
      }
      else
        document.getElementById('msg3').innerHTML="";
        return true;
  }
  function validateEmail(){
    var email = document.getElementById('email').value;
    var emailFilter=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!emailFilter.test(email)) {
       document.getElementById('msg4').innerHTML="email field should contain the pattern of example@exe.com";
        return false;
    }
    else
      document.getElementById('msg4').innerHTML="";
      return true;
  }
  function validatePlace(){
     var x=document.getElementById('place').value;
    var regex = /^[a-zA-Z\s]+$/;
    if(regex.test(fname.value) == false){
    document.getElementById('msg5').innerHTML="Place should not be blank";
    return false;
    }
    else
    document.getElementById('msg5').innerHTML="";
    return true;
    
  }
  function validateInstrument(){
        var selectedText = instruments.options[instruments.selectedIndex].innerHTML;
        var selectedValue = instruments.value;
        if (selectedValue=="0") {
          document.getElementById('msg6').innerHTML="select your choice of instrument";
          return false;
        }
        else
          document.getElementById('msg6').innerHTML="";
        return true;
  }
function validateTiming(){
        var selectedText = time.options[time.selectedIndex].innerHTML;
        var selectedValue = time.value;
        if (selectedValue=="0") {
          document.getElementById('msg7').innerHTML="you have to choose your timings to attend class";
          return false;
        }
        else
          document.getElementById('msg7').innerHTML="";
        return true;

}