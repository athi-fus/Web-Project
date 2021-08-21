<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} 
else {
    // Redirect them to the login page
    header("Location: login.html");
}
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <script src="https://kit.fontawesome.com/6a2ce70579.js" crossorigin="anonymous"></script>

        <style> 
        
        body{
            /* background-image: url("cats.jpg");*/
            height: 100%;
            background-image: linear-gradient(to bottom right, rgb(102, 178, 2535), rgb(0, 0, 102));
        }

        input[type=text], input[type=email], input[type=password]{
          width: 100%;
          padding: 12px 20px;
          margin: 3px 0;
          box-sizing: border-box;
          border: 3px solid #ccc;
          -webkit-transition: 0.5s;
          transition: 0.5s;
          outline: none;
        }

        input[type=submit]{
          width: 100%;          
          outline: none;
          font-size: 1rem;
          background-color: #4B83AE;
          border: 0;
          color: white;
          padding: 16px 32px;
          text-decoration: none;
          margin: 4px 2px;
          cursor: pointer;

        }
        
         input:not(#submit):focus {
          border: 3px solid #555;
        }
        label{
            font-family: Arial, Helvetica, sans-serif;
            font-size:medium;
            color: rgb(43, 11, 58);
        }

       .suf {
            background-color: rgba(240, 240, 240, .8);
            display: block;
            width: 400px;
            
            border: 4px solid rgb(43, 11, 58);
            padding: 50px;
            margin: auto;
            border-radius: 5%;
            height: 400px;
            padding-top: 60px;

        }

        .su {
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 4.5rem;
            font-weight: bolder;
            color: azure;
            padding-bottom: 30px;
            padding-top: 15px;

            
        }


        fieldset {
            border: 0;
            float: left;
        }

        .gen_group {
            display: block;
            width: 300px;
            padding: 100px;
        }



        /* The message box is shown when the user clicks on the password field */
        #message {
        display:none;
        color: rgb(39, 39, 39);
        position: relative;
        padding: 1px;
        margin-top: 5px;
        padding-left: 10px;
        padding-bottom: 10px;
        border-radius: 3%;
        }

        .msg{
            background-color: rgba(240, 240, 240, 0.8);
            font-family: Arial, Helvetica, sans-serif;
            display: grid;
            width: 380px;
            border: 5px solid rgb(161, 78, 255);
            
            float:left;
            border-radius: 3%;
            position: absolute;
            top: 150px;
            left: 67%;
            animation-name: example;
            animation-duration: 3s;
            }

            @keyframes example {
            0%   { left:67%; top:-900px;}
            25%  { left:67%; top:-900px;}
            50%  { left:67%; top:-350px;}
            75%  { left:67%; top:-350px;}
            100% { left:67%; top:-350px;}
            }


        #message span {
        padding: 10px 35px;
        font-size: 14px;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
        color: green;
        }

        .valid:before {
        font-family: "Font Awesome 5 Free";  
        position: relative;
        left: -35px;
        font-weight: 900;
        content: "\f00c";
        }

        /* Add a red text color and an "x" icon when the requirements are wrong */
        .invalid {
        color: rgb(155, 2, 2);
        }

        .invalid:before {
        font-family: "Font Awesome 5 Free"; 
        position: relative;
        left: -35px;
        font-weight: 900;
        content: "\f00d";
        }


        /*----------------------------------------------------*/
        .field-icon {
            float: right;
            margin-left: -32px;
            margin-top: 23px;
            margin-right: 4px;
            position: relative;
            z-index: 2;
        }

        .container{
            padding-top:50px;
            margin: auto;
        }



        span{
          font-family: Arial, Helvetica, sans-serif;
        }

        #form-messages {
        background-color: rgb(255, 232, 232);
        border: 3px solid red;
        color: red;
        display: none;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 5px;
        padding: 10px 25px;
        max-width: 250px;
        font-family: Arial, Helvetica, sans-serif;
        position: absolute;
            top: 180px;
            left: 40.3%;
        border-radius: 5%;
    }
        #demo{
            position: absolute;
            top: 240px;
            left: 41.5%;
            font-family:Arial, Helvetica, sans-serif;
            color: red;
            font-size: 14px;
        }
        </style>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
        <img src="image.png" width="30" height="30" class="d-inline-block align-top" alt="">
        harHARias</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Me</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="changeuname.php">Change Username</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="changepass.php">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </li>
            
        </div>
        </nav>


        <div class="su">
             <span>Change your username:</span>
        </div>
        
        <div class="suf">
            
                
        <form name="theform" action="update_uname.php" method="POST">   
        <input type="text" id="unameo" name="unameo"  required onKeyup="checkform()" onblur="checkOldName()"><br>
                <label for="uname">&nbsp;Old username</label><br><br>
                
                
                <input type="text" id="unamen" name="unamen"  required onKeyup="checkform()"><br>
                <label for="uname">&nbsp;New username</label><br><br>
                

                <input id="submit" name="submit" type="submit" value="Change" >
            
    </form>      
        </div>

        <p id="demo"></p>
       
        <ul id="form-messages"></ul> 
        
        

        <div class="msg" id="message">
            <h3>Password must contain the following:</h3>
            <span id="letter" class="invalid">A <b>symbol</b> character</span><br>
            <span id="capital" class="invalid">A <b>capital (uppercase)</b> letter</span><br>
            <span id="number" class="invalid">A <b>number</b></span><br>
            <span id="length" class="invalid">Minimum <b>8 characters</b></span><br>
        </div>
    

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="jquery.js"></script>

        <script type="text/javascript">
            var myPwd = document.getElementById("see");/*<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
            var myInput = document.getElementById("pwd");
            var letter = document.getElementById("letter"); /*change to symbol etc<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
            var capital = document.getElementById("capital");
            var number = document.getElementById("number");
            var length = document.getElementById("length");

            function myFunction() {
                var x = document.getElementById("pwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            } 

            const form = {
            email: document.getElementById('email'),
            password: document.getElementById('pwd'),
            submit: document.getElementById('submit'),
            messages: document.getElementById('form-messages')
        };

        form.submit.addEventListener('click', () => {
            const request = new XMLHttpRequest();

            request.onload = () => {
                let responseObject = null;

                try {
                    responseObject = JSON.parse(request.responseText);
                } catch (e) {
                    console.error('Could not parse JSON!');
                }

                if (responseObject) {
                    handleResponse(responseObject);
                }
            };

            const requestData = `email=${form.email.value}&pwd=${form.password.value}`;

            request.open('post', 'check-login.php');
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            request.send(requestData);
        });

        function handleResponse (responseObject) {
            if (responseObject.ok) {
                //start session here
                //pass email as the session variable 
                location.href = 'main_user.php';
                
            } else {
                while (form.messages.firstChild) {
                    form.messages.removeChild(form.messages.firstChild);
                }

                responseObject.messages.forEach((message) => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    form.messages.appendChild(li);
                });

                form.messages.style.display = "block";
            }
        }




        //---------------------------------------------------------------------------------------------------------

        var userName= <?php echo json_encode($_SESSION['uname']); ?>;
        //document.getElementById("demo").innerHTML =userName;// THAT WAS VERY USEFUL
        
        function checkOldName(){
            var old = document.getElementById("unameo").value;

            if(old.localeCompare(String(userName))===0){
                //document.getElementById("demo").innerHTML = "YES"; //will erase probably
            }
            else{
                if(old.localeCompare("")==0){
                    document.getElementById("demo").innerHTML = "Fill in the field.";
                }
                else{
                    document.getElementById("demo").innerHTML = "Passwords don't match.Please try again.";
                }
            }
        }

        </script>    
    </body>
     

</html>

