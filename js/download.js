
function download(){
    
    var link;
    
    uuid = document.getElementById("basic-url").value;
    
    if(uuid === null || uuid === ""){
        sweetAlert("Error","Your UUID field is empty.","error");
    }
    else{
        link = "./ajax_queries/fileDownload.php?origin=../download.php&file=".concat(String(uuid));
        window.location=link;
    }
    
    return false;
}