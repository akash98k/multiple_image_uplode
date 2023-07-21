<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <title>form</title>
    <style>
      .text{
        text-align:center;
      }
    </style>
</head>
<body> 
<?php
    include('connect.php');
    $qry = "SELECT * FROM `images`";
    $run = mysqli_query($conn, $qry);?>
    <table class="table table-bordered" style="width:70%; text-align:center;" align="center" border="2" >
        <tr>
        <td><h5>ID</h5></td>
        <td><h5>Name</h5></td>
        <td><h5>Image</h5></td>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($run)) {
        ?>
        <tr>
            <td class="text" align="center"><h5><?php echo $data['id']?></h5></td>
            <td class="text" align="center"><h5><?php echo $data['name']?></h5></td>
            <td class="text" align="center"><img src="images/<?php echo $data['images']?>" style="height: 50px; width : 50px;" alt=""></td>
        </tr>
        <?php
        }?>
    </table>
    <!-- <script>
		function save(){	 
		  var userPreference;

			if (confirm("Do you want to Delete User?") == true) {
				header("delete.php?uid=<?php echo $data['id']?>");
			} else {
				userPreference = "Save Canceled!";
			}

			document.getElementById("msg").innerHTML = userPreference; 
		}
    </script> -->