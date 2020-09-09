<?php
$pdo = new PDO('mysql:host=fdb28.awardspace.net;port=3306;dbname=3554561_expensemanager',
   '3554561_expensemanager', '1234567890@Avi');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
