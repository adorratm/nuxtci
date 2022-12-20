<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveProduct)"
        enctype="multipart/form-data"
        method="POST"
      >
        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="host"
                :name="$t('panel.products.host')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="host" class="mb-5">{{
                  $t("panel.products.host")
                }}</label>
                <input
                  id="host"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.products.host')"
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
                :name="$t('panel.products.port')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="port" class="mb-5">{{
                  $t("panel.products.port")
                }}</label>
                <input
                  id="port"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.products.port')"
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
                :name="$t('panel.products.email')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="email" class="mb-5">{{
                  $t("panel.products.email")
                }}</label>
                <input
                  id="email"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.products.email')"
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
                :name="$t('panel.products.password')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="password" class="mb-5">{{
                  $t("panel.products.password")
                }}</label>
                <input
                  id="password"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.products.password')"
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
    async saveProduct() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/products/update/" + this.id
          : "v1/panel/products/save/";
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
          this.$router.replace("/panel/products/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getProduct(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/products/" + id);
        if (data && data.product) {
          this.formData = data.product;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getProduct(this.id);
    }
  },
};
</script>