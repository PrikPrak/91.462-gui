<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
<body>

<?php

  require "./userpass.php";

  // Create connection
   $con=mysql_connect("localhost", DATABASE_USERNAME, DATABASE_PASSWORD);

  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $db = "cprak";
          mysql_select_db( $db )
            or die( "<p>Error selecting the database: " .
                    mysql_error() . "</p>" ) ;


  $equation = $_REQUEST['inputField'];

  $result = mysql_query("INSERT INTO a8table VALUES ('" . $equation . "')" )
            or die( "<p>Error insertng into the database: " .
                    mysql_error() . "</p>" ) ;

  echo "Added " . $equation . " to database.";

  echo "<p><a href='../main.php'>Return to Page</a></p>";
?>

</body>
</html>
