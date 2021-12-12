<!DOCTYPE html>
<html>
<head>
	<title>WP | Alternatif</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<style type="text/css">
		.mx-auto { width: 700px; margin-top: 20px; }
		.table { margin-top: 20px }
		.mb-3 { width: 200px }
		.mx-fafa {margin-top: 20px; padding-left: 745px }
		.fa { text-decoration: none; }
	</style>

</head>
<body>

	<div class="mx-auto">
		<div class="card">
  			<div class="card-body">
				<form action="" method="post">
					<div class="mb-3">
			  			<label for="formGroupExampleInput" class="form-label">Nama</label>
			  			<input type="text" class="form-control" id="formGroupExampleInput" name="nama" autofocus autocomplete="off" autosave="off">
					</div>
					<div class="mb-3">
						<input type="submit" name="submit" value="submit">
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php  

		include 'koneksi.php';

		if(isset($_POST['submit']))
		{
			$nama = $_POST['nama'];

			$sql = mysqli_query($connection, "INSERT INTO wp_alternatives VALUES ('', '$nama')");
		}

	?>

	<div class="mx-fafa">
		<a href="tambah-kriteria.php" class="fa fa-chevron-circle-left"></a>
		<a href="tambah-nilai.php" class="fa fa-chevron-circle-right"></a>
	</div>

	<div class="mx-auto">
		<div class="card">
  			<div class="card-header">
    			Alternatif
  			</div>
  			<div class="card-body">

				<table class="table table-borderless" >
			        <thead>
			            <tr class="text-center">
			                <th>ID Atribut</th>
			                <th>Atribut</th>
			                
			            </tr>
			        </thead>
			        <tbody>
			            
			            <?php 

			                $query = mysqli_query($connection, "SELECT * FROM wp_alternatives");
			                
			                while($row = mysqli_fetch_array($query))
			                {
			                    echo '<tr class="text-center">';
			                    echo '<td>'.$row['id_alternative'].'</td>';
			                    echo '<td>'.$row['name'].'</td>';
			                    //echo '<td><a href="edit-nilai.php" class="fa fa-eye" data-toggle="modal" data-target="#modalfade"></a></td>';
			                    echo '</tr>';
			                }             

			            ?>
			            
			        </tbody>
			    </table>
			</div>
		</div>
	</div>

</body>
</html>