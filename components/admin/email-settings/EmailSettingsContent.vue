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
      <div class="row mb-1">
        <div class="col-sm-4">
          <div class="form-group my-1">
            <ValidationProvider
              vid="protocol"
              :name="$t('panel.emailSettings.protocol')"
              rules="required"
              v-slot="{ errors }"
            >
              <label for="protocol" class="mb-5">{{
                $t("panel.emailSettings.protocol")
              }}</label>
              <select
                name="protocol"
                id="protocol"
                class="form-control form-control-sm rounded-0"
                required
                v-model="formData.protocol"
              >
                <option value="ssl" :selected="formData.protocol === 'ssl'">
                  SSL
                </option>
                <option value="tls" :selected="formData.protocol === 'tls'">
                  TLS
                </option>
              </select>
              <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group my-1">
            <ValidationProvider
              vid="port"
              :name="$t('panel.emailSettings.port')"
              rules="required"
              v-slot="{ errors }"
            >
              <label for="port" class="mb-5">{{
                $t("panel.emailSettings.port")
              }}</label>
              <input
                id="port"
                class="form-control form-control-sm rounded-0"
                :placeholder="$t('panel.emailSettings.port')"
                type="number"
                required
                name="port"
                v-model="formData.port"
              />
              <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>
        </div>
      </div>

      <div class="row mb-1">
        <div class="col-sm-4">
          <div class="form-group my-1">
            <ValidationProvider
              vid="host"
              :name="$t('panel.emailSettings.host')"
              rules="required|min:2"
              v-slot="{ errors }"
            >
              <label for="host" class="mb-5">{{
                $t("panel.emailSettings.host")
              }}</label>
              <input
                id="host"
                class="form-control form-control-sm rounded-0"
                :placeholder="$t('panel.emailSettings.host')"
                type="text"
                required
                name="host"
                v-model="formData.host"
              />
              <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
            </ValidationProvider>
          </div>
        </div>
      </div>
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
        protocol: "ssl",
        host: null,
        port: null,
        user: null,
        password: null,
        tomail: null,
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
    async saveEmailSettings() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/emailsettings/update/" + this.id
          : "v1/panel/emailsettings/save/";
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
        let { data } = await this.$axios.get("v1/panel/emailsettings/" + id);
        if (data && data.emailsettings) {
          this.formData = data.emailsettings;
        }
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
  },
};
</script>