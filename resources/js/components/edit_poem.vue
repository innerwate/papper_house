<template>
  <div class="poem">
    <div class="loading" v-if="loading">Loading...</div>

    <div v-if="error" class="error">{{ error }}</div>
    <form @submit.prevent="editData">
      <div class="form-group">
        <label for="author">Автор:</label>
        <input class="form-control" type="text" id="author" v-model="author" />
      </div>
      <div class="form-group">
        <label for="title">Название:</label>
        <input class="form-control" type="text" id="title" v-model="title" />
      </div>
      <div class="form-group">
        <label for="year">Год написания:</label>
        <input class="form-control" type="text" id="year" v-model="year" />
      </div>
      <div class="form-group">
        <label for="poem">Стихотворение:</label>
        <textarea class="form-control" rows="20" id="poem" v-model="content"></textarea>
      </div>
      <button class="btn btn-primary" type="submit" id="create">Сохранить</button>
    </form>
  </div>
</template>
<script>
console.log();
import axios from "axios";
export default {
  data() {
    return {
      loading: false,
      poem: null,
      error: null,
      author: "",
      year: "",
      title: "",
      content: ""
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      let id = this.$route.params.id;
      this.poem = null;
      this.loading = true;
      console.log(id);
      axios.get("/api/poems/" + id).then(response => {
        this.loading = false;
        this.poem = response.data[0];
        this.author = this.poem.author;
        this.title = this.poem.title;
        this.year = this.poem.year;
        this.content = this.poem.content;
      });
    },
    editData() {
      let id = this.$route.params.id;
      this.poem = null;
      this.loading = true;
      let data = {
        author: this.author,
        title: this.title,
        year: this.year,
        content: this.content
      };
      axios.post("/api/poems/" + id + "/edit", data).then(response => {
        this.loading = false;
        this.$router.push(this.$route.query.redirect || "/poems");
      });
    }
  }
};
</script>