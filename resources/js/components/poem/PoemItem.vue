<template>
  <div class="poem">
    <div class="loading" v-if="loading">Loading...</div>

    <div v-if="error" class="error">{{ error }}</div>
    <strong>Название:</strong>
    {{ poem.title }}
    <br />
    <strong>Автор:</strong>
    {{ poem.author_id }}
    <br />
    <br />
    <br />
    <pre>{{ poem.content }}</pre>
    <br />
    <br />
    <router-link :to="{ name: 'editPoem', params: poem.id }"
      >Редактивровать стихотворение</router-link
    >
    <h2 v-if="averageRating">Средняя оценка {{ averageRating }}</h2>
    <h2 v-if="rating">Ваша текущая оценка {{ rating }}</h2>
    <h2 v-else>Пока что вы не оценили это стихотворение</h2>

    <div class="ratings">
      <span class="fa fa-star-o" v-for="n in maxRate" :key="n" @click="ratePoem(n)">
        <svg
          version="1.1"
          baseProfile="tiny"
          id="Layer_1"
          xmlns:x="&ns_extend;"
          xmlns:i="&ns_ai;"
          xmlns:graph="&ns_graphs;"
          xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink"
          xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
          x="0px"
          y="0px"
          width="42px"
          height="42px"
          viewBox="0 0 42 42"
          xml:space="preserve"
        >
          <g>
            <path
              fill-rule="evenodd"
              d="M21,1c1.081,0,5.141,12.315,6.201,13.126s13.461,1.053,13.791,2.137
		c0.34,1.087-9.561,8.938-9.961,10.252c-0.409,1.307,3.202,13.769,2.331,14.442c-0.879,0.673-11.05-6.79-12.361-6.79
		c-1.311,0-11.481,7.463-12.36,6.79c-0.871-0.674,2.739-13.136,2.329-14.442c-0.399-1.313-10.3-9.165-9.96-10.252
		c0.33-1.084,12.731-1.326,13.791-2.137S19.91,1,21,1z"
            />
          </g>
        </svg>
      </span>
    </div>
    <button v-if="rating" @click="resetRating">Сбросить оценку</button>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      loading: false,
      selectedRating: null,
      error: null,
      hoverFunction: "",
      hoverOutFunction: "",
      isRated: false,
      maxRate: 5,
    };
  },
  created() {
    //this.poem = null;
    console.log(this.$route);
    this.getSinglePoem(this.$route.params.id).then(() => {
      let data = {
        user_id: this.$auth.user().id,
        poem_id: this.poem.id,
      };
      this.getRating(data);
      this.getAvgRating(data.poem_id);
    });

    //this.$store.dispatch("GET_AVG_RATING", this.$route.params.id);
  },
  methods: {
    ...mapGetters("poem", ["singlePoem"]),
    ...mapGetters("rating", ["currentRating", "avgRating"]),
    ...mapActions("poem", ["getSinglePoem"]),
    ...mapActions("rating", [
      "getRating",
      "setRating",
      "resetCurrentRating",
      "getAvgRating",
    ]),
    ratePoem: function (rating) {
      let stars = document.querySelectorAll(".ratings span");
      let rateObj = {
        user_id: this.$auth.user().id,
        poem_id: this.poem.id,
        rating: rating,
      };
      this.setRating(rateObj)

      for (let k = 0; k < stars.length; k++) {
        stars[k].classList.remove("active_star");
      }
      this.selectedRating = rating;
      for (let i = 0; i < this.selectedRating; i++) {
        stars[i].classList.add("active_star");
      }
    },
    resetRating: function () {
      let rateObj = {
        poem_id: this.poem.id,
        user_id: this.$auth.user().id,
      };
      this.resetCurrentRating(rateObj).then(() => {
        let stars = document.querySelectorAll(".ratings span");
        for (let i = 0; i < stars.length; i++) {
          stars[i].classList.remove("active_star");
        }
      });
    },
  },
  computed: {
    poem() {
      return this.singlePoem();
    },
    rating() {
      return this.currentRating();
    },
    averageRating() {
      return this.avgRating(this.poem.id);
    },
  },
  watch: {
    rating: function (newVal, oldVal) {
      console.log("new val = ", newVal); //здесь пустая строка если рейтинг нет и ничего не нажато
      console.log(typeof newVal, "type of newVal");
      console.log("old val =", oldVal);
      this.getAvgRating(this.poem.id);
      let stars = document.querySelectorAll(".ratings span");
      if (newVal === null || newVal == "") {
        for (let i = 0; i < stars.length; i++) {
          stars[i].addEventListener("mouseover", function hover() {
            stars[i].children[0].classList.add("highlight_svg");
            if (stars[i].previousElementSibling !== null) {
              stars[i].previousElementSibling.children[0].classList.add(
                "highlight_svg"
              );
              let prev = stars[i].previousElementSibling;
              while (prev) {
                prev.children[0].classList.add("highlight_svg");
                prev = prev.previousElementSibling;
              }
            }
          });
          stars[i].addEventListener("mouseout", function hoverOut() {
            stars[i].children[0].classList.remove("highlight_svg");
            if (stars[i].previousElementSibling !== null) {
              stars[i].previousElementSibling.children[0].classList.remove(
                "highlight_svg"
              );
              let prev = stars[i].previousElementSibling;
              while (prev) {
                prev.children[0].classList.remove("highlight_svg");
                prev = prev.previousElementSibling;
              }
            }
          });
        }
      } else {
        console.log("in else " + newVal);
        for (let i = 0; i < newVal; i++) {
          stars[i].classList.add("active_star");
        }
      }
    },
    // averageRating: function (newVal, oldVal){
      
    // }
  },
};
</script>