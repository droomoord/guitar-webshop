Vue.component("cart", {
  data() {
    return {
      cartItems: [],
      path,
      toBeDeleted: -1,
    };
  },
  template: `
    <div class="cart">
        <div v-if="cart.length > 0" class="column-names">
            <span></span>
            <h4>Name</h4>
            <h4>Price</h4>
            <h4>Quantity</h4>   
        </div>
        <div v-if="cart.length > 0" >
          <template v-for="(item, index) in cart">
            <li :key="index" :class="{delete: toBeDeleted === item.id}">
            <img :src="item.images[0].formats.thumbnail.url" class="thumbnail"/>
            <a :href="'single_item.php?id=' + item.id">{{ item.name }}</a>
            <span>€{{ item.price }}</span>
            <div class="quantity-display">
                <button 
                @click="changeQuantity(item.id, false)" 
                :disabled="item.quantity <= 1">
                -
                </button>
                <span>{{ item.quantity }}</span>
                <button @click="changeQuantity(item.id, true)">+</button>
            </div>
            <div>
                <div @click="deleteItem(item.id)" class="delete-button">
                <img src="./assets/images/delete-lid.png" class="lid"/>
                <img src="./assets/images/delete-bin.png" class="bin"/>
                </div>
            </div>
            </li>
        </template>
          <button class="button" @click="$emit('close')">Continue shopping</button>
          <button class="button">Checkout</button>
          <div class="total"> total: €{{ total }} </div>
        </div>
       
        
        <div v-else class="empty-card-message">
        <h4>There are currently no items in your cart!</h4>
        <button class="button" @click="$emit('close')">Okay!</button>
        </div> 
    </div>`,

  methods: {
    deleteItem: function (id) {
      this.toBeDeleted = id;
      setTimeout(() => {
        const index = this.cart.map((item) => item.id).indexOf(id);
        this.cart.splice(index, 1);
      }, 500);
    },
    changeQuantity: function (id, increase) {
      const index = this.cart.map((item) => item.id).indexOf(id);
      if (increase) this.cart[index].quantity++;
      if (!increase) {
        this.cart[index].quantity <= 1 ? 1 : this.cart[index].quantity--;
      }
    },
  },

  props: ["cart"],
  computed: {
    total: function () {
      return this.cart
        .map((item) => item.price * item.quantity)
        .reduce((a, b) => a + b, 0);
    },
  },
});
