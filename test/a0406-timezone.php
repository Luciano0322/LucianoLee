<?php
date_default_timezone_set("Asia/Taipei");
echo date("Y-m-d H:i:s");
echo'<br>';

echo date("Y-m-d H:i:s",time()+50*24*60*60);
echo'<br>';

echo date("Y-m-d H:i:s",strtotime('+50 days'));
echo'<br>';

echo date("w",strtotime('+50 days'));
echo'<br>';

echo date("Y-m-d H:i:s",strtotime('08/05/2019'));
echo'<br>';

