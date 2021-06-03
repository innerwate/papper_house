<template>
  <div class="duel">
    <div class="duel_item col-12">
      <div class="duel_header col-12 d-flex flex-row">
        <div
          class="duel_link justify-content-center"
          >Дуэль №{{ duel.id }}</div>
      </div>
      <div
        v-if="duel.is_active"
        class="col-2 offset-10 justify-content-end duel_status"
      >
        <div class="duel_status_text active">Активна</div>
      </div>
      <div v-else class="col-2 offset-10 justify-content-end duel_status">
        <div class="duel_status_text non-active">Не активна</div>
      </div>
      <div class="duel_started_at d-flex justify-content-center">
      Дата начала: {{ duel.started_at }}
      </div>
      <div class="duel_deadline_date d-flex justify-content-center">
      Активна до: {{ duel.deadline_date }}
      </div>
      <div class="duel_desc">
        <pre>{{ duel.description }}</pre>
      </div>
      <div class="row">
        <div
          class="participant-item col-6"
          v-for="(participant, j) in duel.currentParticipants"
          :key="j"
        >
          <div v-if="participant.is_current === 1">
            <div class="participant-avatar d-flex justify-content-center">
              <img :src="`${participant.avatar_url}`" />
            </div>
            <div v-if="participant.is_winner == 1" class="participant-status d-flex justify-content-center winner-status">
              Победитель
            </div>
            <!-- <div v-else class="participant-status dflex justify0content-center loser-status">
              Проигравший
            </div> -->
            <div class="participant-name d-flex justify-content-center">
              {{ participant.author.creators.name }}
            </div>
            <div
              class="participant-poem d-flex justify-content-center flex-column"
            >
              <div class="participant-poem-title d-flex justify-content-center">
                {{ participant.poem.title }}
              </div>
              <div
                class="participant-poem-content d-flex justify-content-center"
              >
                <pre>{{ participant.poem.content }}</pre>
              </div>
            </div>
            <div class="vote-button-wrap" v-if="duel.is_active === 1"> 
              <md-button
                v-if="duel.userVote == null"
                class="md-raised md-primary vote-button"
                @click="voteForParticipant(duel.id, participant.id)"
                >Голосовать <vote></vote
              ></md-button>
              <md-button
                v-else-if="duel.userVote.pivot.participant_id == participant.id"
                class="md-raised md-primary vote-button-disabled"
                disabled
                >Ваш выбор <vote></vote
              ></md-button>
            </div>
          </div>
        </div>
      </div>
      <div class="buttons_status col-12 d-flex justify-content-start flex-row">
        <md-button
          class="md-raised md-primary edit-duel"
        >
          <router-link
            :to="{ name: 'edit-duel', params: { id: duel.id } }"
            v-bind:data-id="duel.id"
            >Редактировать дуэль</router-link
          ></md-button
        >

        <md-button
          class="md-raised md-accent delete-duel"
          v-if="_user.role.name == 'admin'"
          v-on:click="deleteDuelItem(duel.id)"
        >
          Удалить дуэль
        </md-button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
import vote from "../svg/vote.vue";
export default {
  components: { vote },
  data() {
    return {
      loading: true,
      error: null,
      counter: 0,
    };
  },
  props: ["duel", "index"],
  created() {
  
  },
  methods: {
    ...mapActions("duel", ["deleteDuel", "getUserVote", "storeUserVote"]),
    ...mapGetters("duel", ["userVote", "alerts"]),
    voteForParticipant(duel_id, participant_id) {
      var voteData = {
        duel_id: duel_id,
        participant_id: participant_id,
        user_id: this._user.id,
      };
      this.storeUserVote(voteData);
    },
    deleteDuelItem(duelId) {
    this.$emit("delete-duel", duelId);
  },
  },
  computed: {
    _user() {
      return this.$auth.user();
    },
    userVoteComp() {
      return this.userVote();
    },
    allAlerts() {
      return this.alerts();
    },
  },
  watch: {},
};
</script>
<style>
</style>