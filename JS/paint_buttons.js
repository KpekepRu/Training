	gold_button = "border-bottom:3px solid #e6f0a3;background: #e6f0a3;background: -moz-linear-gradient(top,  #e6f0a3 0%, #d2e638 50%, #c3d825 51%, #dbf043 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#e6f0a3), color-stop(50%,#d2e638), color-stop(51%,#c3d825), color-stop(100%,#dbf043));background: -webkit-linear-gradient(top,  #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%);background: -o-linear-gradient(top,  #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%);background: -ms-linear-gradient(top,  #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%);background: linear-gradient(to bottom,  #e6f0a3 0%,#d2e638 50%,#c3d825 51%,#dbf043 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e6f0a3', endColorstr='#dbf043',GradientType=0 );";
	green_button = "border-radius: 10px;border-bottom:3px solid #9ED929;background-color:#9DD929;background:-webkit-gradient(linear,left bottom,left top,color-stop(0.02, rgb(123,192,67)),color-stop(0.51, rgb(139,198,66)),color-stop(0.87, rgb(158,217,41)));background: -moz-linear-gradient(center bottom,rgb(123,192,67) 2%,rgb(139,198,66) 51%,rgb(158,217,41) 87%);-webkit-border-top-left-radius:5px;-webkit-border-top-right-radius:5px;-moz-border-radius:5px 5px 0px 0px;";

	choosed_color = 0;
	left_color = "black";
	right_color = "white";

	function tool_edit(x, el)
	{
		tool = x;
		var el1 = document.getElementById("pb1"); 
		var el2 = document.getElementById("pb2"); 
		var el3 = document.getElementById("pb3"); 
		var el4 = document.getElementById("pb4"); 
		var el5 = document.getElementById("pb5"); 
		el1.style.cssText = green_button;
		el2.style.cssText = green_button;
		el3.style.cssText = green_button;
		el4.style.cssText = green_button;
		el5.style.cssText = green_button;
		el.style.cssText = gold_button;
	}

	function brush_edit(x, el)
	{
		context.lineWidth = x;
		var el1 = document.getElementById("bs1"); 
		var el2 = document.getElementById("bs2"); 
		var el3 = document.getElementById("bs3"); 
		var el4 = document.getElementById("bs4"); 
		el1.style.cssText = green_button;
		el2.style.cssText = green_button;
		el3.style.cssText = green_button;
		el4.style.cssText = green_button;
		el.style.cssText = gold_button;
	}

	function fill_edit(x, el)
	{
		fill = x;
		var el1 = document.getElementById("fb1"); 
		var el2 = document.getElementById("fb2"); 
		el1.style.cssText = green_button;
		el2.style.cssText = green_button;
		el.style.cssText = gold_button;
	}

	function erase()
	{
		context.fillStyle = "rgb("+red2+","+green2+","+blue2+")";
		context.fillRect(0, 0, 400, 400);
		context.fillStyle = "rgb("+red1+","+green1+","+blue1+")";
	}

	function choose_color(el)
	{
		if (el == document.getElementById("big_color_left")) 
		{
			var el1 = document.getElementById("big_color_right"); 
			el1.style.cssText = "border-color: black; z-index: 1;background-color:" + right_color;
			choosed_color = 0;
			el.style.cssText = "border-color: gold; z-index: 2;background-color:" + left_color;
		}
		else 
		{
			var el1 = document.getElementById("big_color_left"); 
			el1.style.cssText = "border-color: black; z-index: 1;background-color:" + left_color;
			choosed_color = 1;
			el.style.cssText = "border-color: gold; z-index: 2;background-color:" + right_color;
		}
	}

	function change_color(el)
	{
		if (choosed_color == 0)
		{
			var i = 4;
			var t = 4;
			left_color = getComputedStyle(el, null).backgroundColor;;
			var el1 = document.getElementById("big_color_left"); 
			el1.style.cssText = "border-color: gold; z-index: 2; background-color:" + left_color;
			while (left_color.charAt(i) != ',') i++; 
			red1 = left_color.substr(t,i-t); t=i+2; i++;
			while (left_color.charAt(i) != ',') i++; 
			green1 = left_color.substr(t,i-t);t=i+2; i++;
			while (left_color.charAt(i) != ')') i++;
			blue1 = left_color.substr(t,i-t);
			context.strokeStyle="rgb("+red1+","+green1+","+blue1+")";
			context.fillStyle="rgb("+red1+","+green1+","+blue1+")";
		}
		if (choosed_color == 1)
		{
			var i = 4;
			var t = 4;
			right_color = getComputedStyle(el, null).backgroundColor;;
			var el1 = document.getElementById("big_color_right"); 
			el1.style.cssText = "border-color: gold; z-index: 2; background-color:" + right_color;
			while (right_color.charAt(i) != ',') i++; 
			red2 = right_color.substr(t,i-t); t=i+2; i++;
			while (right_color.charAt(i) != ',') i++; 
			green2 = right_color.substr(t,i-t);t=i+2; i++;
			while (right_color.charAt(i) != ')') i++;
			blue2 = right_color.substr(t,i-t);
		}
	}

	function move_value(el)
	{
		change = 1;
		var el1;
		if (el == document.getElementById("red_range"))
			el1 = document.getElementById("range_field_red");
		if (el == document.getElementById("green_range"))
			el1 = document.getElementById("range_field_green");
		if (el == document.getElementById("blue_range"))
			el1 = document.getElementById("range_field_blue");
		el.onmousemove=function()
		{
			if (change)
			{
				el1.value = el.value;
				new_color();
			}
			document.onmouseup=function()
			{
			change = 0;
			}
		}
	}

	/*$(function()                                                 //Плохо работающая функция. Надо обязательно починить!
  	{
		$('#range_field_red').keypress(function (e) 
		{
			//alert(e.which);
			el = document.getElementById("range_field_red");
			el1 = document.getElementById("red_range");
			if (el.value > 255) el.value = 255;
			if (el.value < 0) el.value = 0;
			el1.value = el.value;
			new_color();
    	});
	});*/

	function new_color()
	{
		var el1 = document.getElementById("color_field");
		var red = document.getElementById("red_range").value;
		var green = document.getElementById("green_range").value;
		var blue = document.getElementById("blue_range").value;
		el1.style.cssText = "background-color: rgb(" +red+ ", " +green+ ", " +blue+ ")";
	}

	function zero(el)
	{
		el.value = '';
	}