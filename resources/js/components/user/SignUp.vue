<template>
  <div class="wrap_reg row">
    <div class="reg_form col-9">
      <h1 class="reg_header">Регистрация</h1>
      <form @submit.prevent="register">
        <div class="form-group"></div>
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
        <div class="form-group">
          <div v-if="!image">
            <h2 class="load_avatar">Загрузите аватар <span>(предпочтительнее 3:4)</span></h2>
            <input type="file" @change="uploadImage" />
          </div>
          <div v-else>
            <img :src="image" />
            <button @click="removeImage">Удалить картинку</button>
          </div>
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
      avatar: null,
      errors: {},
      image: '',
      previewImage: null,
    };
  },

  methods: {
    register() {
      const data = new FormData();
      data.append("avatar", this.avatar);
      data.append("name", this.name);
      data.append("email", this.email);
      data.append("password", this.password);
      console.log(this.formData);
      this.$auth.register({
        data: data,
        url: "/api/auth/signup",
        //redirect: { name: "sign-in" },
        remember: "Rob",
        staySignedIn: true,
      });
      this.$auth.user();
    },
    uploadImage(event) {
      this.avatar = event.target.files[0];
    },
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;
      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function (e) {
      this.image = "";
    },
  },
};
</script>