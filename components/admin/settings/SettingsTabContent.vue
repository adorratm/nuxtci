<template>
  <div>
    <ValidationObserver
      tag="form"
      ref="form"
      v-slot="{ handleSubmit }"
      @submit.prevent="handleSubmit(saveSettings)"
      enctype="multipart/form-data"
      method="POST"
    >
      <VueGoodWizard
        ref="wizard"
        :steps="steps"
        :onNext="nextClicked"
        :onBack="backClicked"
        :previousStepLabel="$t('panel.goBack')"
        :nextStepLabel="$t('panel.next')"
        :finalStepLabel="$t('panel.save')"
      >
        <div slot="siteInformations">
          <SiteInformations
            :company_name.sync="formData.company_name"
            :slogan.sync="formData.slogan"
          />
        </div>
        <div slot="addressInformations">
          <AddressInformations
            :address_informations.sync="formData.address_informations"
          />
        </div>
        <div slot="socialMedia">
          <SocialMedia
            :email.sync="formData.email"
            :facebook.sync="formData.sync"
            :instagram.sync="formData.instagram"
            :twitter.sync="formData.instagram"
            :youtube.sync="formData.youtube"
            :linkedin.sync="formData.linkedin"
            :medium.sync="formData.medium"
            :pinterest.sync="formData.pinterest"
            :appstore.sync="formData.appstore"
            :playstore.sync="formData.playstore"
          />
        </div>
        <div slot="logo">
          <Logo
            :logo.sync="formData.logo"
            :mobile_logo.sync="formData.mobile_logo"
            :favicon.sync="formData.favicon"
            :id="id"
          />
        </div>
        <div slot="metaTag">
          <MetaTag :meta_description.sync="formData.meta_description" />
        </div>
        <div slot="siteAnalytics">
          <SiteAnalytics
            :metrica.sync="formData.metrica"
            :analytics.sync="formData.analytics"
          />
        </div>
        <div slot="liveSupport">
          <LiveSupport :live_support.sync="formData.sync" />
        </div>
      </VueGoodWizard>
    </ValidationObserver>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import { GoodWizard } from "vue-good-wizard";
import SiteInformations from "~/components/admin/settings/wizard/SiteInformations.vue";
import AddressInformations from "~/components/admin/settings/wizard/AddressInformations.vue";
import SocialMedia from "~/components/admin/settings/wizard/SocialMedia.vue";
import Logo from "~/components/admin/settings/wizard/Logo.vue";
import MetaTag from "~/components/admin/settings/wizard/MetaTag.vue";
import SiteAnalytics from "~/components/admin/settings/wizard/SiteAnalytics.vue";
import LiveSupport from "~/components/admin/settings/wizard/LiveSupport.vue";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    VueGoodWizard: GoodWizard,
    SiteInformations,
    AddressInformations,
    SocialMedia,
    Logo,
    MetaTag,
    SiteAnalytics,
    LiveSupport,
  },
  props: ["steps", "id"],
  data() {
    return {
      formData: {
        company_name: null,
        slogan: null,
        address_informations: [
          {
            address: null,
            map: null,
            phones: [
              {
                phone: null,
                whatsapp: null,
                fax: null,
              },
            ],
          },
        ],
        email: null,
        facebook: null,
        instagram: null,
        twitter: null,
        youtube: null,
        linkedin: null,
        medium: null,
        pinterest: null,
        appstore: null,
        playstore: null,
        logo: null,
        mobile_logo: null,
        favicon: null,
      },
    };
  },
  methods: {
    getFormData(object) {
      return Object.keys(object).reduce((formData, key) => {
        if (object[key] !== null) {
          formData.append(
            key,
            Array.isArray(object[key])
              ? JSON.stringify(object[key])
              : object[key]
          );
        }
        return formData;
      }, new FormData());
    },
    nextClicked(currentPage) {
      const _this = this;
      // on next, we need to validate the form
      _this.$refs.form.validate().then((success) => {
        if (success) {
          //all is good, lets proceed to next step
          _this.$refs.wizard.goNext(true);
          if (currentPage == 5) {
            this.steps[6].options.nextDisabled = false;
            this.$emit("update:steps", this.steps);
          } else {
            this.steps[6].options.nextDisabled = true;
            this.$emit("update:steps", this.steps);
          }
          if (currentPage === 6) {
            this.saveSettings();
          }
          return true; //return false if you want to prevent moving to next page
        } else {
          //error. don't proceed.
          return false;
        }
      });
      return false; //don't proceed by default.
    },
    backClicked(currentPage) {
      return true; //return false if you want to prevent moving to previous page
    },
    async saveSettings() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/settings/update/" + this.id
          : "v1/panel/settings/save/";
        let { data } = await this.$axios.post(url, formData, {
          headers: {
            "Content-Type":
              "multipart/form-data; boundary=" + formData._boundary,
          },
        });
        data.status
          ? this.$toast.success(data.message, this.$t("successfully"))
          : this.$toast.error(data.message, this.$t("unsuccessfully"));
        setTimeout(() => {
          this.$router.replace("/panel/settings/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getSettings(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/settings/" + id);
        if (data && data.settings) {
          this.formData = data.settings;
          this.formData.address_informations = JSON.parse(
            data.settings.address_informations
          );
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getSettings(this.id);
    }
    setTimeout(() => {
      window.dispatchEvent(new Event("resize"));
    }, 500);
  },
};
</script>