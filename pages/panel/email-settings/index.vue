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
                    <h6 class="mb-10">
                      {{ $t("panel.emailSettings.emailSettings") }}
                    </h6>
                    <p class="font-14 w-80">
                      {{ $t("panel.emailSettings.emailSettingsDesc") }}
                    </p>
                  </div>
                  <div class="d-flex align-items-center">
                    <nuxt-link
                      class="btn btn-sm btn-outline-primary rounded-0"
                      to="/panel/email-settings/add"
                      >{{ $t("panel.createNew") }}</nuxt-link
                    >
                  </div>
                </div>
                <div class="card-body">
                  <Datatable
                    :dataurl="
                      $config.API_URL +
                      'v1/backend/emailSettingsController/datatable'
                    "
                    :rankurl="
                      $config.API_URL +
                      'v1/backend/emailSettingsController/rank/'
                    "
                    :isactiveurl="
                      $config.API_URL +
                      'v1/backend/emailSettingsController/isactive/'
                    "
                    :editurl="'/panel/email-settings/update/'"
                    :deleteurl="
                      $config.API_URL + 'v1/panel/emailsettings/delete/'
                    "
                    :token="this.$auth.strategy.token.get()"
                    :columns="columns"
                    :sort="sort"
                  />
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
  data() {
    return {
      columns: [
        {
          label: this.$i18n.t("panel.rank"),
          field: "rank",
          html: true,
          width: "100px",
          type: "number",
        },
        {
          label: this.$i18n.t("panel.id"),
          field: "id",
          html: true,
          width: "65px",
          type: "number",
        },
        {
          label: this.$i18n.t("panel.emailSettings.email"),
          field: "email",
          html: true,
          type: "string",
        },
        {
          label: this.$i18n.t("panel.lang"),
          field: "lang",
          html: true,
          width: "60px",
          type: "string",
        },
        {
          label: this.$i18n.t("panel.isActive"),
          field: "isActive",
          html: true,
          type: "boolean",
        },
        {
          label: this.$i18n.t("panel.createdAt"),
          field: "createdAt",
          html: true,
          type: "string",
        },
        {
          label: this.$i18n.t("panel.updatedAt"),
          field: "updatedAt",
          html: true,
          type: "string",
        },
        {
          label: this.$i18n.t("panel.actions"),
          field: "actions",
          html: true,
          globalSearchDisabled: true,
          sortable: false,
        },
      ],
      sort: [
        {
          field: "rank",
          type: "none",
        },
        {
          field: "id",
          type: "none",
        },
        {
          field: "email",
          type: "none",
        },
        {
          field: "lang",
          type: "none",
        },
        {
          field: "isActive",
          type: "none",
        },
        {
          field: "createdAt",
          type: "none",
        },
        {
          field: "updatedAt",
          type: "none",
        },
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
      }, 500);
    });
  },
};
</script>