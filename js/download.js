
function download(){
    uuid = document.getElementById("basic-url").value;
    var link = "./ajax_queries/fileDownload.php?file=".concat(String(uuid));
    window.location=link;
    return false;
}
