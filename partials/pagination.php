<?php 
    $numberOfGuitars = file_get_contents($path . "/guitars/count$category");
    echo "<a href=''>< </a>";
    for ($i = 0; $i <= floor($numberOfGuitars / 10); $i++){
        $active = intval($query['_start']) === ($i) * 10 ? 'active' : NULL; 
        echo "<a class='$active'" 
            . "href='browse_results.php$category$sort&_start=" 
            . $i * 10 . "&_limit=10'>" 
            . strval($i + 1) 
            . " </a>";
    }
    echo "<a href=''>></a>";
    ?>    