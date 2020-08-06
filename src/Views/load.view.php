<html lang="en">
<head>
    <title>Code Test</title>
</head>
<body>
<pre>
<?php
if(isset($file_loaded) && $file_loaded){
    echo "FILE HAS BEEN LOADED<br>\n";
}else{
    echo "Go back to upload back<br>\n";
}
if(isset($vehicles)){
    var_dump($vehicles);
}
?>
</pre>
</body>
</html>