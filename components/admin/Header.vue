<template>
  <div>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
      <a
        id="navbar_toggle_btn"
        class="navbar-toggle-btn nav-link-hover"
        href="javascript:void(0);"
        ><i class="fa fa-list"></i
      ></a>
      <nuxt-link class="navbar-brand" to="/panel/">
        <img
          class="brand-img d-inline-block"
          src="~/assets/logo.webp"
          width="160"
          alt="Mutfak Yapım Dijital Reklam Ajansı"
        />
      </nuxt-link>
      <ul class="navbar-nav hk-navbar-content">
        <li class="nav-item dropdown dropdown-authentication">
          <a
            class="nav-link dropdown-toggle no-caret"
            href="#"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            data-bs-toggle="dropdown"
          >
            <div class="media">
              <div class="media-img-wrap">
                <div class="avatar">
                  <i class="fa fa-user-circle fa-2x"></i>
                </div>
                <span class="badge badge-success badge-indicator"></span>
              </div>
              <div class="media-body">
                <span
                  >{{ getUserInfo?.first_name + " " + getUserInfo?.last_name
                  }}<i class="zmdi zmdi-chevron-down"></i
                ></span>
              </div>
            </div>
          </a>
          <div
            class="dropdown-menu dropdown-menu-right"
            data-dropdown-in="flipInX"
            data-dropdown-out="flipOutX"
          >
            <nuxt-link
              class="dropdown-item"
              :to="'/panel/users/update/' + getUserInfo?.id"
              ><i class="dropdown-icon fa fa-user-edit"></i
              ><span>{{ $t("panel.profile") }}</span></nuxt-link
            >
            <nuxt-link class="dropdown-item" to="/panel/settings/"
              ><i class="dropdown-icon fa fa-cogs"></i
              ><span>{{ $t("panel.settings.settings") }}</span></nuxt-link
            >
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" @click="logout()" href="javascript:void(0)"
              ><i class="dropdown-icon fa fa-power-off"></i
              ><span>{{ $t("panel.logout") }}</span></a
            >
          </div>
        </li>
      </ul>
    </nav>
    <!-- /Top Navbar -->
  </div>
</template>

<script>
export default {
  head: {
    title: "Mutfak Yapım Dijital Reklam Ajansı | Admin Paneli",
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
      },
      { src: "/vendor/js/dropdown-bootstrap-extended.js", body: true },
      { src: "/vendor/js/init.js", body: true },
    ],
  },
  computed: {
    getUserInfo() {
      return this.$store.getters.getUserInfo;
    },
    isAuthenticated() {
      return this.$store.getters.isAuthenticated; // it check if user isAuthenticated
    },
  },
  methods: {
    async logout() {
      try {
        await this.$auth.logout();
        // this method will logout the user and make token to false on the local storage of the user browser
        await this.$router.replace("/panel/login").then(() => {
          this.$toast.success(
            this.$t("logoutSuccessfully"),
            this.$t("successfully")
          );
        });
      } catch (e) {
        console.log(e);
      }
    },
  },
  mounted() {},
};
</script>