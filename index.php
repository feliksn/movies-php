<?php 
    // index.php - это главный файл, который открывается при загрузке сайта
    
    // В главный фалй включаем header.php 
    // В header.php будут будет функциональсть и другие общие данные для сайта
    include "header.php";
    

    // Проверяем подключение с нашой базой данный и получаем данные из базы.
    // Это временный код. Он будет изменен. Пока что создаем быстрое подключение и проверяем работает ли база данных
    // Все настройки подключения к базе данных находяться в файле function.php
    $sql = "SELECT id, name, year FROM test";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "Movie id: " . $row["id"]. "; Movie name: " . $row["name"]. "; Movie year: " . $row["year"]. "<br>";
        }
    } else {
        echo "0 results";   
    }

    // В главный файл включаем footer.php
    // В footer.php будет все то, что подключаеться после того как прорисовался сайт. js-скрипты, разные библиотеки js и прочее. То что должно быть в конце каждой страницы
    include "footer.php";
?>