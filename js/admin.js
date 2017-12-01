function banUser()
{

    var xhr = openAjax();

    // get selected users
    var users = getCheckedBoxes("user-id[]");
    
    // construct URL
    var url = "./ajax_queries/banUser.php?";
    
    users.forEach(function(user) {
        url += "user[]=" + user + "&";
    });
    
    // ban users
    xhr.onreadystatechange =
    function()
    {
        // only handle loaded requests
        if (xhr.readyState == 4)
        {
            if (xhr.status == 200)
            {
                // insert user
                alert('this worked!');
            }
            else
                alert("Error with Ajax call!");
        }
    }
    xhr.open("GET", url, true);
    xhr.send(null);
}

function openAjax(){
    // instantiate XMLHttpRequest object
    try
    {
        xhr = new XMLHttpRequest();
    }
    catch (e)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // handle old browsers
    if (xhr == null)
    {
        alert("Ajax not supported by your browser!");
        return;
    }
    
    return xhr;
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