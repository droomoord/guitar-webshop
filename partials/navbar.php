

<?php 
    $current_url_arr = explode('/', $_SERVER['PHP_SELF']);
    $current_link = $current_url_arr[count($current_url_arr) - 1];
?>

<nav>
    <img class="logo" src="./assets/images/logo.png" alt="logo">
    <div class="links">
        <a href="browse.php" 
            <?php echo ($current_link === 'browse.php' 
                        || $current_link === 'browse_results.php' 
                        ? 'class=active' : NULL);?>
        >Browse</a>
        <a href="search.php"
            <?php echo ($current_link === 'search.php' ? 'class=active' : NULL);?>
        >Search</a>
        <a href="contact.php"
            <?php echo ($current_link === 'contact.php' ? 'class=active' : NULL);?>
        >Contact</a>
        <div @click="show = !show">
            <img src="./assets/images/shopping-cart.png" alt="shopping-cart">
            <span v-if="ids.length !== 0"
                id="cart-items-number"
                :class="{jump: itemIsBeingAdded}"
                v-text="ids.length"
                >
            </span>
        </div>
    </div>
</nav>