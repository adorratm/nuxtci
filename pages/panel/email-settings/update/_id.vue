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
                    <h6 class="mb-10">{{ $t("panel.settings.settings") }}</h6>
                    <p class="font-14 w-80">
                      {{ $t("panel.settings.settingsDesc") }}
                    </p>
                  </div>
                  <div class="d-flex align-items-center">
                    <nuxt-link
                      class="btn btn-sm btn-outline-primary rounded-0"
                      to="/panel/settings/"
                      >{{ $t("panel.goBack") }}</nuxt-link
                    >
                  </div>
                </div>
                <div class="card-body">
                  <EmailSettingsContent :steps.sync="steps" :id="this.$route.params.id" />
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
import EmailSettingsContent from "~/components/admin/email-settings/EmailSettingsContent.vue";
export default {
  layout: "admin",
  components: {
    EmailSettingsContent,
  },
  data() {
    return {
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.$nuxt.$loading.start();
      $(".preloader-it").delay(500).fadeOut("slow");
      setTimeout(() => {
        this.$nuxt.$loading.finish();
        $(".hk-wrapper").removeClass("d-none");
      }, 500);
    });
  },
};
</script>