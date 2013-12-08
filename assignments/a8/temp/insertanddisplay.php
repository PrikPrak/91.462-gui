<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
  </head>
<body>

<?php

  require "../php/userpass.php";

  // Create connection
   $con=mysql_connect("localhost", DATABASE_USERNAME, DATABASE_PASSWORD);
  #  $con=mysql_connect("localhost", "cprak", "cp6321");


  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $db = "cprak";
          mysql_select_db( $db )
            or die( "<p>Error selecting the database: " .
                    mysql_error() . "</p>" ) ;


  $equation = "testing";

  $result = mysql_query("INSERT INTO a8table VALUES ('" . $equation . "')" )
            or die( "<p>Error insertng into the database: " .
                    mysql_error() . "</p>" ) ;
  

  $result = mysql_query( "SELECT * FROM a8table" )
            or die( "<p>Error selecting data from the database: " .
                    mysql_error() . "</p>" ) ;

        echo "<p>N columns = " . mysql_num_fields( $result ) . "</p>" ;

        echo "<select id='equationPicklist'>";

        while ( $row = mysql_fetch_row( $result ) ) {
          echo "<option value='" . $k . "'>";

          for ( $k = 0 ; $k < mysql_num_fields( $result ) ; $k++ ) {
            echo $row[ $k ];
          }

          echo "</option>";
        }

        echo "</select>";
?>

</body>
</html>
