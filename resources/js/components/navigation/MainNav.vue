<template>
  <div class="container">
    <div class="header_wrap row">
      <div class="logo_wrapp col-6">
        <img :src="'/img/logo.png'" />
      </div>
      <div class="header_text col-6">
        <h1>Paper House</h1>
        <nav>
          <router-link
            v-if="this.$auth.check() == false"
            :to="{ name: 'sign-up' }"
            >Регистрация</router-link
          >
          <router-link
            v-if="this.$auth.check() == false"
            :to="{ name: 'sign-in' }"
            >Вход</router-link
          >
          <span v-if="this.$auth.check() == true">
            <a href="" @click.prevent="logout">Выйти</a>
          </span>
          <router-link :to="{ name: 'poems' }">Стихотворения</router-link>
          <router-link
            v-if="this.$auth.check() == true"
            :to="{ name: 'create-poem' }"
            >Добавить стихотворение</router-link
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
        url: '/api/auth/logout',
        redirect: { name: "signin" },
      });
    },
  },
};
</script>