<?php
      require_once('../../db_connect.php');
      
    echo "
    <div class='page-header'>
        <div class='container-fluid'>
            <h2 class='h5 no-margin-bottom'>IP</h2>
        </div>
    </div>
    
    <ul class='nav nav-tabs'>
          <li class='nav-item'>
            <a class='nav-link active' href='#' id='banned-ip-tab'>Banned</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='#' id='insert-ip-tab'>Insert</a>
          </li>
        </ul>
    
    <form onsubmit='banIP(false); return false;' id='banned-ips-form'>
        
        
        <section class='row text-center placeholders'>
          <div class='col-6 col-sm-3 placeholder' id='divBan'>
            <a href='#Ban'>
              <input type='hidden' name='action' value='banIP'>
              <input type='image' src='./images/uploadicon.png' width='100' height='100' class='img-fluid rounded-circle' alt='Ban Button'/>
            </a>
            <h4>Ban</h4>
            <span class='text-muted'>Reactive Selected IP(s)</span>
          </div>
        </section>
    
        <h2>Banned IPs List</h2>";
        
        printUserTable("Select * FROM ip_ban;");
        
      echo "
    </form>
    
    <form onsubmit='banIP(); return false;' id='ban-ip-form'>
        
        <section class='row text-center placeholders'>
          <div class='col-6 col-sm-3 placeholder' id='divBan'>
            <a href='#Ban'>
              <input type='hidden' name='action' value='banIp'>
              <input type='image' src='./images/delete icon.jpg' width='100' height='100' class='img-fluid rounded-circle' alt='Reactivate Button'/>
            </a>
            <h4>Ban</h4>
            <span class='text-muted'>Ban an IP</span>
          </div>
        </section>
        
        <h2>IP to Ban:</h2>";
        echo "<input id='input-ip' name='input-ip' type='text'>";
        echo "<h2>Timeout:</h2>";
        echo "<input id='input-timeout' name='input-timeout' type='text'>";
        echo "

    </form>
</div>";
    
    echo "<script>
    $('#banned-ips-form').show();
    $('#ban-ip-form').hide();
    
    $('#banned-ip-tab').click(function() {
        $('#banned-ips-form').show();
        $('#ban-ip-form').hide();
        $('#banned-ip-tab').removeClass('active');
        $('#insert-ip-tab').addClass('active');
    });
    $('#insert-ip-tab').click(function() {
        $('#banned-ips-form').hide();
        $('#ban-ip-form').show();
        $('#banned-ip-tab').removeClass('active');
        $('#insert-ip-tab').addClass('active');
    });</script>";

function printUserTable($query){
    echo "<table class='table table-striped'>
        <thead>
          <tr>
            <th>Select</th>
            <th>IP</th>
            <th>Time Out</th>
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
      echo "<td><input type='checkbox' id='ip-id' name='ip-id[]' value='".$user["id"]."'/></td>";
      echo "<td>".$user["ipv6"]."</td>";
      echo "<td>".$user["time_out"]."</td>";
      echo "</tr>";
  }
 
 echo "
    </tbody>
  </table>";
}
