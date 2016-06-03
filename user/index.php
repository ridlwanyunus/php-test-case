<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
			<div class="span10 offset1">
			<form class="form-horizontal" action="create_user.php" method="post">
			    <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn" href="index.php">Back</a>
                </div>
            </form>
			</div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email Address</th>
                      <th>Mobile Number</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM user ORDER BY id_user DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_user'] . '</td>';
                            echo '<td>'. $row['jenis_user'] . '</td>';
                            echo '<td>'. $row['role_user'] . '</td>';
							echo "<td><a class='btn' href='read_user.php?id_user=". $row['id_user'] ."'>Read</a>";
							echo ' ';
							echo '<a class="btn btn-success" href="update_user.php?id_user='.$row['id_user'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete_user.php?id_user='.$row['id_user'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
				   
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>