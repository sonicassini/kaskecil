

<?php
	include 'koneksi.php';
	$sql = "select * from biaya";
    $hasil = mysqli_query($konek, $sql);
?>
<html>
<head>
	<title>Cetak Daftar Biaya</title>
    <link href="styleku.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <h3 align="center">DAFTAR BIAYA</h3>
	<table border="1" width="90%" style="border-collapse:collapse;" align="center">
    	<tr class="tableheader">
        	<th rowspan="1">No Biaya</th>
            <th>Nama Biaya</th>
        </tr>
    
        <?php 
        while($data = mysqli_fetch_assoc($hasil)){
            echo "<tr id='rowHover'>";
            echo "<td width='10%' align='center'>".$data['no_biaya']."</td>"
                ."<td width='25%' id='column_padding'>".$data['nm_biaya']."</td>";
             echo "</tr>";
             }
         ?>
    </table>
    <script>
		window.load = cetak();
		function cetak(){
			window.print();
		}
	</script>
</body>
</html>