<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<!--
  Filename: addequationtodatabase.php
  91.461 Assignment 8: Saving Graphing Formulae in a Server-Side Database
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.

  Last Updated by CP on December 10th, 2013
  Created by CP on December 8th, 2013

  CREDITS:

  http://stackoverflow.com/questions/12328354/calling-a-particular-php-function-on-form-submit
  Referred to this link in writing this file.  

  Jesse Heines
  Providing resources in course lecture which describe the method 
  of defining a username and password within a separate file. Usable 
  content in this file is completely attributed to the resources 
  found in the lecture. 
-->
    <title>addequationtodatabase.php</title>
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

      echo "Successfully Added " . $equation . " to database! " . "<a href='../main.php'>Click here</a> to return to previous page, or simply navigate back. If you do navigate backwards, changes may not be seen until the page is refreshed.";
    ?>
  </body>
</html>
