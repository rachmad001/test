<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #menu {
            position: fixed;
            left: 0;
            top: 0;
            width: 25%;
            height: 100%;
            background-color: #a1a1a1;
            color: white;
            text-align: center;
        }

        .logo {
            font-size: 30px;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .option {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .option:hover {
            background-color: #808080;
        }

        #content {
            width: 70%;
            margin-left: 30%;
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

        .edit {
            background-color: green;
        }

        .delete {
            background-color: red;
        }
    </style>
</head>

<body>
    <div id="menu">
        <div class="logo">InI Logo</div>
        <div class="option" onclick="toDashboard()">Dashboard</div>
        <div class="option" onclick="toAdmin()">Create Content</div>
        <div class="option" onclick="toLogOut()">LogOut</div>
    </div>
    <div id="content">
    </div>
    <div class="action">
        <div class="button edit">edit</div>
        <div class="button">hapus</div>
    </div>
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
                        '<div class="button edit" onclick="edit(\'' + myObj.data[i].tanggal + '\')">edit</div>' +
                        '<div class="button delete" onclick="hapus(\'' + myObj.data[i].tanggal + '\')">hapus</div>' +
                        '</div>' +
                        '</div>';
                }
            } else {

            }
        }
        xmlhttp.open("GET", "http://localhost:3000/content");
        xmlhttp.send()

        function edit(id) {
            window.location.href = "http://127.0.0.1:8000/edit/" + id;
        }

        function hapus(id) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const myObj = JSON.parse(this.responseText);
                console.log(myObj)
                if (myObj.status) {
                    //redirect
                    alert("berhasil hapus");
                    window.location.href = "http://127.0.0.1:8000/admin/dashboard";
                } else {
                    alert("gagal menghapus")
                }
            }
            xmlhttp.open("POST", "http://localhost:3000/delete/"+id);
            xmlhttp.send();
        }

        function toDashboard() {
            window.location.href = "http://127.0.0.1:8000/admin/dashboard";
        }

        function toAdmin() {
            window.location.href = "http://127.0.0.1:8000/admin"
        }

        function toLogOut() {
            window.location.href = "http://127.0.0.1:8000/login"
        }
    </script>
</body>

</html>