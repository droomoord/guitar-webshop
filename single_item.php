<?php 
include 'partials/head.php';
include 'parsedown/Parsedown.php';
$Parsedown = new Parsedown();
$query_arr = explode('=', $_SERVER['QUERY_STRING']);
$query_param = $query_arr[count($query_arr) - 1];
$guitar = file_get_contents($path . "/guitars/" . $query_param);
$guitar = json_decode($guitar);
if (substr( $guitar->images[0]->url, 0, 4 ) !== "http"){
    $guitar->images[0]->url = $path . $guitar->images[0]->url;
};
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
    <div class="images-mobile" ref="imagesMobile">
        
        <div class="slider">
            <div class="arrow">
                <div class="left" @click="changeImageMobile('left')">
                    <svg viewBox="0 0 32 32" class="icon icon-chevron-left" viewBox="0 0 32 32" aria-hidden="true"><path d="M14.19 16.005l7.869 7.868-2.129 2.129-9.996-9.997L19.937 6.002l2.127 2.129z"/></svg>
                </div>
            </div>
            
            <div class="wrapper">
                <?php foreach($guitar->images as $index=>$image) {
                    if (substr( $image->url, 0, 4 ) !== "http"){
                        $image->url = $path . $image->url;
                    };
                    if ($index === 0){
                        echo "<img class='visible' src={$image->url}></img>";
                    } else {
                        echo "<img class='hidden' src={$image->url}></img>";
                    }
                } 
                ?>
            </div>

            <div class="arrow">
                <div class="right" @click="changeImageMobile('right')">
                    <svg viewBox="0 0 32 32" class="icon icon-chevron-right" viewBox="0 0 32 32" aria-hidden="true"><path d="M18.629 15.997l-7.083-7.081L13.462 7l8.997 8.997L13.457 25l-1.916-1.916z"/></svg>
                </div>
            </div>
        </div>
        
    </div>
        <div class="images">
            <a ref="imagelink" href="<?php echo $guitar->images[0]->url ?>" target="_blank">
                <img class="image-big" ref="image" src="<?php echo $guitar->images[0]->url ?>">
            </a>
            <?php
                if(count($guitar->images) > 1){ 
                    foreach($guitar->images as $image){
                        if (substr( $image->url, 0, 4 ) !== "http"){
                            $image->url = $path . $image->url;
                        };
                        echo "<img @mouseOver='changeImage(\"{$image->url}\")' class='thumb' src={$image->url}></img>";
                };
            }?>
        </div>
        <div class="info">
            <div @click="clickedAdd('<?php echo $guitar->id;?>')"><my-button show-cart text="Add to cart"></my-button></div>
            <h1><?php echo $guitar->name ?></h1>
            <p><?php echo $Parsedown->text($guitar->description); ?></p>
        </div>
    </div>
    <my-button text="back" onclick='window.history.back()'></my-button>
</div>

<?php include 'partials/footer.php'; ?>