<?php  
	//Group Members: 
	//160419131 - Billy Renatasiva
	//160419130 - Mario Matthew Cardinal Vincent
	//160419129 - Jerriel Rhemaldy
?>
<!DOCTYPE html>
<html>
<head>
	<title>Proximitry Mattrix</title>
	<script type="text/javascript" src="jquery.js"></script>
	<style type="text/css">
		table * {
			border: 1px solid black;
			text-align: center;
		}
	</style>
</head>
<body>
	<label>Number of Object </label><input type="number" id="object" class="input"><br>

	<label>Number of Attribute </label><input type="number" id="attribute" class="input"><br>

	<input type="button" id="btngo" value="GO">

	<div id="table">
	</div>

	<div id="proximitymatrix">
	</div>

	<script type="text/javascript">
		$('body').on('click', '#btngo', function(){
			var	object = parseInt($("#object").val());
			var	attribute = parseInt($("#attribute").val());
			var html = "";

			$('#table').empty();
			html += "<table>";
			for (var i = 0; i <= object; i++) {
				if (i == 0) {
					html += "<tbody>";
					html += "<tr>";
				}
				else {
					html += "<tr>";
					
				}
				for (var j = 0; j < attribute; j++) {
					if (i == 0) {
						if (j == 0) {
							html += "<td></td>";
						}
						html += "<td>Attr " + (j+1) + "</td>";
						if (j == attribute){
							html += "</tr>";
						}
					}
					else {
						if (j == 0) {
							html += "<td> Obj " + i + "</td>";
						}
						html += "<td><input type='number' id='obj" + i + "attr" + (j+1) + "'></td>";
						if (j == attribute){
							html += "</tr>";
						}
					}
				}
			}
			html += "</tbody></table><br>";
			html += '<label>Method  </label>';
			html +=	'<select id="cbomethod">';
			html +=		'<option>Pilih Metode</option>';
			html +=		'<option value="L1">L1</option>';
			html +=		'<option value="L2">L2</option>';
			html +=		'<option value="L&infin;">L&infin;</option>';
			html +=		'<option value="Cosine Similarity">Cosine Similarity</option>';
			html +=	'</select><br>';
			$('#table').append(html);
			$('#btngo').prop('disabled', true);

		});

		$('body').on('input', '.input', function(){
			$('#btngo').removeAttr('disabled');
		});

		$('body').on('change', '#cbomethod', function(){
			var	object = parseInt($("#object").val());
			var	attribute = parseInt($("#attribute").val());
			var method = $("#cbomethod").val();
			var html = "";

			for (var i = 0; i < object; i++) {
				eval("arr" + (i+1) + "= new Array();");

				for (var j = 0; j < attribute; j++) {
					var arrname = "arr"+(i+1);
					var value = "#obj" + (i+1) + "attr" + (j+1);
					eval(arrname).push(parseInt($(value).val()));
				}
			}

			$('#proximitymatrix').empty();

			html += "<table>";
			for (var i = 0; i <= object; i++) {
				if (i == 0) {
					html += "<tbody>";
					html += "<tr>";
				}
				else {
					html += "<tr>";
				}
				for (var j = 0; j <= object; j++) {
					if (i == 0) {
						if (j == 0) {
							html += "<td>" + method + "</td>";
						}else{
							html += "<td>Obj " + j + "</td>";
						}
						if (j == object){
							html += "</tr>";
						}
					}else {
						if (j == 0) {
							html += "<td> Obj " + i + "</td>";
						}else {
							html += "<td id='row" + i + "col" + j + "'></td>";
							if (j == object){
								html += "</tr>";
							}
						}
					}
				}
			}
			html += "</tbody></table><br>";
			$('#proximitymatrix').append(html);
		
			for (var i = 0; i < object; i++) {
				for (var j = 0; j < object; j++) {
					calculate(i,j);
				}
			}

			function calculate(i, j) { 
				$.ajax({
				    method: "post",
					url: "method.php",
					data: {arr1: eval("arr"+(i+1)),
							arr2: eval("arr"+(j+1)),
							method: method},
				    success: function(data) {    
				        $("#row"+(i+1)+"col"+(j+1)).html(data);
				    }
				});
			}
		});
	</script>
</body>
</html>