<?php
      require_once('../../db_connect.php');
      
    echo "
             <div class='page-header'>
            <div class='container-fluid'>
              <h2 class='h5 no-margin-bottom'>Files</h2>
            </div>
          </div>
          
          <form action='' method='post'>
          <section class='row text-center placeholders'>
              <div class='col-6 col-sm-3 placeholder' id='divDelete'>
           
              <a href='#Delete'>
                <!--button id='delete' type='submit'-->
                <!-- img src='./images/delete icon.jpg' name='delete' width='100' height='100' class='img-fluid rounded-circle' alt='Delete Button' -->
                <input type='hidden' name='action' value='deleteFile'>
                <input type='image' src='./images/delete icon.jpg' width='100' height='100' class='img-fluid rounded-circle' alt='Delete Button' />
                <!--/button-->
              </a>
              <h4>Delete</h4>
              <span class='text-muted'>Delete Selected Files(s)</span>
            
          </div>
            </section>
          
            <div class='table-responsive' id='fileList'>
              <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>";
        
        // read
                    
          $connection = connect_to_db();
          
     // read
                    
      $sql = sprintf("Select * FROM files ORDER BY upload_date DESC");

      // execute query
      $result = $connection->query($sql) or die(mysqli_error());   

      // check whether we found a row
      while ($file= $result->fetch_assoc())
      {
          echo "<tr>";
          echo "<td><input type='checkbox' id='file-id' name='file-id[]' value='".$file["id"]."'/></td>";
          echo "<td>".$file["fname"]."</td>";
          echo "<td>".$file["size"]."</td>";
          echo "<td>".$file["upload_date"]."</td>";
          echo "</tr>";
      }
      echo "</tbody>
              </table>
            </div>
            </form>
        ";
?>
