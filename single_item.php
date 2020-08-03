<?php 
include 'partials/head.php';
include 'parsedown/Parsedown.php';
$Parsedown = new Parsedown();
$query_arr = explode('=', $_SERVER['QUERY_STRING']);
$query_param = $query_arr[count($query_arr) - 1];
$guitar = file_get_contents($path . "/guitars/" . $query_param);
$guitar = json_decode($guitar); 
?>

<small class="breadcrumb">
    > 
    <a href='browse.php'>Guitars</a> 
    > 
    <a href="browse_results.php?category=<?php echo $guitar->category; ?>"><?php echo ucfirst($guitar->category); ?></a> 
    > 
    <a href="single_item.php?id=<?php echo $guitar->id; ?>"><?php echo $guitar->name; ?></a> 
</small>

<div class='single'>
    <div class="item">
        <div class="images">
            <a ref="imagelink" href="<?php echo $guitar->images[0]->url ?>" target="_blank">
                <img class="image-big" ref="image" src="<?php echo $guitar->images[0]->url ?>">
            </a>
            <?php
                if(count($guitar->images) > 1){ 
                    foreach($guitar->images as $image){
                    echo "<img @mouseOver='changeImage(\"{$image->url}\")' class='thumb' src={$image->url}></img>";
                };
            }?>
        </div>
        <div class="info">
            <div @click="clickedAdd('<?php echo $guitar->id;?>')"><my-button></my-button></div>
            <h1><?php echo $guitar->name ?></h1>
            <p><?php echo $Parsedown->text($guitar->description); ?></p>
        </div>
    </div>
    <button class='button' onclick='window.history.back()'>Back</button>
</div>

<?php include 'partials/footer.php'; ?>