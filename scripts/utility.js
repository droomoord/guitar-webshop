Vue.component("backdrop", {
  template: `<div class="backdrop"></div>`,
});

Vue.component("my-button", {
  name: "my-button",
  template: `<button class="my-button"><img v-if="showCart" src="./assets/images/shopping-cart.png"><span class="text">{{ text }}</span></button>`,
  props: {
    text: String,
    showCart: {
      type: Boolean,
      default: false,
    },
  },
});
