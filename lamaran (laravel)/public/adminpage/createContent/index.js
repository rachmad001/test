Simditor.locale = 'en-US';
var editor = new Simditor({
    textarea: $('#editor'),
    upload: {
        url: 'http://localhost:3000/uploads/',
        params: null,
        fileKey: 'upload_file',
        connectionCount: 1,
        leaveConfirm: 'Uploading is in progress, are you sure to leave?'
    },
    toolbar: [
        'title',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        'fontScale',
        'color',
        'ol',
        'ul',
        'blockquote',
        'code',
        'table',
        'link',
        'image',
        'hr',
        'indent',
        'outdent',
        'alignment'
    ]
})

function preview() {
    var value = editor.getValue();
    document.getElementById("previewFrame").innerHTML = value;
    console.log(value);
}

function submit() {
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
        xmlhttp.onload = function () {
            const myObj = JSON.parse(this.responseText);
            console.log(myObj)
            if (myObj.status) {
                //redirect
                alert("berhasil menambahkan");
                window.location.href = "http://127.0.0.1:8000/admin";
            }
            else {
                alert("gagal menambahkan")
            }
        }
        xmlhttp.open("POST", "http://localhost:3000/add");
        xmlhttp.send(form);
    }
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