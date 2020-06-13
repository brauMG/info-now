<!DOCTYPE html>
<html>
	<head>
		<title>SEND EMAIL</title>
	</head>
	<body>
		<div class="table">
			<table>
				<thead>
					<tr>
						<th>Email</th>
						<th>Nombre(s)</th>
					</tr>	
				</thead>
				<tbody>
					<tr>
						<td>cristian.santiago.rosas@gmail.com</td>
						<td>Cristian santiago</td>
					</tr>
				</tbody>		
			</table>
		</div>
		<a href="{{ url('/Email/Send') }}">SEND</a>
	</body>	
</html>
