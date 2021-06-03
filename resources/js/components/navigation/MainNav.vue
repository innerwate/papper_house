<template>
  <div class="container">
    <div class="row">
      <div class="header_wrap col-12">
        <div class="row">
          <div class="logo_wrapp col-4">
            <img :src="'/img/logo.png'" />
          </div>
          <div class="header_text col-7 offset-1">
            <nav class="d-flex flex-row">
              <div class="poems_nav d-flex flex-column col-6">
                <md-button class="md-raised"
                  ><router-link className="md-raised" :to="{ name: 'poems' }"
                    >Стихотворения</router-link
                  ></md-button
                >
                <md-button class="md-raised" v-if="this.$auth.check() == true"
                  ><router-link class="md-raised" :to="{ name: 'users-poems' }"
                    >Стихотворения пользователей</router-link
                  ></md-button
                >
                <md-button class="md-raised" v-if="this.$auth.check() == true"
                  ><router-link :to="{ name: 'my-poems' }"
                    >Мои стихотворения</router-link
                  ></md-button
                >
                <md-button class="md-raised" v-if="this.$auth.check() == true"
                  ><router-link class="md-raised" :to="{ name: 'create-poem' }"
                    >Добавить стихотворение</router-link
                  ></md-button
                >
              </div>

              <div class="duels_nav d-flex flex-column col-6" >
                <md-button class="md-raised" v-if="this.$auth.check() == true"
                  ><router-link :to="{ name: 'duels' }"
                    >Список дуэлей</router-link
                  ></md-button
                >
                <md-button class="md-raised" v-if="this.$auth.check() == true"
                  ><router-link :to="{ name: 'create-duel' }"
                    >Добавить дуэль</router-link
                  ></md-button
                >
                <md-button
                  class="md-raised ml-0"
                  v-if="this.$auth.check() == false"
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
              </div>

              
            </nav>
          </div>
        </div>
      </div>

      <div class="main_content col-12">
        <router-view></router-view>
      </div>
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
  computed: {
    _user() {
      return this.$auth.user() || {};
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
.router-link-exact-active.router-link-active {
  background-color: #7ceece;
}
.md-button .md-ripple {
  padding: 0px 0px;
}
</style>