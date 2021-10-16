<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../simditor/styles/simditor.css">
    <link rel="stylesheet" href="../adminpage/changeContent/style.css">
    <script src="../simditor/site/assets/scripts/jquery.min.js"></script>
    <script src="../simditor/site/assets/scripts/module.js"></script>
    <script src="../simditor/site/assets/scripts/hotkeys.js"></script>
    <script src="../simditor/site/assets/scripts/uploader.js"></script>
    <script src="../simditor/site/assets/scripts/simditor.js"></script>

</head>

<body>
    <div id="menu">
        <div class="logo">InI Logo</div>
        <div class="option" onclick="toDashboard()">Dashboard</div>
        <div class="option" onclick="toAdmin()">Create Content</div>
        <div class="option" onclick="toLogOut()">LogOut</div>
    </div>
    <div id="content">
        <div class="fill">
            <label class="judul">judul</label><br>
            <input type="text" placeholder="Masukkan Judul" id="judul" maxlength="50"><br>
            <br>
            <label class="desc">Deskripsi singkat</label><br>
            <input type="text" placeholder="Deskripsi Singkat" id="desc" maxlength="50">
            <br><br>
            <label>Content</label>
        </div>
        <div id="editorFrame">
            <textarea id="editor"></textarea>
        </div>
        <div id="contentControl">
            <div class="preview" onclick="preview()">Preview</div>
            <div class="submit" onclick="edit()">Submit</div>
        </div>
        <br><br>
        <label for="">Hasil Preview</label>
        <div id="previewFrame"></div>
    </div>
    <script src="../adminpage/changeContent/index.js"></script>
    <script>
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            const myObj = JSON.parse(this.responseText);
            console.log(myObj)
            if (myObj.status) {
                document.getElementById("judul").value = myObj.data[0].judul;
                document.getElementById("desc").value = myObj.data[0].description;
                content = myObj.data[0].tanggal;
            } else {

            }
        }
        xmlhttp.open("GET", "http://localhost:3000/article/<?php echo $data; ?>");
        xmlhttp.send();

        const xmlhttp1 = new XMLHttpRequest();
        xmlhttp1.onload = function() {
            const myObj = this.responseText;
            console.log(myObj)
            editor.setValue(myObj);
        }
        xmlhttp1.open("GET", "http://localhost:3000/articles/<?php echo $data; ?>");
        xmlhttp1.send();

        function edit() {
            var judul = document.getElementById("judul").value;
            var desc = document.getElementById("desc").value;
            var value = editor.getValue();
            if (judul.length == 0 || desc.length == 0 || value.length == 0) {
                alert("please fill input")
            } else {
                //code for upload data to server
                var form = new FormData();
                form.append("judul", judul);
                form.append("desc", desc);
                form.append("content", value);
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    const myObj = JSON.parse(this.responseText);
                    console.log(myObj)
                    if (myObj.status) {
                        //redirect
                        alert("berhasil update");
                        window.location.href = "http://127.0.0.1:8000/admin/dashboard";
                    } else {
                        alert("gagal mengupdate");
                    }
                }
                xmlhttp.open("POST", "http://localhost:3000/edit/<?php echo $data; ?>");
                xmlhttp.send(form);
            }
        }
    </script>
</body>
</html>