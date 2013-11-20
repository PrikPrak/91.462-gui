      var canvas = document.getElementById('myCanvas'), 
          c = canvas.getContext('2d'), 
      
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
          expr = 'sin(x)*x', 
          scope = { x: 0 },
          tree = math.parse(expr, scope);
     
 
drawCurve();

function drawCurve(){
          
// These are used inside of the following for loop.
    
   var i, 
       
   // These vary between xMin/xMax and yMin/yMax.
   xPixel, yPixel, 

   // These vary between 0 and 1.    
   percentX, percentY,
  
   // These are in math coordinates.
   mathX, mathY;
  
   c.beginPath();
   for (i = 0; i < n; i++){
       percentX = i / (n - 1);
       mathX = percentX * (xMax - xMin) + xMin;
       
       // User input accepted here
       mathY = evaluateMathExpr(mathX);
     
       percentY = (mathY - yMin) / (yMax - yMin);

       xPixel = percentX * canvas.width; 
       yPixel = percentY * canvas.width;
       c.lineTo(xPixel, yPixel);
   }

   c.stroke();
}

function evaluateMathExpr(mathX){
  scope.x = mathX;
  return tree.eval();  
}
