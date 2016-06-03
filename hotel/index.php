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
                <h3>Create Read Update Delete Tabel Hotel</h3>
            </div>
			<div class="span10 offset1">
			<form class="form-horizontal" action="create.php" method="post">
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
                      <th>ID Hotel</th>
                      <th>Nama Hotel</th>
                      <th>Lokasi Hotel</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM hotel ORDER BY id_hotel DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['id_hotel'] . '</td>';
                            echo '<td>'. $row['nama_hotel'] . '</td>';
                            echo '<td>'. $row['lokasi_hotel'] . '</td>';
							echo "<td><a class='btn' href='read.php?id_hotel=". $row['id_hotel'] ."'>Read</a>";
							echo ' ';
							echo '<a class="btn btn-success" href="update.php?id_hotel='.$row['id_hotel'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id_hotel='.$row['id_hotel'].'">Delete</a>';
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