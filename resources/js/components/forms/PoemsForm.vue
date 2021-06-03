<template>
  <div>
    <form @submit.prevent="submitPoem" class="poem-form">
      <div class="mt-20" v-show="userRoleName == 'admin'">
        <div class="form-group form-check">
          <input
            type="checkbox"
            id="is_history_author"
            v-model="isHistoryAuthor"
            class="form-check-input"
            ref="isHistoryAuthor"
            :true-value="true"
            :fals-value="false"
            
          />
          <label for="is_history_author" class="form-check-label"
            >Стихотворение исторической личности</label
          >
        </div>
        <div v-if="isHistoryAuthor">
          <div class="form-group">
            <label for="author">Автор:</label>
            <select
              class="form-control"
              v-model="poem.historyPerson"
              id="author"
              ref="authorPicker"
            >
              <option disabled value="">Выберите автора:</option>
              <option
                v-for="(historyPerson, index) in historyPeopleProp"
                :key="index"
                :value="historyPerson.id"
              >
                {{ historyPerson.name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="yearOfCreated">Год написания:</label>
            <input
              class="form-control"
              type="text"
              id="yearOfCreated"
              v-model="poem.year_of_created"
              ref="year_of_created"
            />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="category_id">Категория:</label>
        <select
          id="category_id"
          class="form-control"
          v-model="poem.category_id"
          ref="categoryPicker"
        >
          <option disabled value="">Выберите категорию</option>
          <option
            v-for="(category, index) in categories"
            :key="index"
            :value="category.id"
          >
            {{ category.title }}
          </option>
        </select>
      </div>
      <div class="form-group">
        <label for="title">Название:</label>
        <input
          class="form-control"
          type="text"
          id="title"
          v-model="poem.title"
          ref="title"
        />
      </div>
      <div class="form-group">
        <label for="content">Стихотворение:</label>
        <textarea
          class="form-control"
          rows="20"
          id="content"
          v-model="poem.content"
          ref="content"
        ></textarea>
      </div>
      <button v-if="isEdit" class="btn btn-primary btn-form-create-update" type="submit" id="create">
        Обновить
      </button>
      <button v-else class="btn btn-primary btn-form-create-update" type="submit" id="create">
        Создать
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      
    };
  },
  props: {
    poem: {
      type: [Array, Object],
      default: () => [],
    },
    isHistoryAuthor: {
        type: Boolean,
        default: false
    },
    userRoleName: {
      type: String,
      default: "",
    },
    historyPeopleProp: {
      type: Array,
      default: [],
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
    categories: {
      type: Array,
      default: [],
    },
    // poem.isHistoryAuthor:{
    //     type: Boolean,
    //     default: false,
    // }
  },
  created() {
    console.log(this.poem);

    if (typeof this.poem.category_id !== "number") {
      this.poem.category_id = "";
    }
    if (typeof this.poem.category_id !== "number") {
      this.poem.category_id = "";
    }
    if (typeof this.poem.historyPerson !== "number") {
      this.poem.historyPerson = "";
    }
    // if(typeof this.poem.isHistoryAuthor !== "boolean"){
    //     this.poem.isHistoryAuthor = false;
    // }

    // if(typeof this.duel.participant1 !== 'number'){
    //   this.duel.participant1Poem = '';
    // }
    // if(typeof this.duel.participant1 !== 'number'){
    //    this.duel.participant2Poem = '';
    // }
  },
  methods: {
    submitPoem() {
      console.log(this.$refs);
      console.log(this.$refs.isHistoryAuthor.checked);
      var dataToEmit = {
        isHistoryAuthor: this.$refs.isHistoryAuthor.checked,
        category_id: this.$refs.categoryPicker.value,
        title: this.$refs.title.value,
        content: this.$refs.content.value,
      };
      if (this.isEdit === false) {
        if (this.$refs.isHistoryAuthor.checked === true) {
          dataToEmit.author_id = this.$refs.authorPicker.value;
          dataToEmit.year_of_created = this.$refs.year_of_created.value;
        }
        this.$emit("create-poem", dataToEmit);
      } else {
        if (this.$refs.isHistoryAuthor.checked === true) {
          dataToEmit.author_id = this.$refs.authorPicker.value;
          dataToEmit.year_of_created = this.$refs.year_of_created.value;
        }
        console.log(dataToEmit, 'THIS IS DATA TO EMIT')
        this.$emit("update-poem", dataToEmit);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
</style>