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

    <?php

        include 'koneksi.php';

        //mengambil nilai data kriteria
        $jumlah_kriteria = 0;
        $sql1 = mysqli_query($connection, "SELECT * FROM wp_criterias ORDER BY id_criteria") or die (mysqli_error($connection));
        while ($data = mysqli_fetch_array ($sql1))
        {
            $bobot [] = $data['weight'];
            $kriteria[] = $data['criteria'];
            $atribut [] = $data['attribute'];
            $jumlah_kriteria = $jumlah_kriteria + 1;
        }

        //menghitung jumlah alternatif dan memasukkan nilai alternatif ke dalam array
        $jumlah_alternatif = 0;
        $sql2 = mysqli_query ($connection, "SELECT * FROM wp_alternatives") or die (mysqli_error ($connection));
        while ($data = mysqli_fetch_array ($sql2))
        {
            $alternatif[] = $data['name'];
            $jumlah_alternatif = $jumlah_alternatif + 1;
        }

        //menghitung bobot dalam persen
        $total_bobot = array_sum ($bobot);
        for ($col = 0; $col < $jumlah_kriteria; $col++) 
        {
            $bobot_persen [$col] = $bobot [$col]/$total_bobot;
        }
        	
        //menghitung vektor s
        $kolom = 0;
        $baris = 0;
        //Ssql3 digunakan untuk mengambil nilai dari kriteria masing-masing alternatit
        $sql3 = mysqli_query ($connection, "SELECT * FROM wp_evaluations ORDER BY id_alternative, id_criteria") or die (mysqli_error ($connection));
        while ($data = mysqli_fetch_array ($sql3))
        {
            $nilai [$baris] [$kolom] = $data['value'];
            $kolom = $kolom + 1;
            if ($kolom == $jumlah_kriteria) 
            {
                $baris = $baris + 1;
                $kolom = 0;
            }
        }
        for ($row = 0; $row < $jumlah_alternatif; $row++)
        {
            for ($col = 0; $col < $jumlah_kriteria; $col++) 
            {
                if ($atribut [$col] == 'cost')
                {
                    $pangkat [$row] [$col] = pow ($nilai[$row] [$col], -$bobot_persen[$col]);
                }else if ($atribut [$col] == 'benefit')
                {
                   $pangkat [$row] [$col] = pow ($nilai[$row] [$col], $bobot_persen[$col]);
        		}
        	}
        }		   
        $jumlah_vektor_S = 0;
        for ($row = 0; $row < $jumlah_alternatif; $row++)
        {
        	$S = 1;
            for ($col = 0; $col < $jumlah_kriteria; $col++)
            {
                $S = $S  * $pangkat [$row] [$col];
        	}
        	$vektor_S[$row] = $S;
        	$jumlah_vektor_S = $jumlah_vektor_S + $vektor_S [$row];
        }

        //menghitung vektor V
        for ($row = 0; $row < $jumlah_alternatif; $row++)
        {
        	$vektor_V[$row] = $vektor_S[$row] / $jumlah_vektor_S;
        	//echo $alternatif[$row]." =".number_format ($vektor_V[$row], 3);
            //echo "<br>";
        }

    ?>

    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Hasil
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Alternatif</th>
                        <th>Nilai</th>
                    </tr>
        
    <?php

        $no = 1;
        //Hasil
        //echo "<br> Dari hasil perhitungan menggunakan metode WP, 3 alternatif yang terpilih adalah: <br>";
        array_multisort ($vektor_V, SORT_DESC, SORT_NUMERIC, $alternatif);
        for ($i = 0; $i <=2; $i++) 
        {
            echo '<tr class="text-center">';
            echo '<td>'.$no++.'</td>';
            echo '<td>'.$alternatif[$i].'</td>';
            echo '<td>'.number_format($vektor_V[$i],3).'</td>';
            echo '</tr>';
           // echo "<b>".$alternatif[$i]."</b> dengan nilai ". number_format ($vektor_V[$i],3)."<br>";
        }

    ?>

                </table>
            </div>
        </div>
    </div>
    
    <div class="mx-fafa">
        <a href="tambah-nilai.php" class="fa fa-chevron-circle-left"></a>
        <a href="tambah-kriteria.php" class="fa fa-chevron-circle-right"></a>
    </div>
    