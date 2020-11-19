<?php
        require_once 'database.php';
        require_once 'user.php';

?>

<!DOCTYPE html >
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
</head>
<body onload="makeCode()">
</br>

<p><?php echo $user->getDomain(); ?></p>

<p><?php echo $user->getPersonData(); ?></p>

<input id="text" type="hidden" value='<?php echo $user->getPersonData();?>' />
<div id="qrcode" style="width:100px; height:100px; margin-top:15px;"></div>

<p><?php   $db->countDomain(); ?></p>

<script type="text/javascript" src="qrcode.js"></script>
<script type="text/javascript" src="main.js"></script>
</body>