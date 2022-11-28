<template>
  <div>
    <!-- HK Wrapper -->
    <div class="hk-wrapper d-none">
      <!-- Main Content -->
      <div class="hk-pg-wrapper hk-auth-wrapper">
        <Header />
        <Nuxt />
      </div>
    </div>
  </div>
</template>

<script>
import Header from "~/components/admin/login/Header.vue";
export default {
  auth:'guest',
  name: "adminLogin",
  components: {
    Header,
  },
  head: {
    title: "Mutfak Yapım Dijital Reklam Ajansı | Admin Paneli Girişi",
    meta: [
      { charset: "utf-8" },
      { name: "viewport", content: "width=device-width, initial-scale=1" },
      {
        hid: "description",
        name: "description",
        content:
          "Mutfak Yapım Dijital Reklam Ajansı Sosyal Medya Yönetim Platformu",
      },
      { name: "format-detection", content: "telephone=no" },
    ],
    link: [
      { rel: "icon", type: "image/x-icon", href: "/favicon.ico" },
      { rel: "stylesheet", type: "text/css", href: "/vendor/css/style.css" },
    ],
    script: [
      { src: "/vendor/js/jquery.min.js", body: true },
      {
        src: "/vendor/js/bootstrap.bundle.min.js",
        body: true,
        defer:true,
      },
      { src: "/vendor/js/dropdown-bootstrap-extended.js", body: true,defer:true },
      {
        src: "/vendor/js/owlcarousel/owl.carousel.min.js",
        body: true,
        ssr: false,
        defer:true,
      },
      { src: "/vendor/js/init.js", body: true,defer:true },
    ],
  },
  middleware:['auth','unauthenticated']
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