<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveCodesSettings)"
        enctype="multipart/form-data"
        method="POST"
      >
        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="host"
                :name="$t('panel.codesSettings.host')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="host" class="mb-5">{{
                  $t("panel.codesSettings.host")
                }}</label>
                <input
                  id="host"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.codesSettings.host')"
                  type="text"
                  required
                  name="host"
                  v-model="formData.host"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="port"
                :name="$t('panel.codesSettings.port')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="port" class="mb-5">{{
                  $t("panel.codesSettings.port")
                }}</label>
                <input
                  id="port"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.codesSettings.port')"
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
                vid="email"
                :name="$t('panel.codesSettings.email')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="email" class="mb-5">{{
                  $t("panel.codesSettings.email")
                }}</label>
                <input
                  id="email"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.codesSettings.email')"
                  type="text"
                  required
                  name="email"
                  v-model="formData.email"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="password"
                :name="$t('panel.codesSettings.password')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="password" class="mb-5">{{
                  $t("panel.codesSettings.password")
                }}</label>
                <input
                  id="password"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.codesSettings.password')"
                  type="password"
                  required
                  name="password"
                  v-model="formData.password"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
        </div>

        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <button
                class="btn btn-pink btn-sm rounded-0"
                type="submit"
                :disabled="invalid"
              >
                {{ $t("panel.save") }}
              </button>
            </div>
          </div>
        </div>
      </form>
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
        host: null,
        port: null,
        email: null,
        password: null,
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
    async saveCodesSettings() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/codes/update/" + this.id
          : "v1/panel/codes/save/";
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
          this.$router.replace("/panel/codes/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getCodesSettings(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/codes/" + id);
        if (data && data.codes) {
          this.formData = data.codes;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getCodesSettings(this.id);
    }
  },
};
</script>