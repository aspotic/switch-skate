<?php
session_start();

echo "Level ", $_SESSION['RISK_USERLEVEL'], " denied. ", $_GET['t'];
?>
