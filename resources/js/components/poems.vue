<template>
  <div class="poems row">
    <div class="loading" v-if="loading">Loading...</div>

    <div v-if="error" class="error">{{ error }}</div>

    <ul v-if="poems" class="poems_list">
      <li v-for="( poem, index ) in pageOfItems" :key="index" class="col-4">
        <div class="poem_item">
          <router-link
            :to="{ name: 'poem', params:{id:poem.id}}"
            v-bind:data-id="id"
          >{{ poem.title }}</router-link>

          <strong>Автор:</strong>
          {{poem.author}}
          <p>{{poem.content}}</p>
          <!-- <div class="edit_poem">
            <router-link :to="{ name: 'editPoem', params:{id:poem.id} }">Edit poem</router-link>
          </div>-->
          <!-- <div class="delete_poem">
            <button v-on:click="deletePoem(poem.id, index)">Delete poem</button>
          </div>-->
        </div>
      </li>
    </ul>
    <div class="card-footer pb-0 pt-3">
      <jw-pagination :pageSize="6" :items="poems" @changePage="onChangePage"></jw-pagination>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  data() {
    return {
      loading: false,

      error: null,
      pageOfItems: [],
      id: null
    };
  },
  created() {
    this.$store.dispatch("getPoems");
  },
  methods: {
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    deletePoem(id, index) {
      console.log(index);
      this.$store.dispatch("DELETE_POEM", id).then(response => {
        this.loading = false;
        console.log("deleted");
        console.log(this.poems);
      });
      this.poems.splice(index, 1);
      //this.$store.commit("delete_poem", id);
    }
  },
  computed: {
    poems() {
      return this.$store.state.poems;
    }
  }
};
</script>