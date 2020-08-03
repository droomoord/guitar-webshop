var vm = new Vue({
  el: "#app",
  data: {
    cart: [],
    show: false,
    apiData: [],
    itemIsBeingAdded: false,
  },
  methods: {
    clickedAdd: function (id) {
      this.itemIsBeingAdded = true;
      setTimeout(() => {
        this.itemIsBeingAdded = false;
      }, 500);
      this.addItem(id);
    },
    addItem: function (id) {
      const foundItem = this.cart.find((item) => item.id == id);
      if (foundItem) {
        foundItem.quantity++;
      } else {
        this.cart.push({
          ...this.apiData.find((item) => item.id == id),
          quantity: 1,
        });
      }
    },
    changeImage: function (url) {
      this.$refs.image.setAttribute("src", url);
      this.$refs.imagelink.setAttribute("href", url);
    },
    goToUrl: function (event) {
      console.log(event.target.value);

      window.location.href = event.target.value;
    },
  },
  mounted() {
    const init = async () => {
      let cart = [];
      if (document.cookie !== "" && document.cookie !== "cart=") {
        cart = document.cookie.slice(5).split(",");
      }
      const { data } = await axios({
        method: "get",
        url: path + "/guitars",
      });
      this.apiData = data;
      cart.map((id) => {
        if (id !== "" && this.apiData.find((item) => item.id == id))
          this.addItem(id);
      });
    };
    init();
  },
  computed: {
    ids: function () {
      const ids = [];
      this.cart.map((item) => {
        for (i = 0; i < item.quantity; i++) {
          ids.push(item.id);
        }
      });
      return ids;
    },
  },
  watch: {
    ids: function (val) {
      document.cookie = "cart=" + val.join();
    },
    show: function (val) {
      val
        ? (document.body.style.overflow = "hidden")
        : (document.body.style.overflow = "scroll");
    },
  },
});
