<template>
  <div class="categories col-12 ">
    <div class="loading" v-if="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <ul v-if="categories" class="categories_list d-flex flex-row p-0 ">
      <li v-for="(category, index) in categories" :key="index" class="">
        <div class="category_item">
           <md-button class="md-dense md-primary" @click="categorySwitcher(category)"  :class="{'active_category': category.isActive}" >{{category.title}}<span class="category-count">&nbsp;({{category.count}})</span></md-button>
        </div>
      </li>
    </ul>
  </div>
</template>
<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      loading: false,
      error: null,
      categoriesArray: [],
      isActiveCategory: false
    };
  },
  props: {
    isUsers: {
      type: Boolean,
      default: false
    },
  },
  created() {
    //this.$store.dispatch("getPoems");
    this.getCategories(this.isUsers);
    this.categoriesList();
  },
  methods: {
    ...mapActions("categories", ["getCategories", "getPoemsByCategories"]),
    ...mapGetters("categories", ["categoriesList"]),
    categorySwitcher(category){
      console.log(category)
      console.log(this.categoriesArray);
      let index = this.categoriesArray.indexOf(category.id);
      if(index !== -1){
        this.categoriesArray.splice(index, 1);
      }
      else{
        this.categoriesArray.push(category.id);
      }

      category.isActive = !category.isActive;
      // event.target.classList.toggle('is-active')
      this.$emit('update-poems', this.categoriesArray);
    }
  },
  computed: {
    categories() {
      console.log('computed works!')
      return this.categoriesList();
    },
  },
};
</script>
<style>
</style>