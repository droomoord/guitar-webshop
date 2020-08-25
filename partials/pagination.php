<?php 
    $numberOfGuitars = file_get_contents($path . "/guitars/count$category");
    $start = intval($query['_start']);

    $prevPageLink = $start > 0
    ? " <a href='browse_results.php$category$sort&_start=" . ($start - 10) . "&_limit=10'>< </a>" 
    : "<span>< </span>";
    echo $prevPageLink;

    for ($i = 0; $i <= floor($numberOfGuitars / 10); $i++){
        $active = $start === $i * 10 ? 'active' : NULL; 
        echo "<a class='$active'" 
            . "href='browse_results.php$category$sort&_start=" 
            . $i * 10 
            . "&_limit=10'>" 
            . strval($i + 1) 
            . " </a>";
    }
    
    $nextPageLink = ($start + 10) < $numberOfGuitars 
    ? " <a href='browse_results.php$category$sort&_start=" . ($start + 10) . "&_limit=10'> ></a>" 
    : "<span> ></span>";
    echo $nextPageLink;
?>    