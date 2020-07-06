<template>
  <div class="poem">
    <div class="loading" v-if="loading">Loading...</div>

    <div v-if="error" class="error">{{ error }}</div>

    <ul v-if="poem">
      <li v-for="{ title,author,id, content } in poem  " v-bind:key="id">
        <strong>Название:</strong>
        {{ title }},
        <br />
        <strong>Автор:</strong>
        {{author}},
        <br />
        <br />
        <br />
        <pre>{{ content }}</pre>
        <br />
        <br />
        <router-link :to="{ name: 'editPoem', params:{id} }">Edit poem</router-link>
      </li>
    </ul>
    <h2>Average rating {{avgRating}}</h2>
    <h2>Current rating {{rating}}</h2>

    <div class="ratings">
      <span class="fa fa-star-o" @click="ratePoem(1)">
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
      <span class="fa fa-star-o" @click="ratePoem(2)">
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
      <span class="fa fa-star-o" @click="ratePoem(3)">
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
      <span class="fa fa-star-o" @click="ratePoem(4)">
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
      <span class="fa fa-star-o" @click="ratePoem(5)">
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
    <button @click="resetRating">Reset rating</button>
  </div>
</template>
<script>
import axios from "axios";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      loading: false,
      selectedRating: null,
      error: null,
      ratign: "",
      hoverFunction: "",
      hoverOutFunction: "",
      isRated: false
    };
  },
  created() {
    this.poem = null;

    this.$store.dispatch("GET_SINGLE_POEM", this.$route.params.id).then(() => {
      console.log("poem = " + this.$store.getters.poemId);
    });

    this.$store
      .dispatch("GET_RATING", {
        user_id: this.$store.getters.userId,
        poem_id: this.$route.params.id
      })
      .then(() => {
        console.log(this.$store.getters.currentRating + "heh");
        let stars = document.querySelectorAll(".ratings span");
        if (this.$store.getters.currentRating == null) {
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
          console.log("in else " + this.$store.getters.currentRating);
          for (let i = 0; i < this.$store.getters.currentRating; i++) {
            stars[i].classList.add("active_star");
          }
        }
      });
    this.$store.dispatch("GET_AVG_RATING", this.$route.params.id);
  },
  async mounted() {
    this.$nextTick(function() {});
  },

  methods: {
    ratePoem: function(rating) {
      let stars = document.querySelectorAll(".ratings span");
      this.$store.dispatch("RATE_POEM", {
        user_id: this.$store.getters.userId,
        poem_id: this.$store.getters.poemId,
        rating: rating
      });

      for (let k = 0; k < stars.length; k++) {
        stars[k].classList.remove("active_star");
      }
      this.selectedRating = rating;
      for (let i = 0; i < this.selectedRating; i++) {
        stars[i].classList.add("active_star");
      }
    },
    resetRating: function() {
      this.$store
        .dispatch("RESET_RATING", {
          user_id: this.$store.getters.userId,
          poem_id: this.$store.getters.poemId
        })
        .then(() => {});
      let stars = document.querySelectorAll(".ratings span");
      for (let i = 0; i < stars.length; i++) {
        stars[i].classList.remove("active_star");
      }
    }
  },
  computed: {
    ...mapGetters({
      ratingP: "currentRating",
      avgRating: "avgRating"

      // ...
    }),
    poem: {
      get: function() {
        return this.$store.state.currentPoem;
      },
      set: function(v) {}
    },
    rating: {
      get: function() {
        return this.$store.state.currentRating;
      },
      set: function(v) {}
    },
    avg_rating: {
      get: function() {
        console.log(this.$store.state.avgRating);
        return this.$store.state.avgRating;
      },
      set: function(v) {}
    }
  },
  watch: {
    ratingP(newCount, oldCount) {
      this.$store.dispatch("GET_AVG_RATING", this.$route.params.id);
      if (newCount == null) {
        let stars = document.querySelectorAll(".ratings span");
        if (this.$store.getters.currentRating == null) {
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
          console.log("in else " + this.$store.getters.currentRating);
          for (let i = 0; i < this.$store.getters.currentRating; i++) {
            stars[i].classList.add("active_star");
          }
        }
      }
    },
    avgRating(newCount, oldCount) {
      console.log("new avgRating = " + newCount);
      this.$store.state.avgRating = newCount;
    }
  }
};
</script>