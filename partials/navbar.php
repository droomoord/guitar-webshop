


<nav>
    <template v-if="sideDrawerIsOpen === true">
    <div class="side-drawer">
        <?php include 'navbar_links.php' ?>
    </div>
    <Backdrop @click.native="sideDrawerIsOpen = false"></Backdrop>
    </template>
    <img class="logo" src="./assets/images/logo.png" alt="logo">
    <div class="hamburger" @click="openSideDrawer">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <div class="links">
        <?php include 'navbar_links.php' ?>
    </div>
    <div class="shopping-cart" @click="show = !show">
            <img src="./assets/images/shopping-cart.png" alt="shopping-cart">
            <span v-if="ids.length !== 0"
                id="cart-items-number"
                :class="{jump: itemIsBeingAdded}"
                v-text="ids.length"
                >
            </span>
        </div>
</nav>