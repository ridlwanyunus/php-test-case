<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id_user'])) {
        $id = $_REQUEST['id_user'];
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
        $id_user = $_POST['id_user'];
        $jenis_user = $_POST['jenis_user'];
        $role_user = $_POST['role_user'];
         
        // validate input
        $valid = true;
        if (empty($id_user)) {
            $idError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($jenis_user)) {
            $idError = 'Please enter Email Address';
            $valid = false;
        }
        if (empty($role_user)) {
            $roleError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE user set id_user = ?, jenis_user = ?, role_user =? WHERE id_user = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id_user,$jenis_user,$role_user,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM user where id_user = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id_user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $id_user = $data['id_user'];
        $jenis_user = $data['jenis_user'];
        $role_user = $data['role_user'];
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
             
                    <form class="form-horizontal" action="update_user.php?id_user=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="id_user" type="text"  placeholder="Name" value="<?php echo !empty($id_user)?$id_user:'';?>">
                            <?php if (!empty($idError)): ?>
                                <span class="help-inline"><?php echo $idError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($jenisError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="jenis_user" type="text" placeholder="Email Address" value="<?php echo !empty($jenis)?$jenis:'';?>">
                            <?php if (!empty($jenisError)): ?>
                                <span class="help-inline"><?php echo $jenisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roleError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="role_user" type="text"  placeholder="Mobile Number" value="<?php echo !empty($role_user)?$role_user:'';?>">
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