<?php 
    include 'partials/head.php';
    include 'parsedown/Parsedown.php';

    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($actual_link);
    parse_str($parts['query'], $query);
    $category = $query['category'] ? '?category=' . $query['category'] : NULL;
    
    $start = $query['_start'] ? '&_start=' . $query['_start'] : '&_start=0';
    $limit = $query['_limit'] ? '&_limit=' . $query['_limit'] : '&_limit=10';

    $sort = $query['_sort'] ? '&_sort=' . $query['_sort'] : NULL;
    $current_path = "browse_results.php$category";
    $guitars = file_get_contents($path . "/guitars$category$sort$start$limit");
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
        </a>     
    </small>
    <div class="sort">
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
    </div>
    <?php include 'partials/pagination.php'; ?>
    <div class="items">
    <?php 
        // start loop  
        foreach ($guitars as $guitar) {
            if (substr( $guitar->images[0]->formats->thumbnail->url, 0, 4 ) !== "http"){
                $guitar->images[0]->formats->thumbnail->url = $path . $guitar->images[0]->formats->thumbnail->url;
            };
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
                    <a 
                        href='./single_item.php?id=<?php echo $guitar->id; ?>'>
                        <img src="<?php echo $guitar->images[0]->formats->thumbnail->url; ?>"
                    >
                        <div class="description">
                            <?php echo $guitar->description; ?>   
                        </div>
                    </a>
                    <a class="name" href='./single_item.php?id=<?php echo $guitar->id; ?>'>
                        <h1><?php echo $guitar->name; ?></h1>
                    </a>                
                </div>
                <div class="pricing">
                    <div class="box">
                        <h1>€<?php echo $guitar->price; ?></h1>
                        <span @click='clickedAdd("<?php echo $guitar->id; ?>")'>
                            <my-button show-cart class="big" text="Add to cart"></my-button>
                            <my-button show-cart class="small" text="Add"></my-button>
                        </span>
                    </div>
                </div>
            </div>

        <?php };
        
        include 'partials/pagination.php'; 

        ?> 
        <!-- end of loop -->

    </div>
</div>

<?php include 'partials/footer.php'; ?>