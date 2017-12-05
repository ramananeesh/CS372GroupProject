<?php

    require_once('./db_connect.php');
    $connection = connect_to_db();

    $sql="select count(id) as noUsers from users";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noUsers=$connection->real_escape_string($row['noUsers']);
    //echo "<script>alert(\"No of users : $noUsers\")</script>";
    $sql="select count(id) as noFiles from files";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noFiles=$connection->real_escape_string($row['noFiles']);
    
    $sql="select count(id) as noNewFiles from files where upload_date=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewFiles=$connection->real_escape_string($row['noNewFiles']);
    
    $sql="select count(id) as noNewUsers from users where dateActive=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewUsers=$connection->real_escape_string($row['noNewUsers']);
    
    $sql="select count(id) as noMessages from contact where active=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noMessages=$connection->real_escape_string($row['noMessages']);
    
    $sql="select count(id) as noNewMessages from contact where active=1 and date(time_stamp)=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewMessages=$connection->real_escape_string($row['noNewMessages']);
    
    $sql="select count(id) as noDownloads from transactions where upload=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noDownloads=$connection->real_escape_string($row['noDownloads']);
    
    $sql="select count(id) as noBannedUsers from users where banned=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noBannedUsers=$connection->real_escape_string($row['noBannedUsers']);
?>