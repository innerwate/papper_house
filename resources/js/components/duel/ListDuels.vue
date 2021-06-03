<template>
  <div class="row">
      <ul v-if="duels" class="duels_list col-12">
        <div class="row">
          <li v-for="(duel, index) in pageOfItems" :key="index" class="col-12 duel-li">
        <duel-item :duel="duel" :index="index" @delete-duel="deleteDuelItem" @set-vote="updateDuels" ></duel-item>
      </li>
        </div>
      
    </ul>
      <div class="pagination-wrap col-12 d-flex justify-content-center">
      <jw-pagination
        :pageSize="6"
        :items="duels"
        :labels="customLabels"
        @changePage="onChangePage"
      ></jw-pagination>
    </div>
    <alert-modal
      v-if="allAlerts.length"
      :propsData="allAlerts"
      @close-alert="closeAlert()"
    ></alert-modal>
  </div>
</template>

<script>
const customLabels = {
  first: "<<",
  last: ">>",
  previous: "<",
  next: ">",
};
import axios from "axios";
import { mapActions, mapGetters } from "vuex";
import AlertModal from '../modals/AlertModal.vue';
import DuelItem from './DuelItem';
export default {
    components: {
        DuelItem,
        AlertModal
    },
  data() {
    return {
      pageOfItems: [],
      counter: 0,
      customLabels
    };
  },created () {
      this.getDuels(this._user.id);
      //this.duelsList();
  },
  methods: {
    ...mapActions("duel", ["getDuels", "deleteDuel", "storeUserVote", "unsetAlerts"]),
    ...mapGetters("duel", ["duelsList", "alerts"]),
    updateDuels(data){
      this.storeUserVote(data);
    },
    onChangePage(pageOfItems) {
      // update page of items
      this.pageOfItems = pageOfItems;
    },
    getParticipantNumber(...counter){
        if(counter < 2){
            counter++;
        }
        return counter;
    },
    deleteDuelItem(duelId, index){
      console.log(duelId, 'here')
      let data = {'duel_id' : duelId, 'user_id': this._user.id}
      this.deleteDuel(data)
      console.log('here migh be deleted duel')
      //this.duels.splice(index, 1)
    },
    closeAlert() {
      this.unsetAlerts();
      this.$router.push("/duels");
    }
  },
  computed: {
    duels(){
        return this.duelsList();
    },
    _user(){
      return this.$auth.user();
    },
    allAlerts(){
      return this.alerts();
    }
  },
  mounted() {},
  watch: {
    duels(newValue, oldValue) {},
  },
};
</script>

<style lang="scss" scoped>
</style>