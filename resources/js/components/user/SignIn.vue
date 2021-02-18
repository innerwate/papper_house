<template>
  <div class="wrap_login">
    <div class="login_form col-3">
      <h1>Вход</h1>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Введите ваш email</label>
          <input class="form-control" type="text" id="email" v-model="email" />
        </div>
        <div class="form-group">
          <label for="password">Введите ваш пароль</label>
          <input
            class="form-control"
            type="password"
            id="password"
            v-model="password"
          />
        </div>

        <button class="btn btn-primary" id="log">Войти</button>
      </form>
      <button @click.prevent="fetch" class="btn btn-primary" id="">
        fetch
      </button>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      errors: {},
    };
  },

  methods: {
    login() {
      let vm = this;
      this.$auth.login({
        data: {
          email: this.email,
          password: this.password,
        },
        //url: "/api/auth/signin",
        //redirect: { name: "poems" },
        remember: "Rob",
        staySignedIn: true,
        fetchUser: true,
      })
      .then((res) => {
        console.log(vm._user)
      });
    },
  },
  computed: {
    _user() {
      return this.$auth.user() || {};
    },
    _loaded() {
      return this.$auth.ready() && this.artificialLoad;
    },
  },
};
</script>