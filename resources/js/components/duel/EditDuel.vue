<template>
  <div class="row">
    <div class="duel-edit-wrap col-12">
      <div class="duel-edit-content">
        <duels-form
          @update-duel="updateDuelRequest"
          @get-poems-by-user1="updateUser1Poems"
          @get-poems-by-user2="updateUser2Poems"
          :usersList="allUsers"
          :participant1Poems="allParticipant1Poems"
          :participant2Poems="allParticipant2Poems"
          :duel="duel"
          :isEdit="true"
        ></duels-form>
      </div>
    </div>
    <alert-modal
      v-if="allAlerts.length"
      :propsData="allAlerts"
      @close-alert="closeAlert()"
    ></alert-modal>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import AlertModal from "../modals/AlertModal.vue";
import DuelsForm from "../forms/DuelsForm.vue";
export default {
  components: { AlertModal, DuelsForm },
  data() {
    return {
    };
  },
  created() {
    this.getUsers();
    this.getDuel(this.$route.params.id);
  },
  methods: {
    ...mapActions("poem", ["getPoemsByUser"]),
    ...mapActions("users", ["getUsers"]),
    ...mapGetters("poem", ["participant1Poems", "participant2Poems"]),
    ...mapGetters("users", ["usersList"]),
    ...mapActions("duel", ["updateDuel", "unsetAlerts", "getDuel"]),
    ...mapGetters("duel", ["alerts", "singleDuel"]),
    updateUser1Poems(dataFromEmit) {
      console.log(dataFromEmit);
      this.getPoemsByUser(dataFromEmit);
    },
    updateUser2Poems(dataFromEmit) {
      console.log(dataFromEmit);
      this.getPoemsByUser(dataFromEmit);
    },
    updateDuelRequest(dataFromEmit) {
      console.log(dataFromEmit);
      this.updateDuel(dataFromEmit);
    },
    closeAlert() {
      this.unsetAlerts();
      this.$router.push("/duels");
    },
  },
  computed: {
    allParticipant1Poems() {
      return this.participant1Poems();
    },
    allParticipant2Poems() {
      return this.participant2Poems();
    },
    allUsers() {
      return this.usersList();
    },
    allAlerts() {
      return this.alerts();
    },
    duel() {
      return this.singleDuel();
    },
  },
};
</script>

<style lang="scss" scoped>
</style>