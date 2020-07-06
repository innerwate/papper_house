<template>
  <div class>
    <div class>
      <form @submit.prevent="create">
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
          <textarea class="form-control" rows="20" id="poem" v-model="poem"></textarea>
        </div>
        <button class="btn btn-primary" type="submit" id="create">Создать</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      author: "",
      title: "",
      year: "",
      poem: "",
      errors: {}
    };
  },

  methods: {
    create() {
      let app = this;
      this.errors = {};
      let data = {
        author: this.author,
        title: this.title,
        year: this.year,
        poem: this.poem
      };

      axios
        .post("/api/create_poem", data)
        .then(({ data }) => {
          this.$router.push(this.$route.query.redirect || "/poems");
        })
        .catch(error => {
          alert("erorr!!!");
        });
    }
  }
};
</script>