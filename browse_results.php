<?php 
    include 'partials/head.php';
    include 'parsedown/Parsedown.php'; 
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($actual_link);
    parse_str($parts['query'], $query);
    $category = $query['category'] ? '?category=' . $query['category'] : NULL;
    $sort = $query['_sort'] ? '&_sort=' . $query['_sort'] : NULL;
    $current_path = "browse_results.php$category";
    $guitars = file_get_contents($path . "/guitars$category$sort");
    $guitars = json_decode($guitars);
    $Parsedown = new Parsedown();
?>

<div id="browse-results">  
    <small class="breadcrumb">
    > 
        <a href='browse.php'>Guitars</a> 
    > 
        <a 
            href="browse_results.php?category=<?php echo $query['category']; ?>"><?php echo ucfirst($query['category']); ?> 
        <a>     
    </small>
    <label for="order">Sort by:</label>
    <select id="order" @change="goToUrl($event)">
        <option disabled hidden value selected>-select-</option>
        <option 
            value='<?php echo "$current_path&_sort=price:ASC"; ?>'
            <?php echo $query['_sort'] === "price:ASC" ? "selected" : NULL; ?>
            >
            Price (ascending)
        </option>
        <option 
            value='<?php echo "$current_path&_sort=price:DESC"; ?>'
            <?php echo $query['_sort'] === "price:DESC" ? "selected" : NULL; ?>
            >
            Price (descending)
        </option>
        <option 
            value='<?php echo "$current_path&_sort=name:ASC"; ?>'
            <?php echo $query['_sort'] === "name:ASC" ? "selected" : NULL; ?>
            >
            A - Z
        </option>
        <option 
            value='<?php echo "$current_path&_sort=name:DESC"; ?>'
            <?php echo $query['_sort'] === "name:DESC" ? "selected" : NULL; ?>
            >
            Z - A
        </option>
    </select>

    <!-- start loop -->
    <?php foreach ($guitars as $guitar) { 
        if(strlen($guitar->description) > 250){
            $guitar->description = substr($guitar->description, 0, 250) . '...<br/><small>-click to read more-</small>';
        };
        if (floor($guitar->price) == $guitar->price){
            $guitar->price = $guitar->price . ',-';
        } else{
            $guitar->price = number_format($guitar->price, 2);
        }; ?>

        <div class="item">
            <div class='specs'>
                <h1><?php echo $guitar->name; ?></h1>
                <a 
                    href='./single_item.php?id=<?php echo $guitar->id; ?>'>
                    <img src="<?php echo $guitar->images[0]->formats->thumbnail->url; ?>"
                >
                    <?php echo $Parsedown->text($guitar->description); ?>
                </a>
            </div>
            <div class="pricing">
                <div class="box">
                    <h1>€<?php echo $guitar->price; ?></h1>
                    <span @click='clickedAdd("<?php echo $guitar->id; ?>")'>
                        <my-button></my-button>
                    </span>
                </div>
            </div>
        </div>

    <?php };?> 
    <!-- end of loop -->

</div>

<?php include 'partials/footer.php'; ?>