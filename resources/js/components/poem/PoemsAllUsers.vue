<template>
  <div class="row">
    <div class="poems col-12">
      <div class="loading" v-if="loading">Loading...</div>
      <div v-if="error" class="error">{{ error }}</div>
      <!-- <span v-if="$auth.check()">текст для авторизованного</span> -->
      <categories-menu @update-poems="poemsByCategories" :isUsers="true"></categories-menu>
      <ul v-if="poems" class="poems_list">
        <li v-for="(poem, index) in pageOfItems" :key="index" class="col-4">
          <div class="poem_item">
            <div class="poem_content">
              <div class="poem_title">
                <router-link
                  :to="{ name: 'poem', params: { id: poem.id } }"
                  v-bind:data-id="id"
                  >{{ poem.title }}</router-link
                >
              </div>
              <div class="poem_author">{{ poem.author.creators.name }}</div>
              <div class="poem_text">
                <pre>{{ poem.content }}</pre>
              </div>
            </div>
          </div>
        </li>
      </ul>
      
    </div>
    <div class="pagination-wrap col-12 d-flex justify-content-center">
        <jw-pagination
          :pageSize="6"
          :items="poems"
          :labels="customLabels"
          @changePage="onChangePage"
        ></jw-pagination>
      </div>
  </div>
</template>
<script>
const customLabels = {
  first: "<<",
  last: ">>",
  previous: "<",
  next: ">",
};

import axios from "axios";
import { mapActions, mapGetters } from "vuex";
import CategoriesMenu from "../categories/CategoriesMenu.vue";
export default {
  components: { CategoriesMenu },
  data() {
    return {
      loading: false,
      error: null,
      pageOfItems: [],
      //poems: [],
      id: null,
      customLabels,
    };
  },
  created() {
    //this.$store.dispatch("getPoems");
    this.getPoems(true);
    this.poemsList();
    console.log(this.poem);
  },
  methods: {
    ...mapActions("poem", ["getPoems", "getPoemsByCategories"]),
    ...mapGetters("poem", ["poemsList"]),
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    deletePoem(id, index) {
      console.log(index);
      this.$store.dispatch("DELETE_POEM", id).then((response) => {
        this.loading = false;
        console.log("deleted");
        console.log(this.poems);
      });
      this.poems.splice(index, 1);
      //this.$store.commit("delete_poem", id);
    },
    poemsByCategories(categoriesArray) {
        let data = {'categoriesArray' : categoriesArray, 'isUsers': true};
      this.getPoemsByCategories(data);
    },
  },
  computed: {
    poems() {
      return this.poemsList();
    },
  },
};
</script>