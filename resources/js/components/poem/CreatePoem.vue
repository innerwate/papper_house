<template>
  <div class>
    <div class>
      <form @submit.prevent="create">
        <div class="form-group">
          <label for="title">Название:</label>
          <input class="form-control" type="text" id="title" v-model="title" />
        </div>
        <div class="form-group">
          <label for="content">Стихотворение:</label>
          <textarea
            class="form-control"
            rows="20"
            id="content"
            v-model="content"
          ></textarea>
        </div>
        <button class="btn btn-primary" type="submit" id="create">
          Создать
        </button>
      </form>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      title: "",
      content: "",
      errors: {},
    };
  },
  methods: {
    ...mapActions("poem", ["storePoem"]),
    create() {
      let app = this;
      this.errors = {};
      let data = {
        user: this.$auth.user().id,
        title: this.title,
        content: this.content,
      };
      this.storePoem(data);
    },
  },
  computed:{
    // _user() {
    //   return this.$auth.user() || {};
    // },
  }
};
</script>