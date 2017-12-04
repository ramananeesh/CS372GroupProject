
function download(){
    
    var link;
    
    uuid = document.getElementById("basic-url").value;
    
    if(uuid === null || uuid === ""){
        alert("Your UUID field is empty.");
    }
    else{
        link = "./ajax_queries/fileDownload.php?origin=../download.php&file=".concat(String(uuid));
        window.location=link;
    }
    
    return false;
}