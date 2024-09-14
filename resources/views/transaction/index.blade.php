<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CSC561 | Lab1c</title>
  </head>
<body>


{{-- This is a laravel comment line--}}


<h3>Status of all of our inventory items - (Inventory -> { belongsTo } -> Status)</h3>

<table border="1">
				<thead>
                    <th>Inventory Item</th>
					<th>Description</th>
				</thead>

				<tbody>
					@foreach ($inventories as $inventory)
                    <tr>
                            <td>{{ $inventory->description }}</td>
							<td>{{ $inventory->status->description }}</td>
                    </tr>
                     @endforeach

                </tbody>
</table> 

</body>
</html>
