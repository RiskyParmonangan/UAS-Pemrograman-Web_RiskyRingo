<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$nama = $alamat = $gaji = "";
$nama_err = $alamat_err = $gaji_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_nama = trim($_POST["nama"]);
    if(empty($input_nama)){
        $nama_err = "Please enter a nama makanan.";
    } elseif(!filter_var($input_nama, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nama_err = "Please enter a valid nama makanan.";
    } else{
        $nama = $input_nama;
    }

    // Validate alamat
    $input_alamat = trim($_POST["alamat"]);
    if(empty($input_alamat)){
        $alamat_err = "Please enter an alamat.";
    } else{
        $alamat = $input_alamat;
    }

    // Validate gaji
    $input_gaji = trim($_POST["gaji"]);
    if(empty($input_gaji)){
        $gaji_err = "Please enter gaji.";
    } elseif(!ctype_digit($input_gaji)){
        $gaji_err = "Please enter a positive integer value.";
    } else{
        $gaji = $input_gaji;
    }

    // Check input errors before inserting in database
    if(empty($nama_err) && empty($alamat_err) && empty($gaji_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO pegawai (nama, alamat, gaji) VALUES (?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nama, $param_alamat, $param_gaji);

            // Set parameters
            $param_nama = $nama;
            $param_alamat = $alamat;
            $param_gaji = $gaji;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Record</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan daftar data_pegawai ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>">
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($alamat_err)) ? 'has-error' : ''; ?>">
                            <label>alamat</label>
                            <textarea name="alamat" class="form-control"><?php echo $alamat; ?></textarea>
                            <span class="help-block"><?php echo $alamat_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gaji_err)) ? 'has-error' : ''; ?>">
                            <label>gaji</label>
                            <input type="text" name="gaji" class="form-control" value="<?php echo $gaji; ?>">
                            <span class="help-block"><?php echo $gaji_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>