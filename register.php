<link rel="stylesheet" href="./login.css">



<section>
    <form class="registerForm" id="loginForm" method="POST">
        Username: <input type="text" class="login" id="username" name="username" required>
        <br>
        Password: <input type="password" class="login" id="password" name="password" required>
        <br>
        Confirm: <input type="password" id="confirm-password" class="login" required>
        <br>
        <button type="button" id="register"> Register</button>
    </form>
</section>


</html>

<script>
    var register = $("#register");



    register.click(function (e) {
        var username = $('#username').val();
        var password = $('#password').val();
        var confirm = $('#confirm-password').val();
        if (password === confirm && username != "" && password != "") {
            $.ajax({
                type: "POST",
                url: "register_processing.php",
                data: {
                    username: username,
                    password: password
                },

                success: function (response) {
                    alert(response);
                    if (response == "Registered successfully") {
                        header('Location: index.php?page=login')
                    }
                }
            });
        } else if (password != confirm){
            alert('Your confirm must be the same as your password');
        } else if (username == "") {
            alert("username must not be empty");
        } else if (password == ""){
            alert("password must not be empty");
        } 
    });

</script>