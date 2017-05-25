<?php
echo password_hash("mainpass",  PASSWORD_DEFAULT);

for($i = 0; $i <1000; $i++) {
    if ($i % 3 == 0 && $i % 5 !== 0) { //кратные 3 и не кратные 5
        $checkSum = str_split($i); //приводим к массиву
        if ($checkSum[0] + $checkSum[1] + $checkSum[2]  < 10) { //складываем элементы массива
            echo ($i) . ",";
        }
    }
}