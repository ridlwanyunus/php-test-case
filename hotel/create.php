<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $idError = null;
        $jenisError = null;
        $roleError = null;
         
        // keep track post values
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $lokasi = $_POST['lokasi'];
         
        // validate input
        $valid = true;
        if (empty($id)) {
            $idError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($nama)) {
            $jenisError = 'Please enter Email Address';
            $valid = false;
        } 
         
        if (empty($lokasi)) {
            $roleError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO hotel (id_hotel,nama_hotel,lokasi_hotel) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$nama,$lokasi));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a User</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                        <label class="control-label">ID Hotel</label>
                        <div class="controls">
                            <input name="id" type="text"  placeholder="ID hotel" value="<?php echo !empty($id)?$id:'';?>">
                            <?php if (!empty($idError)): ?>
                                <span class="help-inline"><?php echo $idError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($jenisError)?'error':'';?>">
                        <label class="control-label">Nama Hotel</label>
                        <div class="controls">
                            <input name="nama" type="text" placeholder="Nama Hotel" value="<?php echo !empty($nama)?$nama:'';?>">
                            <?php if (!empty($jenisError)): ?>
                                <span class="help-inline"><?php echo $jenisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roleError)?'error':'';?>">
                        <label class="control-label">Lokasi Hotel</label>
                        <div class="controls">
                            <input name="lokasi" type="text"  placeholder="Lokasi Hotel" value="<?php echo !empty($lokasi)?$lokasi:'';?>">
                            <?php if (!empty($roleError)): ?>
                                <span class="help-inline"><?php echo $roleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>