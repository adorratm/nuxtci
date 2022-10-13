<template>
  <div>
    <!-- Container -->
    <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
      <!-- Row -->
      <div class="row">
        <div class="col-xl-12">
          <div class="hk-row">
            <div class="col-lg-12">
              <div class="card card-refresh">
                <div class="refresh-container">
                  <div class="loader-pendulums"></div>
                </div>
                <div class="card-header card-header-action">
                  <div class="flex-grow-1">
                    <h6 class="mb-10">Ayarlar</h6>
                    <p class="font-14 w-80">
                      Websitenizin Genel Ayarlarını Buradan Yönetebilirsiniz
                    </p>
                  </div>
                  <div class="d-flex align-items-center card-action-wrap">
                    <div class="inline-block dropdown">
                      <a
                        class="dropdown-toggle no-caret"
                        data-toggle="dropdown"
                        href="#"
                        aria-expanded="false"
                        role="button"
                        ><i class="ion ion-md-more"></i
                      ></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Separated link</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <keep-alive>
                    <Datatable
                      :dataurl="
                        $config.API_URL +
                        'v1/backend/settingsController/datatable'
                      "
                      :rankurl="$config.API_URL"
                      :token="this.$auth.strategy.token.get()"
                      :columns="columns"
                    />
                  </keep-alive>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /Row -->
    </div>
    <!-- /Container -->
  </div>
</template>
<script>
import Datatable from "~/components/admin/Datatable.vue";
export default {
  components: {
    Datatable,
  },
  layout: "admin",
  computed: {
    getUserInfo() {
      return this.$store.getters.getUserInfo;
    },
    isAuthenticated() {
      return this.$store.getters.isAuthenticated; // it check if user isAuthenticated
    },
  },
  data() {
    return {
      columns: [
        "<i class='fa fa-list'></i>",
        "<i class='fa fa-list'></i>",
        "#Id",
        "Firma Adı",
        "Dil",
        "Durum",
        "Oluşturulma Tarihi",
        "Güncelleme Tarihi",
        "İşlem",
      ],
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();
      $(".preloader-it").delay(500).fadeOut("slow");
      setTimeout(() => {
        this.$nuxt.$loading.finish();
        $(".hk-wrapper").removeClass("d-none");
      }, 1000);
    });
  },
};
</script>