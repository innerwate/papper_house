<template>
  <div class="container">
    <div class="header_wrap row">
      <div class="logo_wrapp col-6">
        <img :src="'/img/logo.png'" />
      </div>
      <div class="header_text col-6">
        <h1>Paper House</h1>
        <nav>
          <md-button class="md-raised" v-if="this.$auth.check() == false"
            ><router-link class="md-raised" :to="{ name: 'sign-up' }"
              >Регистрация</router-link
            ></md-button
          >
          <md-button class="md-raised" v-if="this.$auth.check() == false">
            <router-link class="md-raised" :to="{ name: 'sign-in' }"
              >Вход</router-link
            ></md-button
          >
          <md-button
            class="md-raised md-accent"
            v-if="this.$auth.check() == true"
            @click.prevent="logout"
          >
            Выйти
          </md-button>
          <md-button class="md-raised"
            ><router-link className="md-raised" :to="{ name: 'poems' }"
              >Стихотворения</router-link
            ></md-button
          >
          <md-button class="md-raised" v-if="this.$auth.check() == true"
            ><router-link class="md-raised" :to="{ name: 'create-poem' }"
              >Добавить стихотворение</router-link
            ></md-button
          >

          <!-- <router-link :to="{ name: 'recomendations1' }">Recomendations</router-link> -->
        </nav>
      </div>
    </div>

    <div class="main_content">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    logout() {
      this.$auth.logout({
        makeRequest: true,
        url: "/api/auth/logout",
        redirect: { name: "signin" },
      });
    },
  },
};
</script>
<style>
.md-button-content {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.md-button-content a {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  padding: 0 8px;
  color: black !important;
}
.router-link-active{
  background-color: #7CEECE;
}
.md-button .md-ripple{
  padding: 0 0;
}
</style>