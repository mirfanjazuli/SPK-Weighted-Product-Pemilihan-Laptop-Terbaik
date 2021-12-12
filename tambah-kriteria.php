<!DOCTYPE html>
<html>
<head>
	<title>WP | Kriteria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

    <style type="text/css">
        .mx-auto { width: 700px; margin-top: 20px; }
        .table { margin-top: 20px }
        .mb-3 { width: 227px }
        .mx-fafa { padding-left: 745px; margin-top: 20px }
        .fa { text-decoration: none; }
    </style>
</head>
<body>

    <div class="mx-auto">
        <div class="card">
            <div class="card-body">
            	<form action="" method="post" class="row g-3">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Kriteria</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="kriteria" required autofocus autocomplete="off" autosave="off">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Bobot</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="bobot" required autocomplete="off" autosave="off">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Atribut</label>
                        <input type="text" class="form-control" id="formGroupExampleInput" name="atribut" required autocomplete="off" autosave="off">
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
            $kriteria = $_POST['kriteria'];
            $bobot = $_POST['bobot'];
            $atribut = $_POST['atribut'];

            $sql = mysqli_query($connection, "INSERT INTO wp_criterias VALUES ('','$kriteria', '$bobot', '$atribut')");
        }

    ?>

    <div class="mx-fafa">
        <a href="tambah-alternatif.php" class="fa fa-chevron-circle-right"></a>
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
                            <th>ID Kriteria</th>
                            <th>Kriteria</th>
                            <th>Bobot</th>
                            <th>Atribut</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php 

                            $query = mysqli_query($connection, "SELECT * FROM wp_criterias");
                            
                            while($row = mysqli_fetch_array($query))
                            {
                                echo '<tr class="text-center">';
                                echo '<td>'.$row['id_criteria'].'</td>';
                                echo '<td>'.$row['criteria'].'</td>';
                                echo '<td>'.$row['weight'].'</td>';
                                echo '<td>'.$row['attribute'].'</td>';
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