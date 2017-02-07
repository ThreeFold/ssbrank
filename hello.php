<?php
echo  "Hello World";
echo 5 + 5;
echo "5" + "5";
echo "5" . "5";
$a = 5;
$b = 10;
echo $a + $b;
echo "hello<br/>";
echo "world<br/>";

for($i = 0; $i < 10; $i++){
    echo "$i square is " . $i * $i . ".<br/>";
}

for($i = 0; $i <= 6; $i++){
    echo "<h$i> This is h$i </h$i><br/>";
}

#if (){} elseif(){} else{}
#while(){} do{}while()

$c = array();
$c[0] = "hello";
$c[1] = "there";
$c['apple'] = 'grapes';
echo "<pre>" . print_r($c, TRUE) . "</pre>";

foreach($c as $item){
    echo $item . "<br/>";
}
