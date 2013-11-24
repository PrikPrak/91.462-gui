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

  // CP
  drawTicks();

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

    //redraw
    drawCurve();

    
    drawTicks();
  }

  // Gets the fragment identifier value.
  function getHashValue(){
    return location.hash.substr(1);
  }

  // Sets the fragment identifier value.
  function setHashValue(value){
    return location.hash = value;
  }

  function drawTicks(){

    // These are used inside of the following for loop.
    var i, j, interval,

    // These vary between xMin/xMax and yMin/yMax.
    xPixel, yPixel, 

    // These vary between 0 and 1.    
    percentX, percentY,

    // These are in math coordinates.
    mathX, mathY;

    c.beginPath();

    // Draw border around graph.
    c.moveTo(0, 0);
    c.moveTo(canvas.width, 0);
    c.moveTo(0, canvas.height);

    // Draw X and Y lines. 
    c.moveTo(0, (canvas.height/2));
    c.lineTo(canvas.width, (canvas.height/2));

    c.moveTo((canvas.width/2), 0);
    c.lineTo((canvas.width/2), canvas.height);

    c.moveTo(0, (canvas.height)/2);
    c.lineTo(canvas.width, (canvas.height)/2);

    j = 0;

    for (i = xMin; i < xMax; i++){  

      // Simple fraction which determines the "intervals" at 
      // which points will be drawn to/from. Larger n values 
      // means more points means, which means more lines drawn, 
      // ultimately resulting in a more accurate drawing. The (n-1)
      // ensures that we are able to get to 1, which is a problem
      // due to the need for i to start at 0.
      percentX = j / (xMax - xMin);
      percentY = ((yMax - yMin) - 1) / (yMax - yMin);

      // Computes where the point on the X plane should be
      // based on the "intervals" given by percentX, and the
      // given ranges which come from xMin and xMax. 
      mathX = percentX * (xMax - xMin) + xMin;

      mathY = percentY * (yMax - yMin) + yMin;

     //     // User input accepted here
     //     mathY = evaluateMathExpr(mathX);

     //     percentY = (mathY - yMin) / (yMax - yMin);


     // Flip to match canvas coordinates, as 0,0 is top left.
     percentY = 1 - percentY;

     // Points Of the X and Y percentages (based on ranges x/y Min/Max, 
     // in proportion to the size of the "canvas". Makes drawings 
     // to scale, pretty nifty! 
     xPixel = percentX * canvas.width; 
     yPixel = percentY * canvas.width;

     c.moveTo(xPixel, canvas.width/2);
     c.lineTo(xPixel, ((canvas.width/2) + (yPixel/2)));

     textC.fillStyle = "black";
     textC.font = "bold 10px Arial";
     textC.fillText(i, xPixel, (canvas.width/2) + yPixel);

     c.moveTo(canvas.width/2, xPixel);
     c.lineTo((canvas.width/2) + (yPixel/2), xPixel);

     textC.fillText(i, (canvas.width/2) + (yPixel), xPixel);

     j++;
     }    

     c.stroke();
  }
}

