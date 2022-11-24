<template>
  <div>
    <ValidationObserver
      tag="form"
      ref="form"
      v-slot="{ handleSubmit }"
      @submit.prevent="handleSubmit(saveEmailSettings)"
      enctype="multipart/form-data"
      method="POST"
    >
    </ValidationObserver>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
  },
  props: ["id"],
  data() {
    return {
      formData: {

      },
    };
  },
  methods:{
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
          this.$router.replace("/panel/email-settings/");
        }, 1000);
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
    async getEmailSettings(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/settings/" + id);
        if (data && data.settings) {
          this.formData = data.settings;
        }
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
  }
};
</script>