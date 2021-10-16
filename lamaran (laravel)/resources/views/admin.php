<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="simditor/styles/simditor.css">
        <link rel="stylesheet" href="adminpage/createContent/style.css">
        <script src="simditor/site/assets/scripts/jquery.min.js"></script>
        <script src="simditor/site/assets/scripts/module.js"></script>
        <script src="simditor/site/assets/scripts/hotkeys.js"></script>
        <script src="simditor/site/assets/scripts/uploader.js"></script>
        <script src="simditor/site/assets/scripts/simditor.js"></script>
        
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
                <label class="judul">Judul</label><br>
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
                <div class="submit" onclick = "submit()">Submit</div>
            </div>
            <br><br>
            <label for="">Hasil Preview</label>
            <div id="previewFrame"></div>
        </div>
        <script src="adminpage/createContent/index.js"></script>
    </body>
</html>