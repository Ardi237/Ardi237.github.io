<?php
$sudahSubmit = false;

$nama = "";
$email = "";
$jenisKelamin = "";
$alamat = "";
$nomorTelepon = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sudahSubmit = true;

    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $jenisKelamin = $_POST["jenis_kelamin"];
    $alamat = $_POST["alamat"];
    $nomorTelepon = $_POST["nomor_telepon"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Data Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }

        .kotak {
            background: white;
            width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #cccccc;
            border-radius: 10px;
        }

        h1, h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: 1px solid #cccccc;
            border-radius: 6px;
        }

        textarea {
            height: 80px;
        }

        button {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            background: #333333;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .hasil {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #cccccc;
            background: #fafafa;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="kotak">
        <h1>Form Data Pengguna</h1>

        <form method="POST" action="">
            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label>Alamat</label>
            <textarea name="alamat" required></textarea>

            <label>Nomor Telepon</label>
            <input type="text" name="nomor_telepon" required>

            <button type="submit">Submit</button>
        </form>

        <?php if ($sudahSubmit) { ?>
            <div class="hasil">
                <h2>Hasil Data Pengguna</h2>

                <p>Nama: <?php echo $nama; ?></p>
                <p>Email: <?php echo $email; ?></p>
                <p>Jenis Kelamin: <?php echo $jenisKelamin; ?></p>
                <p>Alamat: <?php echo $alamat; ?></p>
                <p>Nomor Telepon: <?php echo $nomorTelepon; ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
