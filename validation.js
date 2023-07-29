function validateForm() {
  var form = document.getElementById("resetpassword");
  var mobileNumber = form.elements["mobileNumber"].value;
  var password = form.elements["password"].value;
  var cpassword = form.elements["cpassword"].value;

  var mobileNumberError = document.getElementById("mobileNumberError");
  var passwordError = document.getElementById("passwordError");
  var cpasswordError = document.getElementById("cpasswordError");

  mobileNumberError.textContent = "";
  passwordError.textContent = "";
  cpasswordError.textContent = "";

  if (mobileNumber.trim() === "") {
    mobileNumberError.textContent = "Please enter the mobile number !!!";
    mobileNumberError.style.color = "red";
    return false;
  }

  if (isNaN(mobileNumber) || mobileNumber.length !== 10) {
    mobileNumberError.textContent = "Mobile number should be a 10-digit number !!!";
    mobileNumberError.style.color = "red";
    return false;
  }

  if (password.trim() === "") {
    passwordError.textContent = "Please enter the new password !!!";
    passwordError.style.color = "red";
    return false;
  }

  if (!/[a-zA-Z]/.test(password) || !/[0-9]/.test(password) || !/@/.test(password)) {
    passwordError.textContent = "Password should contain at least 1 alphabet, 1 number, and 1 @ sign !!!";
    passwordError.style.color = "red";
    return false;
  }

  if (cpassword.trim() === "") {
    cpasswordError.textContent = "Please enter the confirm password !!!";
    cpasswordError.style.color = "red";
    return false;
  }

  if (password !== cpassword) {
    cpasswordError.textContent = "Password and confirm password do not match !!!";
    cpasswordError.style.color = "red";
    return false;
  }

  if (mobileNumber.trim() !== "" && password.trim() !== "" && cpassword.trim() !== "") {
    openPasswordResetForm();
  } else {
    form.action = "operation.php";
    form.method = "POST";
    form.enctype = "multipart/form-data";
    form.submit();
    return false; // Prevent form submission
  }
}


function validatelogin()
{
  document.getElementById("login").addEventListener("submit", function(event)
  {
    var mobilenol = document.forms["login"]["mobilenol"].value;
    var passwordl = document.forms["login"]["passwordl"].value;
    var mobilenolError = document.getElementsByClassName("error")[0];
    var passwordlError = document.getElementsByClassName("error")[1];
    var loginForm = document.getElementById("login");
        
    var error = false;
        
    function validateMobile(mobilenol) 
    {
      var phoneNumber = /^\d{10}$/;
      if(mobilenol.match(phoneNumber)) 
      {
        return true;
      }     
      else 
      {
        return false;
      }
    }

    if (mobilenol == "") 
    {
      mobilenolError.innerHTML = "Please enter your mobile number !!!";
      error = true;
    } 
    else if(isNaN(mobilenol)) 
    {
      mobilenolError.innerHTML = "Mobile number should be a number !!!";
      error = true;
    } 
    else if(!validateMobile(mobilenol))
    {
      mobilenolError.innerHTML = "Mobile number should be 10 digits !!!";
      error = true;
    } 
    else 
    {
      mobilenolError.innerHTML = "";
    }
        
    if (passwordl == "") 
    {
      passwordlError.innerHTML = "Please enter your password !!!";
      error = true;
    } 
    else
    {
      passwordlError.innerHTML = "";
    }

    if (error) 
    {
      event.preventDefault();
    }
    else
    {
      mobilenolError.innerHTML = "";
      passwordlError.innerHTML = "";
      loginForm.action = "operation.php"; 
      loginForm.method = "post"; 
      loginForm.submit(); 
    }

  });
}
function login1() 
  {
        document.getElementById("user").addEventListener("submit", function(event) {
          var firstname = document.forms["user"]["firstname"].value;
          var lastname = document.forms["user"]["lastname"].value;
          var mobilenou = document.forms["user"]["mobilenou"].value;
          var gender = document.forms["user"]["gender"].value;
          var email = document.forms["user"]["email"].value;
          var passwordu = document.forms["user"]["passwordu"].value;
          var confirmpasswordu = document.forms["user"]["confirmpasswordu"].value;
          
          var error1 = false;
          var firstnameError = document.getElementsByClassName("error1")[0];
          var lastnameError = document.getElementsByClassName("error1")[1];
          var mobilenouError = document.getElementsByClassName("error1")[2];
          var genderError = document.getElementsByClassName("error1")[3]
          var emailError = document.getElementsByClassName("error1")[4];
          var passworduError = document.getElementsByClassName("error1")[5];
          var confirmpassworduError = document.getElementsByClassName("error1")[6];
          
          var userForm = document.getElementById("user");
          function validateMobile(mobilenou) 
          {
            var phoneNumber = /^\d{10}$/;
            if (mobilenou.match(phoneNumber)) 
            {
                return true;
            }
            else 
            {
                return false;
            }
          }
          if (firstname == "") 
          {
            firstnameError.innerHTML = "Please enter your first name !!!";
            error1 = true;
          } 
          else 
          {
            firstnameError.innerHTML = "";
          }

          if(lastname == "")
          {
            lastnameError.innerHTML = "Please enter your last name !!!";
            error1 = true;
          }
          else
          {
            lastnameError.innerHTML = "";
          }

          if (mobilenou == "") 
          {
            mobilenouError.innerHTML = "Please enter your mobile number !!!";
            error1 = true;
          } 
          else if (isNaN(mobilenou)) 
          {
            mobilenouError.innerHTML = "Mobile number should be a number !!!";
            error1 = true;
          } 
          else if (!validateMobile(mobilenou)) 
          {
            mobilenouError.innerHTML = "Mobile number should be 10 digits !!!";
            error1 = true;
          } 
          else 
          {
            mobilenouError.innerHTML = "";
          }

          if (gender == "") 
          {
            genderError.innerHTML = "Please select an Gender !!!";
            error1 = true;
          } 
          else 
          {
            genderError.innerHTML = "";
          }

          if (email == "") 
          {
            emailError.innerHTML = "Please enter your email id !!!";
            error1 = true;
          } 
          else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/i.test(email))
          {
            emailError.innerHTML = "Please enter a valid email address!";
            error1 = true;
          }
          else
          {
            emailError.innerHTML = "";
          }

          if (passwordu == "") 
          {
            passworduError.innerHTML = "Please enter your password !!!";
            error1 = true;
          } 
          else if (!/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@])[A-Za-z\d@]{8,}$/i.test(passwordu))
          {
            passworduError.innerHTML = "Password must contain at least one letter, one number, and one @ sign!";
            error1 = true;
          }
          else 
          {
            passworduError.innerHTML = "";
          }

          if (confirmpasswordu == "") 
          {
            confirmpassworduError.innerHTML = "Please confirm your password !!!";
            error1 = true;
          }
          else if (passwordu !== confirmpasswordu) 
          {
            confirmpassworduError.innerHTML = "Password and confirm password do not match !!!";
            error1 = true;
          } 
          else 
          {
            confirmpassworduError.innerHTML = "";
          }

          if (error1) 
          {
            event.preventDefault();
          } 
          else 
          {
            firstnameError.innerHTML = "";
            lastnameError.innerHTML = "";
            mobilenouError.innerHTML = "";
            genderError.innerHTML = "";
            emailError.innerHTML = ""; 
            passworduError.innerHTML = "";
            confirmpassworduError = "";
            userForm.action = "operation.php"; 
            userForm.method = "post"; 
            userForm.submit();
          }
      });
  }
function validatehotel() 
 {
    document.getElementById("hotel").addEventListener("submit", function(event) 
    {
      
        var hotelname = document.forms["hotel"]["hotelname"].value;
        var mobilenoh = document.forms["hotel"]["mobilenoh"].value;
        var passwordh = document.forms["hotel"]["passwordh"].value;
        var confirmpasswordh = document.forms["hotel"]["confirmpasswordh"].value;
        var area = document.forms["hotel"]["area"].value;
        var landmark = document.forms["hotel"]["landmark"].value;
        var package = document.forms["hotel"]["package"].value;
        var hotelimage = document.forms["hotel"]["hotelimage"].value;
        var address = document.forms["hotel"]["address"].value;
        var hotelmap = document.forms["hotel"]["hotelmap"].value;
        var opentime = document.forms["hotel"]["opentime"].value;
        var openDays = document.forms["hotel"]["openDays"].value;
      
        var hotelnameError = document.getElementsByClassName("error2")[0];
        var mobilenohError = document.getElementsByClassName("error2")[1];
        var passwordhError = document.getElementsByClassName("error2")[2];
        var confirmpasswordhError = document.getElementsByClassName("error2")[3];
        var areaError = document.getElementsByClassName("error2")[4];
        var landmarkError = document.getElementsByClassName("error2")[5];
        var packageError = document.getElementsByClassName("error2")[6];
        var hotelimageError = document.getElementsByClassName("error2")[7];
        var addressError = document.getElementsByClassName("error2")[8];
        var hotelmapError = document.getElementsByClassName("error2")[9];
        var opentimeError = document.getElementsByClassName("error2")[10];
        var openDaysError = document.getElementsByClassName("error2")[11];
      
        var error2 = false;

         // Add this line to debug the password validation
        

        var hotelForm = document.getElementById("hotel");

        function validateMobile(mobilenoh) 
        {
          var phoneNumber = /^\d{10}$/;
          if (mobilenoh.match(phoneNumber)) 
          {
              return true;
          }
          else 
          {
              return false;
          }
        }
        
        if (hotelname == "") 
        {
          hotelnameError.innerHTML = "Please enter Hotel name !!!";
          error2 = true;
        } 
        else 
        {
          hotelnameError.innerHTML = "";
        }
      
        if (mobilenoh == "") 
        {
          mobilenohError.innerHTML = "Please enter Mobile number !!!";
          error2 = true;
        } 
        else if (isNaN(mobilenoh)) 
        {
          mobilenohError.innerHTML = "Please enter valid Mobile number !!!";
          error2 = true;
        } 
        else if(!validateMobile(mobilenoh)) 
        {
          mobilenohError.innerHTML = "Mobile number should be 10 digits !!!";
          error2 = true;
        } 
        else 
        {
          mobilenohError.innerHTML = "";
        }

        if (passwordh == "")
        {
          passwordhError.innerHTML = "Please enter your Password !!!";
          error2 = true;
        } 
        else if (!/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@])[A-Za-z\d@]{8,}$/i.test(passwordh))
        {
          passwordhError.innerHTML = "Password must contain at least one letter, one number, and one @ sign!";
          error2 = true;
        }
        else 
        {
          passwordhError.innerHTML = "";
        }


        if (confirmpasswordh == "") 
        {
          confirmpasswordhError.innerHTML = "Please enter your Confirm Password !!!";
          error2 = true;
        }
        else if (passwordh !== confirmpasswordh) 
        {
          confirmpasswordhError.innerHTML = "Password and Confirm Password do not match !!!";
          error2 = true;
        } 
        else 
        {
          confirmpasswordhError.innerHTML = "";
        }
        
        if (area == "") 
        {
          areaError.innerHTML = "Please select an Area !!!";
          error2 = true;
        } 
        else 
        {
          areaError.innerHTML = "";
        }
      
        if (landmark == "") 
        {
          landmarkError.innerHTML = "Please select a Landmark !!!";
          error2 = true;
        } 
        else 
        {
          landmarkError.innerHTML = "";
        }
      
        if (package == "") 
        {
          packageError.innerHTML = "Please select a Package !!!";
          error2 = true;
        } 
        else 
        {
          packageError.innerHTML = "";
        }
      
        if (hotelimage == "") 
        {
          hotelimageError.innerHTML = "Please select an Image !!!";
          error2 = true;
        } 
        else 
        {
          hotelimageError.innerHTML = "";
        }
      
        if (address == "") 
        {
          addressError.innerHTML = "Please enter Hotel Address !!!";
          error2 = true;
        } 
        else 
        {
          addressError.innerHTML = "";
        }
        
        if (hotelmap == "") 
        {
          hotelmapError.innerHTML = "Please select a Map !!!";
          error2 = true;
        } 
        else 
        {
          hotelmapError.innerHTML = "";
        }
      
        if (opentime == "") 
        {
          //console.log("HELLO WORLD !!!");
          opentimeError.innerHTML = "Please select an Opening time !!!";
          error2 = true;
        } 
        else 
        {
          opentimeError.innerHTML = "";
        }

        if(openDays == "")
        {
          console.log("open days !!");
          openDaysError.innerHTML = "Please select an Open days !!!";
          error2 = true;
        }
        else
        {
          openDaysError.innerHTML = "";
        }

        if(error2) 
        {
          event.preventDefault();
        }
        else 
        {
          event.preventDefault(); 
          hotelForm.action = "operation.php"; 
          hotelForm.method = "post"; 
          hotelForm.enctype = "multipart/form-data";
          hotelForm.submit(); 
        }
        
      }
    );
  }

  
  
  
