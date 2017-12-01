<?php
      require_once('../../db_connect.php');
      
    echo "
    <div class='page-header'>
    <div class='container-fluid'>
      <h2 class='h5 no-margin-bottom'>Messages</h2>
    </div>
  </div>
  <form onsubmit='deleteMessage(); return false;' id='messages-form'>
  <section class='row text-center placeholders'>
      <div class='col-6 col-sm-3 placeholder' id='divDelete'>
   
      <a href='#Delete'>
        <!--button id='delete' type='submit'-->
        <!-- img src='./images/delete icon.jpg' name='delete' width='100' height='100' class='img-fluid rounded-circle' alt='Delete Button' -->
        <input type='hidden' name='action' value='deleteMessage'>
        <input type='image' src='./images/delete icon.jpg' width='100' height='100' class='img-fluid rounded-circle' alt='Delete Button' />
        <!--/button-->
      </a>
      <h4>Delete</h4>
      <span class='text-muted'>Delete Selected Message(s)</span>
    
  </div>
    </section>
  
    <div class='table-responsive' id='fileList'>
      
      
      <table class='table table-striped'>
        <thead>
          <tr>
            <th>Select</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Time stamp</th>
          </tr>
        </thead>
        <tbody>";
        
        // read
                    
          $connection = connect_to_db();
          
      $sql = sprintf("Select * FROM contact WHERE active = 1 ORDER BY time_stamp DESC;");

      // execute query
      $result = $connection->query($sql) or die(mysqli_error());   

      // check whether we found a row
      while ($contact= $result->fetch_assoc())
      {
          echo "<tr>";
          echo "<td><input type='checkbox' id='message-id' name='message-id[]' value='".$contact["id"]."'/></td>";
          echo "<td>".$contact["name"]."</td>";
          echo "<td>".$contact["email"]."</td>";
          echo "<td>".$contact["message"]."</td>";
          echo "<td>".$contact["time_stamp"]."</td>";
          echo "</tr>";
      }
      
      echo "</tbody>
              </table>
            </div>
            </form>
        ";
?>
