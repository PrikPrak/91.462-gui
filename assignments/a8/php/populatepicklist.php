<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<!--
  91.461 Assignment (number): (title)
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.
  Created by CP on (date)

  NOTES:

  (date - text)

  CREDITS:

  http://www.w3schools.com/php/php_includes.asp
  How to inlcude and requre PHP code. Useful in refactoring.

  (link)
  (description)
-->
    <title></title>
  </head>

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
         
         # yecho "<p>N columns = " . mysql_num_fields( $result ) . "</p>" ;
         
         echo "<select id='equationPicklist'>";
         
         while ( $row = mysql_fetch_row( $result ) ) {
         # echo "<option value='" . $k . "'>";
         
         for ( $k = 0 ; $k < mysql_num_fields( $result ) ; $k++ ) {
           echo "<option value='" . $row[ $k ] . "'>" . $row[ $k ];
         }
                             
         echo "</option>";
         }
                             
         echo "</select>";
                             
      ?>    
  </body>
</html>
