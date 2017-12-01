function banUser()
{

//    var xhr = openAjax();

    // get selected users
    var users = getCheckedBoxes("user-id[]");
    
    // construct URL
    var url = "./ajax_queries/banUser.php?";
    
    users.forEach(function(user) {
        url += "user[]=" + user + "&";
    });
    
    // // ban users
    // xhr.onreadystatechange =
    // function()
    // {
    //     // only handle loaded requests
    //     if (xhr.readyState == 4)
    //     {
    //         if (xhr.status == 200)
    //         {
    //             // insert user
    //             alert('this worked!');
    //         }
    //         else
    //             alert("Error with Ajax call!");
    //     }
    // }
    // xhr.open("GET", url, true);
    // xhr.send(null);
    
    $.ajax({
        type: "GET",                                           // GET or POST
        url: url,                                               // Path to file
        timeout: 2000,                                          // Waiting time
        beforeSend: function() {                                // Before Ajax 
          //$content.append('<div id="load">Loading</div>');      // Load message
        },
        complete: function() {                                  // Once finished
          //$('#load').remove();                               // Clear message
        },
        success: function(data) {                               // Show content
            alert("Ajax sent!");
          //$content.html( $(data).find('#container') ).hide().fadeIn(400);
        },
        fail: function() {                                      // Show error msg 
            alert("Error with Ajax call!");
          //$('#panel').html('<div class="loading">Please try again soon.</div>');
        }
    });
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