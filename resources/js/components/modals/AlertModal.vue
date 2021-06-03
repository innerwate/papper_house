<template>
  <div>
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-wrap">
        <div class="close-modal">
          <button
            type="button"
            class="close"
            aria-label="Close"
            @click="closeModal"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-content">
          <div class="modal-message">{{ propsData }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations } from 'vuex';
export default {
  data() {
    return {
      //isVisible: this.propsData.isVisible,
    };
  },
  props: ["propsData"],
  methods: {
    closeModal() {
        this.$emit('close-alert');
    },
  },
  computed: {
  },
};
</script>

<style lang="scss" scoped>
</style>