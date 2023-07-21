<?php
if (isset($_FILES['images'])) {
    $count = 0;
    $countImg = 0;
    $conn = mysqli_connect("localhost", "root", "", "akashnewform");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    
    $image_files = $_FILES['images'];
    $image_count = count($image_files['name']);
    $target_directory = "images/"; // The directory where the uploaded images will be saved
    
    // $name = $_POST['name'];
    // $lname = array();
    // for ($i = 0; $i < $image_count; $i++) {
    //     $lname[] = $name;
    // }
    
    // $lname = implode($lname);
    // echo $lname;
    // echo $image_count;

    // Process each uploaded image
    for ($i = 0; $i < $image_count; $i++) {
        $image_name = $image_files['name'][$i];
        $image_tmp_name = $image_files['tmp_name'][$i];


        


        // Move the uploaded image to the target directory
        $target_file = $target_directory . basename($image_name);
        if (move_uploaded_file($image_tmp_name, $target_file)) {
            $qry = "INSERT INTO `images` (`images`, `name`) VALUES ('$image_name', '$lname')";
            $run = mysqli_query($conn, $qry);
            
        }
        $count++;
            if (!$run) {
                $countImg++;
            }
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the result as JSON
    $result = array(
        'total_uploaded' => $count,
        'failed_insertions' => $countImg
    );
    echo json_encode($result);
    if ($result==true) {
        // header("location:mulimageshow.php");
    }
    exit();
}
?>

