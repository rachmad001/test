var mysql = require('mysql');
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "lamaran",
    port: 3307
})

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
});

var fs = require('fs');

var express = require('express');
var fileUpload = require('express-fileupload');
var cors = require('cors');
const { dirname } = require('path');
var app = express();

app.use(fileUpload());
app.use(cors());
app.use(express.static(__dirname));

// app.get('/', express.static(__dirname));
app.post('/uploads', (req, res) => {
    let theFiles = req.files.upload_file;
    var currentDate = new Date();
    var y = currentDate.getFullYear().toString();
    var m = currentDate.getMonth().toString();
    var d = currentDate.getDate().toString();
    var h = currentDate.getHours().toString();
    var min = currentDate.getMinutes().toString();
    var sec = currentDate.getSeconds().toString();
    var dateTime = currentDate.getDate().toString();
    let destUpload = __dirname + '/upload/'+ y + "-" + m + "-" + d + "-" + h + "-" + min + "-" + sec + "-" + theFiles.name;

    theFiles.mv(destUpload, (err) => {
        if (err) {
            console.log("error upload : " + err.msg)
            return res.json(
                { 
                    success: false,
                    msg: "fail to upload",
                    file_path: ""
                }
            ) 
        }
        res.json(
            {
                success: true,
                msg: "success to upload",
                file_path: "http://localhost:3000/upload/" + dateTime + "-" + theFiles.name
            }
        )
    })
})

app.post('/add', (req, res) => {
    var judul = req.body.judul;
    var desc = req.body.desc;
    var content = req.body.content;
    var currentDate = new Date();
    var y = currentDate.getFullYear().toString();
    var m = currentDate.getMonth().toString();
    var d = currentDate.getDate().toString();
    var h = currentDate.getHours().toString();
    var min = currentDate.getMinutes().toString();
    var sec = currentDate.getSeconds().toString();
    var dateTime = y + "-" + m + "-" + d + "-" + h + "-" + min + "-" + sec;

    fs.writeFile("articles/"+ dateTime + ".html", content, (err) => {
        if (err) {
            res.json({status: false})
        }else {
            con.query("insert into content values(?, ?,?)", [dateTime + ".html", judul, desc], (err, result) => {
                if (err){
                    console.log(err);
                    res.json({status: false});
                }
                if (result.length == 0){
                    res.json({status: false});
                } else {
                    res.json({status: true})
                }
            })
        }
    })
});

app.get('/content', (req, res) => {
    con.query("select * from content", (err, result) => {
        if (err) {
            res.json({status: false})
        } else {
            res.json({status: true, data: result});
        }
    })
})

app.post('/login', (req, res) => {
    con.query("SELECT * from user where username=? and password=?", [req.body.username, req.body.password], (err, result) => {
        if (err){
            res.json({state: false});
        }
        if (result.length == 0) {
            res.json({state: false});
        }else {
            res.json({state: true, user: result});
        }
    })
})

app.get('/article/:id', (req, res) => {
    con.query("SELECT * FROM content where tanggal=?", [req.params.id], (err, result) => {
        if (err) {
            res.json({status: false, msg: err.msg});
            console.log(err)
        } else {
            fs.readFile('articles/' + req.params.id, (err, content) => {
                if (err) {
                    res.json({status: false, msg: err.msg});
                } else {
                    res.json({
                        status: true,
                        data: result,
                        article: content
                    });
                }
            })
        }
    })
})

app.post('/edit/:id', (req, res) => {
    var judul = req.body.judul;
    var desc = req.body.desc;
    var content = req.body.content;
    var id = req.params.id;
    fs.writeFile("articles/"+ id, content, (err) => {
        if (err) {
            res.json({status: false})
        }else {
            con.query("update content set judul=?, description=? where tanggal=?", [judul, desc, id], (err, result) => {
                if (err){
                    console.log(err);
                    res.json({status: false});
                }
                if (result.length == 0){
                    res.json({status: false});
                } else {
                    res.json({status: true})
                }
            })
        }
    })
})

app.post('/delete/:id', (req, res) => {
    con.query('delete from content where tanggal=?', [req.params.id], (err, result) => {
        if (err){
            res.json({status: false})
        }else {
            res.json({status: true})
        }
    })
})
app.listen(3000, () => {
    console.log('http://localhost:3000');
})