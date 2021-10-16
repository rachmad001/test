<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            display: grid;
            grid-template-columns: 20% auto 10% 10% 10%;
            background-color:  #c2c2c2;
            font-size: 20px;
        }
        .logo {
            padding: 10px;
        }
        .option {
            text-align: center;
            padding: 10px;
        }
        .option:hover {
            background-color: #999999;
        }
        #content {
            width: 60%;
            margin: auto;
            margin-top: 25px;
            display: grid;
            grid-template-columns: auto auto auto;
            grid-column-gap: 15px;
            border: 1px solid red;
        }
        .listContent {
            margin-top: 10px;
            border-radius: 10px;
            border: 1px solid grey;
            position: relative;
            padding: 10px;
        }

        .listContent hr {
            height: 10px;
            background-color: black;
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">InI LoGo</div>
        <div></div>
        <div class="option" onclick="guest()">Home</div>
        <div class="option">menu</div>
        <div class="option">menu</div>
    </div>
    <div id="content"></div>
    <script>
        var content = document.getElementById("content");
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            const myObj = this.responseText;
            console.log(myObj)
            content.innerHTML = myObj;
        }
        xmlhttp.open("GET", "http://localhost:3000/articles/<?php echo $id; ?>");
        xmlhttp.send()

        function guest() {
            window.location.href = "http://127.0.0.1:8000/";
        }
    </script>
</body>
</html>