function banUser()
{

//    var xhr = openAjax();

    // get selected users
    var users = getCheckedBoxes("user-id[]");
    
    // construct URL
    var url = "./ajax_queries/banUser.php?";
    
    var data;
    
    // users.forEach(function(user) {
    //     data = 'user[]:' + user;
    // });
    
    
    $.ajax({
        type: "POST",                                           // GET or POST
        url: url,                                               // Path to file
        data: { 
                  'user[]': users
                 },
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