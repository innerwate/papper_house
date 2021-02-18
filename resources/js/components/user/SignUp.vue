<template>
  <div class="wrap_reg row">
    <div class="reg_form col-3">
      <h1>Регистрация</h1>
      <form @submit.prevent="register">
        <div class="form-group">
        </div>
        <div class="form-group">
          <label for="login">Введите ваш email</label>
          <input class="form-control" type="email" id="email" v-model="email" />

          <div v-if="errors && errors.email" class="text-danger">
            {{ errors.email[0] }}
          </div>
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
        <div class="form-group">
          <label for="name">Введите ваше имя (псевдоним)</label>
          <input class="form-control" type="text" id="name" v-model="name" />
        </div>

        <button class="btn btn-primary" type="submit" id="reg">
          Зарегистрироваться
        </button>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      login: "",
      email: "",
      password: "",
      name: "",
      errors: {},
    };
  },

  methods: {
    register() {
      this.$auth.register({
        data: {
          name: this.name,
          email: this.email,
          password: this.password,
        },
        url: "/api/auth/signup",
        redirect: { name: "sign-in" },
        remember: "Rob",
        staySignedIn: true,
        // autoLogin: true,
        // fetchUser: true,
      });
      this.$auth.user();
    },
    // submit() {
    //   let app = this;
    //   this.errors = {};
    //   let data = {
    //     login: this.login,
    //     email: this.email,
    //     password: this.password,
    //     name: this.name
    //   };

    //   axios
    //     .post("/api/registration", data)
    //     .then(({ data }) => {
    //       alert("Вы успешно зарегистрированы");
    //       // TODO: сохранить полученные данные
    //       // data.token
    //       // data.user
    //     })
    //     .catch(error => {
    //       if (error.response.status === 422) {
    //         this.errors = error.response.data.errors || {};
    //       }
    //     });
    // }
  },
};
</script>