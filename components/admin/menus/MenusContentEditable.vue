<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveMenu)"
        enctype="multipart/form-data"
        method="POST"
      >
        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="title"
                :name="$t('panel.menus.title')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="title" class="mb-5">{{
                  $t("panel.menus.title")
                }}</label>
                <input
                  id="title"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.menus.title')"
                  type="text"
                  required
                  name="title"
                  v-model="formData.title"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="url"
                :name="$t('panel.menus.url')"
                rules="min:2"
                v-slot="{ errors }"
              >
                <label for="url" class="mb-5">{{
                  $t("panel.menus.url")
                }}</label>
                <input
                  id="url"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.menus.url')"
                  type="text"
                  name="url"
                  v-model="formData.url"
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
                vid="position"
                :name="$t('panel.menus.position')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="position" class="mb-5">{{
                  $t("panel.menus.position")
                }}</label>
                <select
                  name="position"
                  id="position"
                  class="form-control form-control-sm rounded-0"
                  v-model="formData.position"
                  required
                >
                  <option value="HEADER">HEADER</option>
                  <option value="HEADER_RIGHT">HEADER RIGHT</option>
                  <option value="MOBILE">MOBILE</option>
                  <option value="FOOTER">FOOTER</option>
                  <option value="FOOTER2">FOOTER 2</option>
                </select>
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="target"
                :name="$t('panel.menus.target')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="target" class="mb-5">{{
                  $t("panel.menus.target")
                }}</label>
                <select
                  name="target"
                  id="target"
                  class="form-control form-control-sm rounded-0"
                  v-model="formData.target"
                  required
                >
                  <option value="_self">{{ $t("panel.menus._self") }}</option>
                  <option value="_blank">{{ $t("panel.menus._blank") }}</option>
                  <option value="_parent">
                    {{ $t("panel.menus._parent") }}
                  </option>
                  <option value="_top">{{ $t("panel.menus._top") }}</option>
                </select>
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
        title: null,
        position: "HEADER",
        target: "_self",
        url: null,
        page_id: null,
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
    async saveMenu() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/menus/update/" + this.id
          : "v1/panel/menus/save/";
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
          this.$router.replace("/panel/menus/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getMenu(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/menus/" + id);
        if (data && data.menu) {
          this.formData = data.menu;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getMenu(this.id);
    }
  },
};
</script>