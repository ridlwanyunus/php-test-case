<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $idError = null;
        $jenisError = null;
        $roleError = null;
         
        // keep track post values
        $id = $_POST['id'];
        $jenis = $_POST['jenis'];
        $role = $_POST['role'];
         
        // validate input
        $valid = true;
        if (empty($id)) {
            $idError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($jenis)) {
            $jenisError = 'Please enter Email Address';
            $valid = false;
        } 
         
        if (empty($role)) {
            $roleError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO user (id_user,jenis_user,role_user) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($id,$jenis,$role));
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
             
                    <form class="form-horizontal" action="create_user.php" method="post">
                      <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="id" type="text"  placeholder="Name" value="<?php echo !empty($id)?$id:'';?>">
                            <?php if (!empty($idError)): ?>
                                <span class="help-inline"><?php echo $idError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($jenisError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="jenis" type="text" placeholder="Email Address" value="<?php echo !empty($jenis)?$jenis:'';?>">
                            <?php if (!empty($jenisError)): ?>
                                <span class="help-inline"><?php echo $jenisError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($roleError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="role" type="text"  placeholder="Mobile Number" value="<?php echo !empty($role)?$role:'';?>">
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