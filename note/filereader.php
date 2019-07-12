<?php
    if(isset($_REQUEST['id'])){
        $file=str_replace(":","\\" ,urldecode($_REQUEST['id']));
        if (file_exists($file)) {
            echo file_get_contents($file);
        }
    }
?>

