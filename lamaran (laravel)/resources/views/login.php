<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            html,
            body {
                background-color: #b9d5f8;
                width: 100%;
                height: 100%;
            }

            #LoginFrame {
                position: relative;
                width: 30%;
                left: 35%;
                top: 30%;
                background-color: white;
            }

            .judul {
                width: auto;
                font-size: 35px;
                text-align: center;
                margin-top: 15px;
            }

            .user {
                width: 80%;
                margin: auto;
                margin-top: 15px;
            }

            #username {
                display: block;
                height: 30px;
                width: 98%;
                background-color: #d9d9d9;
            }

            .pass {
                width: 80%;
                margin: auto;
                margin-top: 15px;
            }

            #password {
                display: block;
                height: 30px;
                width: 98%;
                background-color: #d9d9d9;
            }

            .submit {
                width: 80%;
                margin: auto;
                margin-top: 15px;
                text-align: center;
                font-size: 25px;
                padding-top: 5px;
                padding-bottom: 5px;
                background-color: #5c9cf0;
            }
        </style>
    </head>

    <body>
        <div id="LoginFrame">
            <div class="judul">Login Admin</div>
            <div class="user"><input type="text" id="username" placeholder="Username"></div>
            <div class="pass"><input type="password" id="password" placeholder="Password"></div>
            <div class="submit" onclick="submit()">Login</div>
            <br>
        </div>
        <script>
            function submit() {
                var username = document.getElementById("username").value;
                var password = document.getElementById("password").value;
                if (username.length == 0 || password.length == 0) {
                    alert("please fill the input")
                }
                else {
                    var form = new FormData();
                    form.append("username", username);
                    form.append("password", password);
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function () {
                        const myObj = JSON.parse(this.responseText);
                        console.log(myObj)
                        if (myObj.state) {
                            //redirect
                            <?php
                                session_start();
                                $_SESSION["state"] = "aktif";
                            ?>
                            window.location.href = "http://127.0.0.1:8000/admin";
                        }
                        else {
                            alert("gagal login, username atau password salah")
                        }
                    }
                    xmlhttp.open("POST", "http://localhost:3000/login");
                    xmlhttp.send(form);
                }
            }
        </script>
    </body>

</html>