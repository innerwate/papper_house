<template>
<div class="row">
  <div class="poem-edit-wrap col-12">
    <poems-form :poem="poem" :isEdit='true' :categories="categories" :historyPeopleProp="historyPeople" @update-poem="submitPoem" :userRoleName="_user.role.name" :isHistoryAuthor="poem.isHistoryAuthor"></poems-form>
     <alert-modal
      v-if="allAlerts.length"
      :propsData="allAlerts"
      @close-alert="closeAlert()"
    ></alert-modal>
  </div>
</div>
  
</template>
<script>
console.log();
import { mapGetters, mapActions } from "vuex";
import PoemsForm from '../forms/PoemsForm.vue';
import AlertModal from '../modals/AlertModal.vue';
export default {
  components: { PoemsForm, AlertModal },
  data() {
    return {
      
    };
  },
  created() {
   this.getSinglePoem(this.$route.params.id);
   this.getCategories();
   this.getHistoryPeople();
  },
  methods: {
    ...mapActions("poem", ["updatePoem", "getSinglePoem", "unsetAlerts"]),
    ...mapGetters("poem", ["errorList", "singlePoem", "alertList"]),
    ...mapActions("historyPeople", ["getHistoryPeople"]),
    ...mapGetters("historyPeople", ["historyPeopleList"]),
    ...mapActions("categories", ["getCategories"]),
    ...mapGetters("categories", ["categoriesList"]),
    submitPoem(poemItem) {
      poemItem.id = this.poem.id;
      if(poemItem.isHistoryAuthor === false) {
        poemItem.author_id = this._user.id;
      }
      console.log(poemItem, 'THIS IS POEM ITEM IN EDIT COMP')
      this.updatePoem(poemItem);
    },
    closeAlert() {
      this.unsetAlerts();
      this.$router.push("/poems");
    }
  },
  computed: {
    _user() {
      return this.$auth.user() || {};
    },
    historyPeople() {
      return this.historyPeopleList();
    },
    errors() {
      return this.errorList();
    },
    categories(){
      return this.categoriesList();
    },
    poem(){
      return this.singlePoem();
    },
    allAlerts(){
      return this.alertList();
    }
  },
};
</script>