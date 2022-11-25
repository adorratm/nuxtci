<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveUser)"
        enctype="multipart/form-data"
        method="POST"
      >
        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="host"
                :name="$t('panel.users.host')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="host" class="mb-5">{{
                  $t("panel.users.host")
                }}</label>
                <input
                  id="host"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.host')"
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
                vid="protocol"
                :name="$t('panel.users.protocol')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="protocol" class="mb-5">{{
                  $t("panel.users.protocol")
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
                :name="$t('panel.users.port')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="port" class="mb-5">{{
                  $t("panel.users.port")
                }}</label>
                <input
                  id="port"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.port')"
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
                :name="$t('panel.users.email')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="email" class="mb-5">{{
                  $t("panel.users.email")
                }}</label>
                <input
                  id="email"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.email')"
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
                :name="$t('panel.users.password')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="password" class="mb-5">{{
                  $t("panel.users.password")
                }}</label>
                <input
                  id="password"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.password')"
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
        protocol: "ssl",
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
    async saveUser() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/users/update/" + this.id
          : "v1/panel/users/save/";
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
    async getUser(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/users/" + id);
        if (data && data.user) {
          this.formData = data.user;
        }
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getUser(this.id);
    }
  },
};
</script>