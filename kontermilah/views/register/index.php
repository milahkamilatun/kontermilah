<!DOCTYPE HTML>
<html>
    <head>
        <title>Register</title>
        

    <style>
    *{
margin: 0;
padding: 0;
outline: 0;
font-family: 'Open Sans', sans-serif;
}
body{
height: 100vh;
background-image: url(https://dosenit.com/wp-content/uploads/2020/10/Gunung-Fuji-Jepang-1024x640-1.jpg);
background-size: cover;
background-position: center;
background-repeat: no-repeat;
}
p {
color: white;
font-family: 'Open Sans', sans-serif;
padding-top: 10px;
}

h1 {
text-align: center;
padding-left: 65px;
padding-bottom: 20px;
}

a {
color: white;
font-family: 'Open Sans', sans-serif;
}
.container{
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%,-50%);
padding: 20px 25px;
width: 300px;

background-color: rgba(0,0,0,.7);
box-shadow: 0 0 10px rgba(255,255,255,.3);
}
.container h1{
text-align: left;
color: #fafafa;
margin-bottom: 30px;
text-transform: uppercase;
border-bottom: 4px solid #752BEA;
}
.container label{
text-align: left;
color: #90caf9;
}
.container form input{
width: calc(100% - 20px);
padding: 8px 10px;
margin-bottom: 15px;
border: none;
background-color: transparent;
border-bottom: 2px solid #752BEA;
color: #fff;
font-size: 20px;
}
.container form button{
width: 100%;
height: 40px;
padding: 5px 0;
border: none;
background-color:#752BEA;
font-size: 18px;
color: #fafafa;
border-radius: 20px;
}
</style>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    </head>
    <body>
        <div class="container">
        <label><h1>Register</h1></label>
            <form id="sample_form">
                <label for="fullname" class="from-label">fullname</label>
                <br>
                <input type="text" class="from-control" id="fullname">
                <br>
                <label for="email" class="from-label">email</label>
                <br>
                <input type="email" class="from-control" id="email">
                <br>
                <label for="password" class="from-label">password</label>
                <br>
                <input type="password" class="from-control"  id="password">
                <br>
                <label for="role" class="from-label">role</label>
                <br>
                <input type="text" class="form-control" id="role" value="Owner" disabled>
                <br>
                <br>
                <button type="submit" class="btn btn-primary" id="action_button" >Register</button>
                <p> Sudah punya akun?
                  <a href="http://localhost:8080/kontermilah/views/login/index.php">Login di sini</a>
                </p>
            </form>
        </div>
        <script>
            $(document).ready(function() {
                
                $('#sample_form').on('submit', function(event){
                    event.preventDefault();
                    
                    var formData = {
                    'fullname' : $('#fullname').val(),
                    'email' : $('#email').val(),
                    'password' : $('#password').val(),
                    'role' : $('#role').val()
                    }
                    $.ajax({
                        url:"http://localhost:8080/kontermilah/api/auth/register.php",
                        method:"POST",
                        data: JSON.stringify(formData),
                        success:function(data){
                            $('#action_button').attr('disabled', false);
                            $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
                            window.location.href = 'http://localhost:8080/kontermilah/views/login/index.php'
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                });
            });
        </script>
    </body>
</html>

