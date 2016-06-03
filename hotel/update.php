<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id_hotel'])) {
        $id = $_REQUEST['id_hotel'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $idError = null;
        $jenisError = null;
        $roleError = null;
         
        // keep track post values
        $id_hotel = $_POST['id_hotel'];
        $nama_hotel = $_POST['nama_hotel'];
        $lokasi_hotel = $_POST['lokasi_hotel'];
         
        // validate input
        $valid = true;
        if (empty($id_hotel)) {
            $idError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($nama_hotel)) {
            $idError = 'Please enter Email Address';
            $valid = false;
        }
        if (empty($lokasi_hotel)) {
            $roleError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE hotel set id_hotel = ?, nama_hotel = ?, lokasi_hotel =? WHERE id_hotel = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_hotel,$nama_hotel,$lokasi_hotel,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM hotel where id_hotel = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_hotel));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_hotel = $data['id_hotel'];
        $nama_hotel = $data['nama_hotel'];
        $lokasi_hotel = $data['lokasi_hotel'];
        Database::disconnect();
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
                        <h3>Update a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id_hotel=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                        <label class="control-label">ID Hotel</label>
                        <div class="controls">
                            <input name="id_hotel" type="text"  placeholder="Name" value="<?php echo !empty($id_hotel)?$id_hotel:'';?>">
                            <?php if (!empty($idError)): ?>
                                <span class="help-inline"><?php echo $idError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($jenisError)?'error':'';?>">
                        <label class="control-label">Nama Hotel</label>
                        <div class="controls">
                            <input name="nama_hotel" type="text" placeholder="Nama Hotel" value="<?php echo !empty($nama_hotel)?$nama_hotel:'';?>">
                            <?php if (!empty($jenisError)): ?>
                                <span class="help-inline"><?php echo $jenisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roleError)?'error':'';?>">
                        <label class="control-label">Lokasi Hotel</label>
                        <div class="controls">
                            <input name="lokasi_hotel" type="text"  placeholder="Lokasi Hotel" value="<?php echo !empty($lokasi_hotel)?$lokasi_hotel:'';?>">
                            <?php if (!empty($roleError)): ?>
                                <span class="help-inline"><?php echo $roleError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>