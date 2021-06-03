<template>
    <form @submit.prevent="requestToCreate" class="duel-form">
      <div class="form-group">
        <select
          class="form-control "
          v-model.lazy="duel.participant1"
          @change="updateParticipant1Poems"
        >
          <option  disabled value="">Выберите участника 1</option>
          <option
            v-for="(user, index) in usersList"
            :key="index"
            :value="user.id"
          >
            {{ user.name }}
          </option>
        </select>
        <select class="form-control" v-model.lazy="duel.participant1Poem">
          <option  disabled value="">Выберите стихотворение участника 1</option>
          <option v-for="(poem, index) in participant1Poems" :key="index" :value="poem.id">
            {{ poem.title }}
          </option>
        </select>
        <select
          class="form-control"
          v-model="duel.participant2"
          @change="updateParticipant2Poems"
        >
          <option disabled value="">Выберите участника 2</option>
          <option
            v-for="(user, index) in usersList"
            :key="index"
            :value="user.id"
          >
            {{ user.name }}
          </option>
        </select>
        <select class="form-control" v-model="duel.participant2Poem">
          <option disabled value="">Выберите стихотворение участника 2</option>

          <option
            v-for="(poem, index) in participant2Poems"
            :key="index"
            :value="poem.id"
          >
            {{ poem.title }}
          </option>
        </select>
      </div>
      <div class="form-group row">
        <label for="datetime-local-input-started" class="col-3 col-form-label"
          >Дата и время старта</label
        >
        <div class="col-9">
          <input
            class="form-control"
            type="datetime-local"
            v-model="duel.started_at"
            step="1"
            id="datetime-local-input-started"
          />
        </div>
      </div>
      <div class="form-group row">
        <label for="datetime-local-input-deadline" class="col-3 col-form-label"
          >Дата и время окончания</label
        >
        <div class="col-9">
          <input
            class="form-control"
            type="datetime-local"
            v-model="duel.deadline_date"
            step="1"
            id="datetime-local-input-deadline"
          />
        </div>
      </div>
      <div class="form-group">
        <label for="description">Описание:</label>
        <textarea
          class="form-control"
          rows="10"
          id="description"
          v-model="duel.description"
        ></textarea>
      </div>
      <button class="btn btn-primary btn-form-create-update" type="submit" id="create">Создать</button>
    </form>
</template>

<script>
export default {
  data() {
    return {
     participant1_selected: "",
      participant2_selected: "",
      participant1_poem_selected: "",
      participant2_poem_selected: "",
      //startedAt: "",
      //deadline: "",
      //description: "",
    }
  },
  props: {
    isEdit: {
      type: Boolean,
      default: false,
    },
    usersList: {
      type: Array,
      default:()=>[],
    },
    participant1Poems: {
      type: Array,
      default:()=>[],
    },
    participant2Poems: {
      type: Array,
      default:()=>[],
    },
    // startedAt_date: "",
    // deadline_date: "",
    // description_text: {
    //   type: String,
    //   default: "",
    // },
    duel:{
      type: [Object, Array],
      default: () => []
    }
  },
  created () {
    console.log(document.getElementsByClassName('srs'));
    if(typeof this.duel.participant1 !== 'number'){
      this.duel.participant1 = '';
    }
    if(typeof this.duel.participant2 !== 'number'){
      this.duel.participant2 = '';
    }
    if(typeof this.duel.participant1 !== 'number'){
      this.duel.participant1Poem = '';
    }
    if(typeof this.duel.participant1 !== 'number'){
       this.duel.participant2Poem = '';
    }
  },
  methods: {
    updateParticipant1Poems() {
      let data = { user_id: this.duel.participant1, pNumber: 0 };
      this.$emit('get-poems-by-user1', data);
    },
    updateParticipant2Poems() {
      let data = { user_id: this.duel.participant2, pNumber: 1 };
      this.$emit('get-poems-by-user2', data);
    },
    requestToCreate(){
       let data = {
        participant1: this.duel.participant1,
        participant2: this.duel.participant2,
        participant1Poem: this.duel.participant1Poem,
        participant2Poem: this.duel.participant2Poem,
        startedAt: this.duel.started_at,
        deadline: this.duel.deadline_date,
        description: this.duel.description,
      };
      console.log(data)
      if(this.isEdit == false){
        this.$emit('create-duel', data)
        console.log('emit created hook')
      }
      else{
        data.duel_id = this.duel.id;
        this.$emit('update-duel', data)
        console.log('emit updated hook')
      }
    }
  },watch: {
    duel(newValue, oldValue) {
      if(this.isEdit === true){
      let data = { user_id: this.duel.participant1, pNumber: 0 };
      this.$emit('get-poems-by-user1', data);
      let data2 = { user_id: this.duel.participant2, pNumber: 1 };
      this.$emit('get-poems-by-user2', data2);
      }
    }
  },
};
</script>

<style lang="scss" scoped>
</style>