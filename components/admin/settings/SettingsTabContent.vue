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
          <SiteInformations />
        </div>
        <div slot="addressInformations">
          <AddressInformations />
        </div>
        <div slot="socialMedia">
          <h4>Step 3</h4>
          <p>This is step 3</p>
        </div>
        <div slot="logo">
          <h4>Step 4</h4>
          <p>This is step 4</p>
        </div>
        <div slot="metaTag">
          <h4>Step 4</h4>
          <p>This is step 4</p>
        </div>
        <div slot="siteAnalysis">
          <h4>Step 4</h4>
          <p>This is step 4</p>
        </div>
        <div slot="liveSupport">
          <h4>Step 4</h4>
          <p>This is step 4</p>
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
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    VueGoodWizard: GoodWizard,
    SiteInformations,
    AddressInformations,
  },
  props: ["steps"],
  methods: {
    nextClicked() {
      const _this = this;

      // on next, we need to validate the form
      _this.$refs.form.validate().then((success) => {
        if (success) {
          //all is good, lets proceed to next step
          _this.$refs.wizard.goNext(true);
          return true; //return false if you want to prevent moving to next page
        } else {
          //error. don't proceed.
          console.log("error submit!!");
          return false;
        }
      });
      return false; //don't proceed by default.
    },
    backClicked(currentPage) {
      console.log("back clicked", currentPage);
      return true; //return false if you want to prevent moving to previous page
    },
    async saveSettings() {
      try {
        let response = await this.$axios.post("admin", {});
        this.$router.replace("/panel");
      } catch (error) {
        this.$refs.form.setErrors({
          email: [error.response.data.message],
          password: [error.response.data.message],
        });
      }
    },
  },
  mounted() {
    setTimeout(() => {
      window.dispatchEvent(new Event("resize"));
    }, 500);
  },
};
</script>