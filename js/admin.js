function listUsers()
{
    // construct URL
    var url = "./admin/forms/users_form.php";
    
    // collect data
    
    var data ="";
    
    var result = makeAjaxRequest("GET", url, data,  function(d) {
        $("#user-section").html(d);
    });
}

function listMessages()
{
    // construct URL
    var url = "./admin/forms/messages_form.php";
    
    // collect data
    
    var data ="";
    
    var result = makeAjaxRequest("GET", url, data,  function(d) {
        $("#message-section").html(d);
    });
}

function listFiles()
{
    // construct URL
    var url = "./admin/forms/files_form.php";
    
    // collect data
    var data ="";
    
    var result = makeAjaxRequest("GET", url, data,  function(d) {
        $("#file-section").html(d);
    });
}

function listIPs()
{
    // construct URL
    var url = "./admin/forms/ip_form.php";
    
    // collect data
    var data ="";
    
    var result = makeAjaxRequest("GET", url, data,  function(d) {
        $("#ip-section").html(d);
    });
}

function banUser(ban = true)
{
    
    // get selected users
    var users = getCheckedBoxes("user-id[]");
    
    // construct URL
    var url = "./ajax_queries/banUser.php";
    
    // collect data
    var data = { 'user[]': users, ban: ban};
    
    var result = makeAjaxRequest("POST", url, data,  function(d) { listUsers(); });
    
}

function deleteMessage()
{
    
    // get selected users
    var messages = getCheckedBoxes("message-id[]");
    
    // construct URL
    var url = "./ajax_queries/deleteMessage.php";
    
    // collect data
    var data = { 'message[]': messages};
    
    var result = makeAjaxRequest("POST", url, data,  function(d) { listMessages(); });
    
    
}

function deleteFile()
{
    
    // get selected users
    var files = getCheckedBoxes("file-id[]");
    
    // construct URL
    var url = "./ajax_queries/fileDelete.php";
    
    // collect data
    var data = { 'delete[]': files};
    
    var result = makeAjaxRequest("POST", url, data,  function(d) { listFiles(); });
    
    
}


function fileList(ban = true)
{
    
    // get selected users
    var users = getCheckedBoxes("user-id[]");
    var user = users[0];
    
    // construct URL
    var url = "./ajax_queries/fileList.php?user=" + String(user);
    
    // collect data
    var data = { 'user': user};
    
    data = "";
    
    var result = makeAjaxRequest("GET", url, data,  function() { ; });
    
}

function banIP(ban = true)
{
    
    // get selected users
    var ips = getCheckedBoxes("ip-id[]");
    
    // construct URL
    var url = "./ajax_queries/banIP.php";
    
    // collect data
    var data = { 'ip[]': ips, ban: ban};
    
    var result = makeAjaxRequest("POST", url, data,  function(d) { listIPs(); });
    
    
}

function makeAjaxRequest(type, url, data, func){
    
    
    $.ajax({
        type: type,                                           // GET or POST
        url: url,                                               // Path to file
        data: data,
        timeout: 2000,                                          // Waiting time
        beforeSend: function() {                                // Before Ajax 
          //$content.append('<div id="load">Loading</div>');      // Load message
        },
        complete: function() {                                  // Once finished
          //$('#load').remove();                               // Clear message
        },
        success: function(data){
            func(data);
        },
        fail: function() {                                      // Show error msg 
            alert("Error with Ajax call!");
          //$('#panel').html('<div class="loading">Please try again soon.</div>');
        }
    });
}


// Pass the checkbox name to the function
function getCheckedBoxes(chkboxName) {
  var checkboxes = document.getElementsByName(chkboxName);
  var checkboxesChecked = [];
  // loop over them all
  for (var i=0; i<checkboxes.length; i++) {
     // And stick the checked ones onto an array...
     if (checkboxes[i].checked) {
        checkboxesChecked.push(checkboxes[i].value);
     }
  }
  // Return the array if it is non-empty, or null
  return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}