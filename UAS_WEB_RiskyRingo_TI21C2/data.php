<!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Report Print</title>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    </head>

    <body>
        <div class="container mt-5">
            <div class="card">
                <div class="card-body">
                    <table id="table_id" class="table table-striped dispay">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>nama makanan</th>
                                <th>alamat</th>
                                <th>gaji</th>
                            </tr>
</thead>
        <tbody>
            <?php
            $koneksi    = mysqli_connect("localhost","root","","data_pegawai");

            $select     = mysqli_query($koneksi, "select * from pegawai");

            $no =1;

            while($data = mysqli_fetch_array($select)){
                ?>
                <tr>
                    <td><?=$data['id']?></td>
                    <td><?=$data['nama']?></td>
                    <td><?=$data['alamat']?></td>
                    <td><?=$data['gaji']?></td>
                </tr>
                <?php
            }?>
            </tbody>
        </table>
    </div>