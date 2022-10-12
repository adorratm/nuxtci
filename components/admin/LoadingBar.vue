<template>
  <!-- Preloader -->
    <div class="preloader-it" v-show="loading">
      <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
</template>

<script>
  export default {
    data: () => ({
      loading: false,
    }),
    methods: {
      start() {
        this.loading = true
      },
      finish() {
        this.loading = false
      },
    },
  }
</script>