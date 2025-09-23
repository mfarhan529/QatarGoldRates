<?php
session_start();
session_destroy();
header("Location: ./"); // Back to login
exit();
