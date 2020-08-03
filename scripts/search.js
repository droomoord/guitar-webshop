Vue.component("Search", {
  template: `
    <div>
      <div class="search-options">
        <div class="bar">
          <input type="text" placeholder="Search..." v-model="search" autofocus ref="search" v-on:keyup.enter="changeResults(search)">
          <img class="delete" src="assets/images/search-delete.png" @click="clearInput()"/>
        </div>
        <div class="name-desc">
          <input type="radio" id="search-category" value="name" v-model="nameOrDesc">
          <label for="search-category">Name</label>
          <input type="radio" id="search-category" value="description" v-model="nameOrDesc">
          <label for="search-category">Description</label>
        </div>
        <div class="range">
          <div>
            <label for="min">min</label>
            <input type="number" v-model="min" id="min">
          </div>
          <div>
            <label for="max">max</label>
            <input type="number" v-model="max" id="max">
          </div>
        </div>
        <div class="category">
          <label><input type="checkbox" value="electric" v-model="searchCheckboxes">Electric</label>
          <label><input type="checkbox" value="acoustic" v-model="searchCheckboxes">Acoustic</label>
          <label><input type="checkbox" value="bass" v-model="searchCheckboxes">Bass</label>
        </div>
      </div>
      <div v-for="item in results" v-if="search.length > 1" :key="item.id">
        <a v-if="item.price > min && item.price < max || max == 0" :href="'./single_item.php?id=' + item.id" class="search-item" ref="searchItems">
          <img :src="item.images[0].formats.thumbnail.url">
          <h4>{{ item.name }} - <span class="item-price"> €{{ item.price }} </span></h4>
          <span class="right" @click.prevent="$emit('clicked-add', item.id)"><my-button></my-button></span>
        </a>
      </div>
      <div v-if="results.length === 0 && search.length > 1">No results for "{{ search }}"</div>
    </div>`,
  data() {
    return {
      path,
      search: "",
      data: [],
      results: [],
      nameOrDesc: "name",
      min: 0,
      max: 0,
      searchCheckboxes: ["electric", "acoustic", "bass"],
    };
  },

  mounted() {
    const getData = async () => {
      const { data } = await axios({
        method: "get",
        url: path + "/guitars",
      });
      this.data = data;
    };
    getData();
    setTimeout(() => {
      this.search = this.$refs.search.value;
    }, 1000);
  },
  watch: {
    search: function () {
      this.changeResults();
    },
    nameOrDesc: function () {
      this.changeResults();
    },
    searchCheckboxes: function () {
      this.changeResults();
    },
  },
  methods: {
    changeResults: function () {
      this.results = [];
      const searchArr = this.search.split(" ");
      this.data.forEach((item) => {
        const wordMatch = searchArr.every((word) => {
          const regExp = new RegExp(word, "i");
          return item[this.nameOrDesc].match(regExp);
        });
        const categoryMatch = this.searchCheckboxes.includes(item.category);
        if (wordMatch && categoryMatch) {
          this.results.push(item);
        }
      });
    },
    clearInput: function () {
      this.search = "";
      this.$refs.search.focus();
    },
  },
});
