<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<!--
  Filename: populatepicklist.php
  91.461 Assignment 8: Saving Graphing Formulae in a Server-Side Database
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.

  Last Updated by CP on December 10th, 2013
  Created by CP on December 8th, 2013

  NOTES:

  I have no clue why I cannot unclude ./userpass.php in here, and have spent
  much time in trying to figure out why... Would really appreciate the help.

  CREDITS:

  Jesse Heines
  Providing resources in course lecture which describe the method 
  of defining a username and password within a separate file. Usable 
  content in this file is completely attributed to the resources 
  found in the lecture. 

  http://www.w3schools.com/php/php_includes.asp
  How to inlcude and requre PHP code. Useful in refactoring.
-->
    <title>populatepicklist.php</title>
  </head>

  <body>
    <?php
      // Create connection
      $con=mysql_connect("localhost", "cprak", "cp6321");

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
         
      echo "<select id='equationPicklist'>";
         
      while ( $row = mysql_fetch_row( $result ) ) {
        for ( $k = 0 ; $k < mysql_num_fields( $result ) ; $k++ ) {
          echo "<option value='" . $row[ $k ] . "'>" . $row[ $k ];
        }
                             
        echo "</option>";
      }
                             
      echo "</select>";                             
    ?>    
  </body>
</html>
