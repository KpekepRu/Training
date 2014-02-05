window.onload=function()
{
	
	window.captureEvents(Event.MOUSEDOWN | Event.MOUSEUP);
	
	elem = document.getElementById('paint');
	context = elem.getContext('2d');
	context.fillStyle = 'white';
	context.fillRect(0, 0, 400, 400);

	context.lineCap="round";
	context.fillStyle = 'black';
	context.strokeStyle = "black";
	context.lineWidth = 2;

	var top = 0;
	var left = 0;

	$('#right_marker').on('click', function(e)
    {
        var el = document.getElementById("block_2").hidden = false; 
        var el = document.getElementById("block_1").hidden = true; 
	    top  = elem.offsetTop;
	    left = elem.offsetLeft;
    });
	red1 = 0;
	green1 = 0;
	blue1 = 0;

	red2 = 255;
	green2 = 255;
	blue2 = 255;

	tool = 1;
	draw = false;
	fill = true;

	x1 = 0;
	y1 = 0;

	x2 = 0;
	y2 = 0;

	document.onmousemove = mousemove;
	elem.onmousedown = start_drawing;
	elem.onmousemove = drawing;

	var el1 = document.getElementById("pb1"); 
	el1.style.cssText = gold_button;

	el1 = document.getElementById("bs1"); 
	el1.style.cssText = gold_button;

	el1 = document.getElementById("fb1"); 
	el1.style.cssText = gold_button;

	el1 = document.getElementById("big_color_left");
	el1.style.cssText = "border-color: gold; z-index: 2";

	function start_drawing()
	{
		draw = 1;
		x2 = inX();
		y2 = inY();
		context.beginPath();
		if (tool != 5)
		{
			context.beginPath();
			context.moveTo(inX(), inY());
			context.lineTo(inX(), inY());
			context.stroke();
		}
		if (tool == 3) context.closePath();
		if (tool == 5)
		{
			context.lineCap = "butt";
			context.fillStyle = "red";
			context.fillStyle = "rgb("+red2+","+green2+","+blue2+")";
			context.fillRect(x2, y2, width(), width());
		}

		document.onmouseup=function()
		{
			

			if (tool == 2 && draw)
			{
				context.lineTo(inX(), inY());
				context.stroke();
			}
			if (tool == 3 && draw)
			{
				context.beginPath();
				context.arc(x2, y2, hypo(x2,y2), 0, 360);
				context.stroke();
				if (fill) context.fill();
			}
			if (tool == 4 && draw)
			{
				context.rect (x2, y2, inX()-x2, inY()-y2);
				context.stroke();
				if (fill) context.fill();
			}
			if (tool == 5)
			{
				context.strokeStyle="rgb("+red1+","+green1+","+blue1+")";
				context.fillStyle="rgb("+red1+","+green1+","+blue1+")";
				context.lineCap = "round";
			}
			draw = 0;
			context.closePath();
		}
	}

	function drawing()
		{
			if (draw && tool == 1)
			{
				context.lineTo(inX(), inY());
				context.moveTo(inX(), inY());
				context.stroke();
			}
			if (draw && tool == 5)
			{
				context.fillRect(inX(), inY(), width(), width());
			}
		}

	function mousemove(event) 
	{
        x1 = event.clientX;
        y1 = event.clientY;
    }

    function inX()
    {
    	return x1-left-3;
    }

    function inY()
    {
    	return y1-top-3;
    }

    function hypo(x,y) 
    {
    	q = (inX()-x)*(inX()-x)+(inY()-y)*(inY()-y);
    	return (Math.sqrt(q));
    }

    function width()
    {
    	q = context.lineWidth;
    	return q;
    }

};
