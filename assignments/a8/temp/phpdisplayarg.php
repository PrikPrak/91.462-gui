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

  (link)
  (description)
-->
    <title></title>
  </head>

  <body>
    <?php

      mysql_connect("localhost", "cprak", "cp6321")
        or die("<p>Error connecting to database: " .
               mysql_error() . "</p>");

      $db = "cprak";
      mysql_select_db($db)
        or die("<p>Error connecting to database: " .
               mysql_error() . "</p>");
     
      echo "tsting";

      $equation = $_REQUEST['#'] ;
      echo "Argument received is " . $equation . "."; 
    ?>    
  </body>
</html>
