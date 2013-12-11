
<body>
<?php
// Create connection
$con=mysql_connect("localhost","cprak","cp6321");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$db = "cprak";
        mysql_select_db( $db )
          or die( "<p>Error selecting the database: " .
                  mysql_error() . "</p>" ) ;

$result = mysql_query( "SELECT * FROM a8table" )
          or die( "<p>Error selecting data from the database: " .
                  mysql_error() . "</p>" ) ;

        echo "<p>N columns = " . mysql_num_fields( $result ) . "</p>" ;
  
        echo "<table cellspacing='0' cellpadding='5' border='1'>";
        while ( $row = mysql_fetch_row( $result ) ) {
          echo "<tr>" ;
          for ( $k = 0 ; $k < mysql_num_fields( $result ) ; $k++ ) {
            echo "<td>" . $row[ $k ] . "</td>" ;
          }
          echo "</tr>" ;
        }
        echo "</table>";

?>
</body>
