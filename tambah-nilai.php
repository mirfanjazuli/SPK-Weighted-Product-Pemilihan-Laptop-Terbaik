<!DOCTYPE html>
<html>
<head>
	<title>WP | Bobot</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <style type="text/css">
        .mx-auto { width: 700px; margin-top: 20px; }
        .table { margin-top: 20px }
        .mb-3 { width: 227px }
        .mx-fafa { padding-left: 745px; margin-top: 20px; }
        .fa { text-decoration: none; }
        .page { margin-top: 20px; margin-left: 15px; text-decoration: none }
    </style>
</head>
<body>

	<div class="mx-auto">
        <div class="card">
            <div class="card-body">
            	<form action="" method="post" class="row g-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">ID Alternatif</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="idalternatif" required autofocus autocomplete="off" autosave="off">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">ID Kriteria</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="idkriteria" required autocomplete="off" autosave="off">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Bobot</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="bobot" required autocomplete="off" autosave="off">
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
    		$idalternatif = $_POST['idalternatif'];
    		$idkriteria = $_POST['idkriteria'];
    		$nilai = $_POST['nilai'];

    		$sql = mysqli_query($connection, "INSERT INTO wp_evaluations VALUES ('$idalternatif', '$idkriteria', '$nilai')");
    	}

    	// Pagination
    	$jumlahDataPerHalaman = 5;
    	$result = mysqli_query($connection, "SELECT * FROM wp_evaluations");
    	$jumlahData = mysqli_num_rows($result);
    	$jumlahHalaman = $jumlahData / $jumlahDataPerHalaman;
    	$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    	$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

    ?>

    <div class="mx-fafa">
        <a href="tambah-alternatif.php" class="fa fa-chevron-circle-left"></a>
    </div>

    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Kriteria
            </div>
            <div class="card-body">
			    <table class="table table-borderless">
			        <thead>
			            <tr class="text-center">
			                <th>Alternatif</th>
			                <th>Kriteria</th>
			                <th>Nilai</th>
			            </tr>
			        </thead>
			        <tbody>
			            
			            <?php 
			            	
			                $query = mysqli_query($connection, "SELECT * FROM wp_evaluations LIMIT $awalData, $jumlahDataPerHalaman");

			                while($row = mysqli_fetch_array($query))
			                {
			                    echo '<tr class="text-center">';
			                    echo '<td>'.$row['id_alternative'].'</td>';
			                    echo '<td>'.$row['id_criteria'].'</td>';
			                    echo '<td>'.$row['value'].'</td>';
			                    echo '</tr>';
			                }             

			            ?>
			            
			        </tbody>
			    </table>
			</div>
		</div>
	</div>


<div class="text-center">
    <?php for ($i = 1; $i <= $jumlahHalaman ; $i++) : ?>

    <a class="page" href="?halaman=<?= $i ?>"><?= $i ?></a>

    <?php endfor; ?>
    </div>
<div class="mx-fafa">
    <a href="index.php" class="btn btn-primary fa fa-play"></a>
</div>

</body>
</html>