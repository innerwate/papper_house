<template>
  <div class="wrap_reg row">
    <div class="reg_form col-3">
      <form @submit.prevent="submit">
        <!-- <div v-if="errors" v-for="category in errors">
          <div
            class="m-alert m-alert--outline alert alert-danger alert-dismissible"
            role="alert"
            v-for="error in category"
          >
            <span>{{ error }}</span>
          </div>
        </div>-->
        <div class="form-group">
          <label for="login">Введите ваш логин</label>
          <input class="form-control" type="text" id="login" v-model="login" />

          <div v-if="errors && errors.login" class="text-danger">{{ errors.login[0] }}</div>
        </div>
        <div class="form-group">
          <label for="login">Введите ваш email</label>
          <input class="form-control" type="email" id="email" v-model="email" />

          <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
        </div>
        <div class="form-group">
          <label for="password">Введите ваш пароль</label>
          <input class="form-control" type="password" id="password" v-model="password" />
        </div>
        <div class="form-group">
          <label for="name">Введите ваше имя</label>
          <input class="form-control" type="text" id="name" v-model="name" />
        </div>

        <button class="btn btn-primary" type="submit" id="reg">Зарегистрироваться</button>
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
      errors: {}
    };
  },

  methods: {
    submit() {
      let app = this;
      this.errors = {};
      let data = {
        login: this.login,
        email: this.email,
        password: this.password,
        name: this.name
      };

      axios
        .post("/api/registration", data)
        .then(({ data }) => {
          alert("Вы успешно зарегистрированы");
          // TODO: сохранить полученные данные
          // data.token
          // data.user
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.errors = error.response.data.errors || {};
          }
        });
    }
  }
};
</script>