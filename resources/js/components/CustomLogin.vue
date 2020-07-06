<template>
  <div class="wrap_login">
    <div class="login_form col-3">
      <form @submit.prevent="submit">
        <div class="form-group">
          <label for="login">Введите ваш логин</label>
          <input class="form-control" type="text" id="login" v-model="login" />
        </div>
        <div class="form-group">
          <label for="password">Введите ваш пароль</label>
          <input class="form-control" type="password" id="password" v-model="password" />
        </div>

        <button class="btn btn-primary" id="log">Войти</button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      login: "",

      password: "",

      errors: {}
    };
  },

  methods: {
    submit() {
      let user = {
        login: this.login,
        password: this.password
      };
      this.$store.dispatch("AUTH_REQUEST", user).then(() => {
        this.$router.push("/poems");
      });
    }
  }
};
</script>