/*
  File: graph.js
  91.461 Assignment (number): (title)
  Corey Prak, UMass Lowell Computer Science, corey_prak@student.uml.edu
  Copyright (c) 2013 by Corey Prak.  All rights reserved.

  Last Updated by CP on November 24th, 2013
  Created by CP on November 19th, 2013

  NOTES:

  Much credits to Curran Kelleher for more than half of the contributing code
  for the assignment. More information can be found here:
  https://github.com/curran/screencasts/tree/gh-pages/grapher

  Major changes added on to Curran's code is found in the function drawGraphLabels().

  CREDITS:

  http://stackoverflow.com/questions/278940/vertical-text-with-jquery
  Vertical text with jQuery.

  http://www.w3schools.com/tags/canvas_filltext.asp
  HTML Canvas text resource found here, used in labeling the tick marks with
  numbers. 

  http://www.w3schools.com/html/html5_canvas.asp
  Resource used in understanding the HTML Canvas.
*/

function graph(){
  var canvas = document.getElementById('myCanvas'), 
      
    c = canvas.getContext('2d'), 
  
    textC = canvas.getContext('2d'),

    // 'n' Represents the number of line segments.
    n = 100, 

    // Defines the ranges of the math "window".
    //X coordinates.
    xMin = -10, 
    xMax = 10,

    //Y coordinates.
    yMin = -10, 
    yMax = 10, 

    math = mathjs(), 

    // 'expr' will contain the math expression as a string.
    expr = '',

    // Assigned to expr if there isn't a URL hash upon page load.
    defaultExpr = 'sin(x+t)*x', 

    scope = { 
        x: 0, 
        t: 0
    },

    tree, 

    time = 0, 
    timeIncrement = 0.1;

  // This is the main program. 
  setExprFromHash();
  initTextField();
  startAnimation();

  // Update math expression from the has value found in the URL.
  // Uses default if there isn't one. 
  window.addEventListener('hashchange', setExprFromHash);

  function setExprFromHash(){
    var hash = getHashValue();

    if(hash){
      setExpr(hash);
    } else {
      setExpr(defaultExpr);
      setHashFromExpr(expr);
    }

    $('#inputField').val(expr);
  }

  function setExpr(newExpr){
    expr = newExpr;

    tree = math.parse(expr, scope);
  }

  function setHashFromExpr(){
    setHashValue(expr); 
  }

  function drawCurve(){

    // These are used inside of the following for loop.
    var i, 

    // These vary between xMin/xMax and yMin/yMax.
    xPixel, yPixel, 

    // These vary between 0 and 1.    
    percentX, percentY,

    // These are in math coordinates.
    mathX, mathY;

    // Clear the canvas.
    c.clearRect(0, 0, canvas.width, canvas.height);  

    c.beginPath();
    for (i = 0; i < n; i++){
      percentX = i / (n - 1);
      mathX = percentX * (xMax - xMin) + xMin;

      // User input accepted here
      mathY = evaluateMathExpr(mathX);

      percentY = (mathY - yMin) / (yMax - yMin);

      // Flip to match canvas coordinates.
      percentY = 1 - percentY;

      xPixel = percentX * canvas.width; 
      yPixel = percentY * canvas.width;
        
      c.lineTo(xPixel, yPixel);
    }

    c.stroke();
  }

  function evaluateMathExpr(mathX){
    scope.x = mathX;
    scope.t = time;
    return tree.eval();  
  }  

  function initTextField(){
    var input = $('#inputField');

    // Set the initial text value programmatically using jQuery.
    input.val(expr);

    // Listen for any changes using jQuery
    input.keyup(function (event){
      setExpr(input.val());
      setHashValue(expr);
    });
  }

  function startAnimation(){
    (function animLoop(){
      requestAnimationFrame(animLoop);
      render();
    }());
  }

  function render(){
    // Increment time.
    time += timeIncrement;

    // Redraw.
    drawCurve();

    // This is my "hook", where my additions are called within this function.
    drawGraphLabels();
  }

  // Gets the fragment identifier value.
  function getHashValue(){
    return location.hash.substr(1);
  }

  // Sets the fragment identifier value.
  function setHashValue(value){
    return location.hash = value;
  }

  function drawGraphLabels(){

    // These are used inside of the following for loop.
    var i, j, interval,

    // These vary between xMin/xMax and yMin/yMax.
    xPixel, intervalPixel; 

    // Text used to display numbers and markers for each plane. 
    textC.fillStyle = "black";
    textC.font = "bold 12px Arial";
 
    c.beginPath();

    // Draw X and Y lines. 
    c.moveTo(0, (canvas.height/2));
    c.lineTo(canvas.width, (canvas.height/2));

    c.moveTo((canvas.width/2), 0);
    c.lineTo((canvas.width/2), canvas.height);

    c.moveTo(0, (canvas.height)/2);
    c.lineTo(canvas.width, (canvas.height)/2);

    j = 0;

    // Draw ticks for X axis.
    for (i = xMin; i <= xMax; i++){  
  
      // This will be used as an interval based on the given ranges for x.
      interval = j / (xMax - xMin);

      // Computes the "length" of the interval, this is what will determine
      // how the tick is drawn.
      singleIntervalLength = ((yMax - yMin) - 1) / (yMax - yMin);
      
      // Flip!
      singleIntervalLength = 1 - singleIntervalLength;

      // Of the interval and a single "length" of one, find its position 
      // in proportion to the size of the canvas.
      pixelPos = interval * canvas.width; 
      intervalPixel = singleIntervalLength * canvas.width;

      // Move to position of the specific interval.
      c.moveTo(pixelPos, canvas.width/2);

      // On the x axis at the current position given by pixelPos, 
      // draw a line from the x axis DOWN to about 1/3 of the length
      // of an interval.
      c.lineTo(pixelPos, ((canvas.width/2) + (intervalPixel/3)));

      // No need for each axis to label (0,0) twice, just remove it entirely. 
      // This is very ugly, as I hard coded the positions of exactly where I
      // wanted the labels to show up. Will probably fix in the future just
      // because this bugs the heck out of me. 
      if (i != 0){
        textC.fillText(i, pixelPos, (canvas.height/2) + ((intervalPixel/2) + 4));
      }

      // Hard code a position to label the axis. Will stay somewhat proportionate..
      if (i == xMin){
          textC.fillText("X-Axis", (intervalPixel/4), (canvas.width/2) - (intervalPixel));
      }

      j++;
    }    

    // Reusing j and a bunch of other variables, just reset this first.
    j = 0;

    for (i = yMin; i <= yMax; i++){  
  
      // This will be used as an interval based on the given ranges for x.
      interval = j / (yMax - yMin);

      // Computes the "length" of the interval, this will determine how the 
      // tick is drawn.
      singleIntervalLength = ((yMax - yMin) - 1) / (yMax - yMin);

      // Flip!
      singleIntervalLength = 1 - singleIntervalLength;

      // Of the interval and a single "length" of one, find its position 
      // in proportion to the size of the canvas.  
      pixelPos = interval * canvas.height; 
      intervalPixel = singleIntervalLength * canvas.height;

      // Move to position of the specific interval.
      c.moveTo(canvas.width/2, pixelPos);

      // At every interval among the Y axis, draw a line from there
      // to about a thid of the way to the right of the length of an 
      // interval. 
      c.lineTo( (intervalPixel/3) + (canvas.height/2), pixelPos);

      // No need for each axis to label (0,0) twice, just remove it entirely. 
      // This is very ugly, as I hard coded the positions of exactly where I
      // wanted the labels to show up. Will probably fix in the future just
      // because this bugs the heck out of me.       
      if (i != 0){
        textC.fillText((i * -1), (canvas.width/2) + (intervalPixel/3), pixelPos + 7);
      }

      // Hard code a position to label the axis. Will stay somewhat proportionate...
      if (i == yMin){
          textC.fillText("Y-Axis", (canvas.width/2) - (intervalPixel * 2), (intervalPixel/2));
      }

      j++;
    }    

    c.stroke();
  }
}

