<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        $uploadOk = 0;
    }



}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "You post has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}





$titleOfPost = $_POST["titleOfPost"];
$description = $_POST["description"];
$contact = $_POST["ContactOfPost"];


if (!function_exists('array_key_first')) {
    /**
     * Gets the first key of an array
     *
     * @param array $array
     * @return mixed
     */
    function array_key_first(array $array)
    {
        if (count($array)) {
            reset($array);
            return key($array);
        }

        return null;
    }
}



$fileList = array();
$files = glob('Uploads/*.jpg');
foreach ($files as $file) {
    $fileList[filemtime($file)] = $file;
}
ksort($fileList);
$fileList = array_reverse($fileList, TRUE);
$firstKey = array_key_first($fileList);
print_r($fileList[$firstKey]);

?>


<!Doctype html>
<html>


<head>
    <title>Bazar</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="Profile.css">
</head>


<body>
  <!--mine header and navigation-->
  <div id="header">
          <a class="title" href="index.html"> <span class="firstA">B</span><span class="secA">AZAAR</span></a>

          <form class="searchBar"action="#">
            <input class="inputText" type="text" placeholder="Search.." name="search">
            <button class="btnSearch" type="submit"><i class="fa fa-search"></i></button>
          </form>

          <div id="post">
              <a class="AddPost" href="New_post.html"> New Post </a>
          </div>

          <div id="account">
              <a class="accountName" href="Profile.php"><img class="user-icon" src="user-icon.png"><br>Kazim</a>
          </div>
  </div>




<!-- my content-->
  <div id="content">

        <div id="UserProfile">
            <img class="UserPicture"src="User-icon.png" width="50px">
            <h2 class="UserName">Hossein Hosseni</h2>
          </div>


            <h3>Create new post</h3>



          <form class ="Upload" method = "post" action = "Profile.php" enctype="multipart/form-data">
              <input class="inputImg" type="file" accept="image/*" onchange="preview_image(event)" name="fileToUpload">

              <label class="labelTitlePost"> Enter your title </label>
              <br>
              <input class="titleOfPost" type="text" name="titleOfPost" placeholder=" Title of you post...">
              <br><br>

              <img id="output_image" name="imgUploaded" >

              <label class="labelDescription"> Enter your description </label>
              <textarea class="description" name="description" placeholder="Description..."></textarea>
              <br><br>

              <label class="labelContactPost"> Contact </label>
              <br>
              <input class="contactOfPost" type="text" name="ContactOfPost" placeholder=" Phone number/Email...">

              <input class="submit" name="submit" type = "submit" value = "Done">
          </form>



          <h3>My posts</h3>
          <div class="myPosts">
            <div class="postsTitle">
              <h4>Title:</h4>
                <?php
                  echo  $titleOfPost;
                ?>
            </div>

            <div class="postsImg">
              <?php
                  echo '<img src="'.$fileList[$firstKey].'"width=100% height=100% >';
              ?>
            </div>

            <div class="postsDescription">
                <h4>Description:</h4>
                <?php
                  echo $description;
              ?>
            </div>

            <div class="postsContact">
              <h4>Contact:</h4>
              <?php
                echo $contact;
              ?>
            </div>
          </div>




</div>

  <button onclick="topFunction()" id="mybtn" title="Go to top">Create new post</button>


          <script type='text/javascript'>
              function preview_image(event)
              {
               var reader = new FileReader();
               reader.onload = function()
               {
                var output = document.getElementById('output_image');
                output.src = reader.result;
               }
               reader.readAsDataURL(event.target.files[0]);
              }




              // When the user scrolls down 20px from the top of the document, show the button
              window.onscroll = function() {scrollFunction()};

              function scrollFunction() {
                if (document.body.scrollTop > 250 || document.documentElement.scrollTop > 250) {
                  document.getElementById("mybtn").style.display = "block";
                } else {
                  document.getElementById("mybtn").style.display = "none";
                }
              }

              // When the user clicks on the button, scroll to the top of the document
              function topFunction() {
                document.body.scrollTop = 100;
                document.documentElement.scrollTop = 100;
              }
          </script>



</body>
</html>
