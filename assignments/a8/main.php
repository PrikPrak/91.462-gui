<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<!--
  91.461 Assignment 7: Creating a Graphing Calculator Using the HTML Canvas
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.

  Created by CP on November 19th, 2013
  Last Updated by CP on November 24th, 2013
  Updated by CP on November 19th, 2013

  NOTES:

  Horribly coded, I would have liked to make this more modular instead of 
  statically declaring certain aspects of the canvas, such as number labels.

  CREDITS:
  
  http://www.w3schools.com/tags/att_input_size.asp
  Modify size of text input size.

  http://net.tutsplus.com/tutorials/html-css-techniques/the-easiest-way-to-create-vertical-text-with-css/
  Ideas to vertically print text.

  http://www.w3schools.com/css/css3_borders.asp
  How to create borders in CSS. 
-->
    <title>Graphing Calculator</title>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/math.min.js"></script>
    <script src="js/graph.js"></script>
    <link rel="stylesheet" href="./css/styles.css">

    <script>
      $(document).ready(function(){
        graph();

        // jQuery event on the submit buttton to validate submission.
        $("#inputForm").submit(function(event){
          expr = $("#inputField").val(),      
          math = mathjs(),
          scope = {
            x: 0,
            t: 0
          };

          tree = '';

          try{
            tree = math.parse(expr, scope);
            tree.eval();
          }

          catch(err){
            console.log(err);
            $("#message").html("ERROR: Invalid function, cannot be saved");
            event.preventDefault();
          }

        });
      });
    </script>
  </head>
  <body>

    <div class="centerText">
      <a href="../../index.html">Back to Home...</a>

      <h1>Assignment 7: Creating a Graphing Calculator Using the HTML Canvas </h1>
      
      <p>
        <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fweblab.cs.uml.edu%2F~cprak%2FGUI_A5.html">HTML5</a> 
        +
        <a href="http://jigsaw.w3.org/css-validator/check/referer\">CSS3</a> validated!
      </p>

      Corey Prak, corey_prak@student.uml.edu
    </div>

    <div>
      Enter function in text field provided below in terms of x or t (time). 
      Have a function you'd like to save? Click on the button provided to add
      it to the drop down menu. You could also use the drop down menu to select
      and load previously saved functions. Enjoy!
      <form id="inputForm" method="post" action="./php/addequationtodatabase.php">
        <input type="text" class="inputField" id="inputField" name="inputField">
 
        <input type="submit" value="Save Function" name="submit">  

      <!-- Reach out to the database and populate a picklist upon 
           designated database and table -->
          <?php require "./php/populatepicklist.php"; ?>
      </form>
         
      <div id="message"></div>

      <canvas width=500 height=500 id="myCanvas"></canvas>
    </div>        

  </body>
</html>
