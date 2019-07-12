<?php
    $data=urldecode($_REQUEST['data']);
    $file=str_replace(":","\\" ,urldecode($_REQUEST['id']));
    if (file_exists($file)) {
        file_put_contents($file,$data);
    }
    echo"Saved!";
?>
