        function validateForm(e) {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var err_username=document.getElementById("err-username");
            var err_password=document.getElementById("err-password");
            var isValid = true;
            
            if(isValid == true){ 
              
                if (username === "") {
                    err_username.innerHTML="Please enter the username";
                    e.preventDefault();
                    isValid=false;
                    }
                else if (username != "") {
                        err_username.innerHTML="";
                        }
        
                if (password === "") {
                    err_password.innerHTML="Please enter the password";
                    e.preventDefault();
                    isValid=false;
                    }
                else if (password != "") {
                        err_password.innerHTML="";
                        }
            
            }
            return isValid;
        }
