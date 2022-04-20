<?php
// init session
session_start();
// remove session
session_destroy();
// return to index.php
header("Location: index.php");