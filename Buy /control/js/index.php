<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>	
<script type="text/javascript" src="./jsapi.js"></script>
<script type="text/javascript" src="./corechart.js"></script>
<script type="text/javascript" src="./jquery.gvChart-1.0.1.min.js"></script>
<script>
	gvChartInit();
	$(document).ready(function(){
		let a = function(){
			$('#oldday').gvChart({
				chartType: 'PieChart',
				gvSettings: {
					width: 500,
					height: 350
				}
			});
		}
		$.ajax({
			url:"php.php",
			type:"post",
			data:{
				"test":"2"
			}
		}).then(function(e){
			obj = JSON.parse(e);
			for(let i =0 ; i< obj.length ;i++ )	{
				$("#th").append(
					$('<th></th>').text(obj[i]["x"])
				)
			}
			for(let i =0 ; i< obj.length ;i++ )	{
				$("#td").append(
					$('<td></td>').text(obj[i]["y"])
				)
			}
			a();
		}) 
	});
</script>	
<div style="width:500px;">
	<table id='oldday'>
		<thead >
			<tr id = "th">
				<th>ProductName</th>
				
			</tr>
		</thead>
		<tbody>
			<tr id = "td">
				<th>qutity</th>	
			</tr>
		</tbody>
	</table>
</div>
