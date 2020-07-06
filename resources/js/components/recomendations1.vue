<template>
  <div class="users">
    <div class="question_block" v-for=" (item,index) in activeQuest" :key="index">
      {{question_number}}.{{item.question}}
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="step+'_answer_weigth'"
          :id="'firstAnswer_step'+step"
        />
        <label class="form-check-label" :for="'firstAnswer_step'+step">{{item.firstAnswer}}</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="step+'_answer_weigth'"
          :id="'secondAnswer_step'+step"
        />
        <label class="form-check-label" :for="'secondAnswer_step'+step">{{item.secondAnswer}}</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="step+'_answer_weigth'"
          :id="'thirdAnswer_step'+step"
        />
        <label class="form-check-label" :for="'thirdAnswer_step'+step">{{item.thirdAnswer}}</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="step+'_answer_weigth'"
          :id="'fourthAnswer_step'+step"
        />
        <label class="form-check-label" :for="'fourthAnswer_step'+step">{{item.fourthAnswer}}</label>
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          :name="step+'_answer_weigth'"
          :id="'fifthAnswer_step'+step"
        />
        <label class="form-check-label" :for="'fifthAnswer_step'+step">{{item.fifthAnswer}}</label>
      </div>
    </div>
    <button v-if="step>0" @click="prev">Prev</button>
    <button @click="next">Next</button>
  </div>
</template>
<script>
import axios from "axios";
let obj = [
  {
    question: "Is that first step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that second step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that thirth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that four step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that fifth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that sixth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that seventh step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that eigth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that ninth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that tenth step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that eleventh step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that twelve step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that thirteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that fourteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that fifteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that sixteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that seventeen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that eighteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that nineteen step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  },
  {
    question: "Is that twenty step?",
    firstAnswer: 0,
    secondAnswer: 1,
    thirdAnswer: 2,
    fourthAnswer: 3,
    fifthAnswer: 4
  }
];
console.log(obj);
export default {
  data() {
    return { weight: "", obj, question_number: 1 };
  },

  computed: {
    step() {
      return this.$store.state.step;
    },
    activeQuest: function() {
      let step_now = this.$store.state.step;
      return this.obj.filter(function(quest, index) {
        if (step_now == index) {
          return quest.question;
        }
      });
    }
  },
  methods: {
    next() {
      this.question_number++;
      this.$store.commit("next");
    },
    prev() {
      this.question_number--;
      this.$store.commit("prev");
    }
  }
};
</script>