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
            grid-row-gap: 15px;
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

        .action {
            width: 30%;
            display: grid;
            grid-template-columns: max-content max-content;
            grid-column-gap: 10px;
        }

        .button {
            padding: 7px;
            width: fit-content;
        }

        .read {
            background-color: green;
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
            const myObj = JSON.parse(this.responseText);
            console.log(myObj)
            if (myObj.status) {
                //redirect
                for (var i = 0; i < myObj.data.length; i++) {
                    content.innerHTML += '<div class="listContent">' +
                        '<h1>' + myObj.data[i].judul + '</h1>' +
                        '<hr>' +
                        '<p>' + myObj.data[i].description + '</p>' +
                        '<div class="action">' +
                        '<div class="button read" onclick="read(\'' + myObj.data[i].tanggal + '\')">Baca Selengkapnya</div>' +
                        '</div>' +
                        '</div>';
                }
            } else {

            }
        }
        xmlhttp.open("GET", "http://localhost:3000/content");
        xmlhttp.send()

        function read(id) {
            window.location.href = "http://127.0.0.1:8000/read/"+id;
        }

        function guest() {
            window.location.href = "http://127.0.0.1:8000/";
        }
    </script>
</body>
</html>