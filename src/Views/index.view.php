<html lang="en">
<head>
    <title>Code Test</title>
</head>
<body>
<?php
    if(isset($errors)){
        foreach($errors as $error){
            echo "<p>".$error."</p>";
        }
    }
    if(isset($file_loaded) && $file_loaded){
        echo "FILE HAS BEEN LOADED";
    }
?>

    <form method="post" action="/index.php/load" enctype="multipart/form-data">
        Upload CSV:
        <input type="file" name="upload">
        <input type="submit">
    </form>
</body>
</html>