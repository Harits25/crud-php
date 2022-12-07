<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "data_siswa";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak terhubung ke database!");
}

$id = "";
$nis = "";
$nama = "";
$alamat = "";
$kelas = "";
$sukses = "";
$error = "";

// Untuk edit data
$op = $_GET['op'] ?? '';

if ($op == 'edit') {
    $id = $_GET['id'];
    $crud1 = "SELECT * FROM siswa WHERE id = '$id'";
    $c1 = mysqli_query($koneksi, $crud1);
    $r1 = mysqli_fetch_array($c1);
    $nis = $r1['nis'];
    $nama = $r1['nama'];
    $alamat = $r1['alamat'];
    $kelas = $r1['kelas'];

    if ($nis == '') {
        $error = "Data tidak ditemukan.";
    }
}

// Untuk delete data
if ($op == 'delete') {
    $id = $_GET['id'];
    $crud1 = "DELETE FROM siswa WHERE id = '$id'";
    $c1 = mysqli_query($koneksi, $crud1);

    if ($c1) {
        $sukses = "Data berhasil dihapus.";
    } else {
        $error = "Gagal menghapus data.";
    }
}

// Untuk create data
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];

    if ($nis && $nama && $alamat && $kelas) {
        if ($op == 'edit') {
            $crud1 = "UPDATE siswa SET nis='$nis', nama='$nama', alamat='$alamat', kelas='$kelas' WHERE id = '$id'";
            $cr1 = mysqli_query($koneksi, $crud1);

            if ($cr1) {
                $sukses = "Data berhasil diubah.";
            }
        } else {
            $crud1 = "INSERT INTO siswa (nis, nama, alamat, kelas) VALUES ('$nis', '$nama', '$alamat', '$kelas')";
            $c1 = mysqli_query($koneksi, $crud1);

            if ($c1) {
                $sukses = "Berhasil memasukkan data.";
            } else {
                $error = "Gagal memasukkan data.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Version v5.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- End Bootstrap Version v5.1 -->

    <!-- Title website -->
    <title>Data Siswa | IDN Boarding School Solo</title>
    <!-- End Title Website -->

</head>

<!-- CSS Style -->
<style>
    .mx-auto {
        width: 1000px;
    }

    .navbar {
        width: 1280px;
    }

    .card {
        margin-top: 20px;
    }
</style>
<!-- End CSS Style -->

<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            </p>
        </div>
    </nav>

    <div class="mx-auto">



        <!-- Create data / Edit Data -->
        <div class="card">
            <div class="card-header">
                Create / Edit
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:3; url = index.php");
                }
                ?>

                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:3; url = index.php");
                }
                ?>

                <form action="" method="post">

                    <!-- nis : From Control -->
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis ?>">
                        </div>
                    </div>
                    <!-- End nis : From Control -->

                    <!-- nama : From Control -->
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <!-- End nama : From Control -->

                    <!-- alamat : From Control -->
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <!-- End alamat : From Control -->

                    <!-- kelas : From Control -->
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kelas" name="kelas">

                                <!-- Pop Up : Pilih Kelas -->
                                <option value="">
                                    --- Pilih Kelas ---
                                </option>
                                <!-- End No Pop Up : Pilih Kelas -->

                                <!-- Pop Up : Pilih Kelas-->
                                <option value="kelas X" <?php if ($kelas == "kelas X") echo "Selected" ?>>Kelas X</option>
                                <option value="kelas XI" <?php if ($kelas == "kelas XI") echo "Selected" ?>>Kelas XI</option>
                                <option value="kelas XII" <?php if ($kelas == "kelas XII") echo "Selected" ?>>Kelas XII</option>
                                <!-- End Pop Up : Pilih Kelas-->
                            </select>
                        </div>
                    </div>
                    <!-- End kelas : From Control -->

                    <!-- Button -->
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn-primary">
                    </div>
                    <!-- End Button -->

                </form>
            </div>
        </div>
        <!-- End Create Data / Edit Data -->

        <!-- Read Data Siswa -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    <Tbody>
                        <?php
                        $crud2 = "Select * from siswa order  by id desc";
                        $c2 = mysqli_query($koneksi, $crud2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($c2)) {
                            $id = $r2['id'];
                            $nis = $r2['nis'];
                            $nama = $r2['nama'];
                            $alamat = $r2['alamat'];
                            $kelas = $r2['kelas'];
                        ?>
                            <tr>
                                <th scope="row">
                                    <?php echo $urut++ ?>
                                </th>
                                <td scope="row"><?php echo $nis ?></td>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $kelas ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>">
                                        <button type="button" class="btn btn-warning">Edit</button>
                                    </a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau di hapus?')">
                                        <button type="button" class="btn btn-danger">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </Tbody>
                    </thead>
                </table>
            </div>
        </div>
        <!-- End Read Data Siswa -->

    </div>
</body>

</html>