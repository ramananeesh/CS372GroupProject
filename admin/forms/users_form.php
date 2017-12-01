<?php
      require_once('../../db_connect.php');
      
    echo "
    <div class='page-header'>
        <div class='container-fluid'>
            <h2 class='h5 no-margin-bottom'>Users</h2>
        </div>
    </div>
    
    <ul class='nav nav-tabs'>
          <li class='nav-item'>
            <a class='nav-link active' href='#' id='active-users-tab'>Active</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='#' id='banned-users-tab'>Banned</a>
          </li>
        </ul>
    
    <form onsubmit='banUser(); return false;' id='active-users-form'>
        
        
        <section class='row text-center placeholders'>
          <div class='col-6 col-sm-3 placeholder' id='divBan'>
            <a href='#Ban'>
              <input type='hidden' name='action' value='banUser'>
              <input type='image' src='./images/delete icon.jpg' width='100' height='100' class='img-fluid rounded-circle' alt='Ban Button'/>
            </a>
            <h4>Ban</h4>
            <span class='text-muted'>Ban Selected Users(s)</span>
          </div>
        </section>
    
        <h2>Active User List</h2>";
        
        printUserTable("Select * FROM users WHERE banned = 0 ORDER BY username");
        
        echo "
    </form>
    
    <form onsubmit='banUser(false); return false;' id='banned-users-form'>
        
        <section class='row text-center placeholders'>
          <div class='col-6 col-sm-3 placeholder' id='divReactivate'>
            <a href='#Reactivate'>
              <input type='hidden' name='action' value='reactivateUser'>
              <input type='image' src='./images/uploadicon.png' width='100' height='100' class='img-fluid rounded-circle' alt='Reactivate Button'/>
            </a>
            <h4>Reactivate</h4>
            <span class='text-muted'>Reactivate Selected Users(s)</span>
          </div>
        </section>
        
        <h2>Banned User List</h2>
        
        <div class='table-responsive' id='bannedUserList'>";
          printUserTable('Select * FROM users WHERE banned = 1 ORDER BY username');
            echo "
            </div>
        </form>
    </div>";
    
    echo "<script>
    $('#active-users-form').show();
    $('#banned-users-form').hide();
    
    $('#active-users-tab').click(function() {
        $('#active-users-form').show();
        $('#banned-users-form').hide();
        $('#active-users-tab').removeClass('active');
        $('#banned-users-tab').addClass('active');
    });
    $('#banned-users-tab').click(function() {
        $('#active-users-form').hide();
        $('#banned-users-form').show();
        $('#banned-users-tab').removeClass('active');
        $('#active-users-tab').addClass('active');
    });</script>";


function printUserTable($query){
    echo "<table class='table table-striped'>
        <thead>
          <tr>
            <th>Select</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Join Date</th>
          </tr>
        </thead>
        <tbody>";
              
  // read

  $sql = sprintf($query);
  
  $connection = connect_to_db();
  
  // execute query
  $result = $connection->query($sql) or die(mysqli_error());   

  // check whether we found a row
  while ($user= $result->fetch_assoc())
  {
      echo "<tr>";
      echo "<td><input type='checkbox' id='user-id' name='user-id[]' value='".$user["id"]."'/></td>";
      echo "<td>".$user["username"]."</td>";
      echo "<td>".$user["name"]."</td>";
      echo "<td>".$user["email"]."</td>";
      echo "<td>".$user["dateActive"]."</td>";
      echo "</tr>";
  }
 
 echo "
    </tbody>
  </table>";
}
