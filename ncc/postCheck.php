<?php
header('Refresh: 1; url=index.php');
require_once 'header.html';
echo '</br></br></br></br>';
echo '<div class="alert alert-dismissable alert-success">'
        . '       <strong>Well done!</strong> You successfully created the message</a>.'
        . '</div>';
require_once 'footer.html';
?>