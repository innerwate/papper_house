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
            v-if="this.$store.getters.isAuthenticated==false"
            :to="{ name: 'registration'  }"
          >Registration</router-link>
          <router-link
            v-if="this.$store.getters.isAuthenticated==false"
            :to="{ name: 'log-in' }"
          >Login</router-link>
          <span v-if="this.$store.getters.isAuthenticated==true">
            <a @click="loggout">loggout</a>
          </span>
          <router-link :to="{ name: 'poems' }">Poems</router-link>
          <router-link
            v-if="this.$store.getters.isAuthenticated==true"
            :to="{ name: 'create_poem' }"
          >Create poem</router-link>
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
    loggout() {
      this.$store.dispatch("LOGGOUT").then(() => {
        this.$router.push("/log-in");
      });
    }
  }
};
</script>