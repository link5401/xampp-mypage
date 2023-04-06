<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./login.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    <section>
        <form action="" id="loginForm" method="POST">
            Username: <input class="login" id="username" type="text" name="username" placeholder="Username" autofocus required>
            <br>
            Password: <input class="login" id="password" type="password" name="password" placeholder="password" required>
            <br>

            <button type="submit"> Login</button>
            <span class="error" id="notification"></span>
        </form>
    </section>
</body>


</html>
<script>
    // Get the form element and add an event listener for form submission
    var loginForm = document.getElementById("loginForm");
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission behavior
        // Get the input values
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        // Create a new XMLHttpRequest object
        var xhttp = new XMLHttpRequest();

        // Define a function to be executed when the request is complete
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    // This code will be executed when the server responds with a status code of 200 OK

                    var notification = document.getElementById("notification");
                    notification.innerHTML = this.responseText;
                    console.log(this.responseText);
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', 'session.php');
                    xhr.onload = function() {
                        console.log(xhr.responseText)
                        if (xhr.status == 200 && xhr.responseText == "true") {
                            console.log('session');
                            window.location.replace("index.php?page=home");
                        }
                    };
                    xhr.send();


                } else {
                    // This code will be executed when the server responds with an error status code
                    console.log("Error: " + this.status);
                }
            }
        };

        // Set the request method and URL
        xhttp.open("POST", "login_processing.php", true);

        // Set the request headers
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        // Create an object with the login data to be sent in the request body

        // Send the request with the login data in the request body
        xhttp.send("username=" + username + "&password=" + password);

    });
</script>