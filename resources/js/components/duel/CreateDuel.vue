<template>
  <div class="row">
    <div class="duel-create-wrap col-12">
      <div class="duel-create-content">
        <duels-form
          @create-duel="createDuel"
          @get-poems-by-user1="updateUser1Poems"
          @get-poems-by-user2="updateUser2Poems"
          :propsData="propsData"
          :usersList="allUsers"
          :participant1Poems="allParticipant1Poems"
          :participant2Poems="allParticipant2Poems"
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
      propsData: {
        isEdit: false,
        duel: {
          participant1_selected: "",
          participant2_selected: "",
          participant1_poem_selected: "",
          participant2_poem_selected: "",
          startedAt: "",
          deadline: "",
          description: "",
        },
      },
    };
  },
  created() {
    this.getUsers();
  },
  methods: {
    ...mapActions("poem", ["getPoemsByUser"]),
    ...mapActions("users", ["getUsers"]),
    ...mapGetters("poem", ["participant1Poems", "participant2Poems"]),
    ...mapGetters("users", ["usersList"]),
    ...mapActions("duel", ["storeDuel", "unsetAlerts"]),
    ...mapGetters("duel", ["alerts"]),
    updateUser1Poems(dataFromEmit) {
      console.log(dataFromEmit);
      this.getPoemsByUser(dataFromEmit);
    },
    updateUser2Poems(dataFromEmit) {
      console.log(dataFromEmit);
      this.getPoemsByUser(dataFromEmit);
    },
    createDuel(dataFromEmit) {
      console.log(dataFromEmit);
      this.storeDuel(dataFromEmit);
    },
    closeAlert() {
      this.unsetAlerts();
      this.$router.push("duels");
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
  },
};
</script>

<style lang="scss" scoped>
</style>