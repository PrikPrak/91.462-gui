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
      function display()
      { 
      echo "hello" .$_POST["studentname"];
      }
     if(isset($_POST['submit']))
     {
       display();
     }
    ?>
    
  </body>
</html>
