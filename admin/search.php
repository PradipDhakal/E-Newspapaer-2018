<?php

//require configuration file
require_once('../configuration/configuration.php');
//require database connection
require_once(ROOT . 'application/database.php');

$output = '';

if ( !empty($_POST['query'] )) {
    $searchData = $_POST['query'];
    $query = "SELECT * FROM tbl_users WHERE
              name LIKE '%$searchData%'
               || username LIKE '%$searchData%'
               || email LIKE '%$searchData%'
               || user_type LIKE '%$searchData%'
               || status LIKE '%$searchData%'               
                ";
    $result = mysqli_query($connection, $query);
    $output .= "
    <table border='1' class='table table-hover'>
    <tr>
    <td>S.N</td>
    <td>Name</td>
    <td>Username</td>
    <td>Email</td>
    <td>UserType</td>
    <td>Status</td>
    </tr>
    ";

    foreach ($result as $key => $value) {
        $output .= "
    <tr>
    <td>" . ++$key . "</td>
    <td>" . $value['name'] . "</td>
    <td>" . $value['username'] . "</td>
    <td>" . $value['email'] . "</td>
    <td>" . $value['user_type'] . "</td>
    <td>" . $value['status'] . "</td>
       
</tr>
    ";
    }

    echo $output;

}

