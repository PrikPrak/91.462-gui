<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
<!--
  Filename: main.php
  91.461 Assignment 8: Saving Graphing Formulae in a Server-Side Database
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.

  Last Updated by CP on December 10th, 2013
  Created by CP on November 19th, 2013

  NOTES:

  This file was originally used in a different assignment, thus edit history is kept.

  Horribly coded, I would have liked to make this more modular instead of 
  statically declaring certain aspects of the canvas, such as number labels.

  CREDITS:
  
  http://www.w3schools.com/tags/att_input_size.asp
  Modify size of text input size.

  http://net.tutsplus.com/tutorials/html-css-techniques/the-easiest-way-to-create-vertical-text-with-css/
  Ideas to vertically print text.

  http://www.w3schools.com/css/css3_borders.asp
  How to create borders in CSS. 

  http://www.w3schools.com/jquery/eff_animate.asp
  JQuery animation for error message to flash in opacity. 
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

          msg = $("#message");

          try{
            tree = math.parse(expr, scope);
            tree.eval();
          }
          catch(err){
            console.log(err);
            msg.html("ERROR: Invalid function, cannot be saved. Enter a valid function and try again.");
            event.preventDefault();

            for ( var i=0; i < 5; i++){
              msg.animate({opacity:'0.2'},"fast");
              msg.animate({opacity:'1'},"fast");         
            }
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

        <?php require "./php/populatepicklist.php"; ?>  
      </form>
         
      <p id="message" class="errorText"></p>

      <canvas width=500 height=500 id="myCanvas"></canvas>
    </div>        
  </body>
</html>
