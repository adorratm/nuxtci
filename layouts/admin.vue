<template>
  <div>
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav d-none">
      <Header />
      <Sidebar />
      <!-- Main Content -->
      <div class="hk-pg-wrapper">
        <Nuxt />
        <Footer />
      </div>
    </div>
    <!-- /HK Wrapper -->
  </div>
</template>

<script>
import Header from "~/components/admin/Header.vue";
import Sidebar from "~/components/admin/Sidebar.vue";
import Footer from "~/components/admin/Footer.vue";
export default {
  name: "admin",
  components: {
    Header,
    Sidebar,
    Footer,
  },
  middleware:['authenticated']
};
</script>

<style scoped>
.layout-enter-active,
.layout-leave-active {
  transition: opacity 0.5s;
}
.layout-enter,
.layout-leave-to {
  opacity: 0;
}
</style>