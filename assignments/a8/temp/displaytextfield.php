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
 <div class="formCenter">
      <form name="tableForm" id="tableForm" method="POST" action="displaytextfield.php">
        <input type="text" name="h1" id='h1'>
        <input type="submit" value="click">
      </form>
 </div>

    <?php
      $arg = $_REQUEST['h1'];

      echo "Arg received was " . $arg . "."; 
    ?>
    
  </body>
</html>
