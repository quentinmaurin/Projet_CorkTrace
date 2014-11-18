<?php

error_log("test", 3, "data.log");
error_log($_GET["action"], 3, "data.log");

if( empty($_POST) ){
error_log("POST EMPTY", 3, "data.log");
}

?>