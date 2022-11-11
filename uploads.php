<?php
$target_dir = "uploads/";
//$Filename = $target_dir . basename($_FILES['file']['name']);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//$Filename = basename($_FILES['file']['name']);

//$files = array_filter($_FILES['file']['name']);

$questions = $_POST['questions'];

$fp = fopen('data.csv', 'a');

//prints questions and answers after pressing submit
foreach ($questions as $value) {
  echo $value . "<br/>";
}

//prints name of image
foreach($_FILES['file']['name'] as $name){
  echo $name . '<br />';
  
}

//put questions and file names into csv format
fputcsv($fp, $questions);
fputcsv($fp, $_FILES['file']['name']);
fclose($fp);




$total = count($_FILES['file']['name']);

// Loop through each file
for ($i = 0; $i < $total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['file']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != "") {
    //Setup our new file path
    $newFilePath = "uploads/" . $_FILES['file']['name'][$i];


    //Upload the file into the temp dir
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
      echo "The file " . htmlspecialchars(basename($_FILES['file']['name'][$i])) . " has been uploaded.<br/>";
      //Handle other code here
    }
  }
}

//This code below I attempted to use to have limits on file type and file size but couldn't get it to work

/*
// Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES['file']['name'][$i]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES['file']['name'][$i], $target_file)) {
      echo "The file " . htmlspecialchars(basename($_FILES['file']['name'][$i])) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
*/
?>