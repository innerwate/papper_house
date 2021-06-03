<template>
  <div class="row">
    <div class="poem-create-wrap col-12">
      <poems-form
        :userRoleName="_user.role.name"
        :historyPeopleProp="historyPeople"
        :categories="categories"
        @create-poem="createPoem"
      ></poems-form>
      <alert-modal
        v-if="allAlerts.length"
        :propsData="allAlerts"
        @close-alert="closeAlert()"
      ></alert-modal>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import PoemsForm from "../forms/PoemsForm.vue";
import AlertModal from "../modals/AlertModal.vue";
export default {
  components: { PoemsForm, AlertModal },
  data() {
    return {
      // title: "",
      // content: "",
      // is_historical_author: false,
      // author_selected: "",
      // year_of_created: '',
      // category_selected: ''
    };
  },
  methods: {
    ...mapActions("poem", ["storePoem", "storePoem", "unsetAlerts"]),
    ...mapGetters("poem", ["errorList", "alertList"]),
    ...mapActions("historyPeople", ["getHistoryPeople"]),
    ...mapGetters("historyPeople", ["historyPeopleList"]),
    ...mapActions("categories", ["getCategories"]),
    ...mapGetters("categories", ["categoriesList"]),
    createPoem(poemItem) {
      if(poemItem.isHistoryAuthor === false) {
        poemItem.author_id = this._user.id;
      }
      console.log(poemItem);
      this.storePoem(poemItem);
    },
    closeAlert() {
      this.unsetAlerts();
      this.$router.push("poems");
    },
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
    categories() {
      return this.categoriesList();
    },
    allAlerts() {
      return this.alertList();
    },
  },
  created() {
    this.getHistoryPeople();
    this.getCategories();
  },
};
</script>