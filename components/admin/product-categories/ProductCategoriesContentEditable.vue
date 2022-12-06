<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveProductCategory)"
        enctype="multipart/form-data"
        method="POST"
      >
        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="title"
                :name="$t('panel.productCategories.title')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="title" class="mb-5">{{
                  $t("panel.productCategories.title")
                }}</label>
                <input
                  id="title"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.productCategories.title')"
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
                vid="codes_id"
                :name="$t('panel.productCategories.codesId')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="codes_id" class="mb-5">{{
                  $t("panel.productCategories.codesId")
                }}</label>
                <input
                  id="codes_id"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.productCategories.codesId')"
                  type="text"
                  required
                  name="codes_id"
                  v-model="formData.codes_id"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
        </div>

        <div class="row mb-1">
          <div class="col-sm-4">
            <div class="form-group my-3">
              <ValidationProvider
                vid="img_url"
                :name="$t('panel.productCategories.imgUrl')"
                :rules="{ required: id ? false : true, image: true }"
                v-slot="{ validate, errors }"
              >
                <label for="img_url" class="mb-5">{{
                  $t("panel.productCategories.imgUrl")
                }}</label>
                <div class="row">
                  <div v-if="id && view_img_url" class="col-4">
                    <img
                      :src="
                        $config.API_URL +
                        'uploads/productcategories/' +
                        formData.img_url
                      "
                      class="img-fluid"
                      alt="Logo"
                    />
                  </div>
                  <div :class="id && view_img_url ? 'col-8' : 'col-12'">
                    <input
                      id="img_url"
                      class="form-control form-control-sm rounded-0"
                      :placeholder="$t('panel.productCategories.imgUrl')"
                      type="file"
                      name="img_url"
                      @change="validate"
                      @input="formData.img_url = $event.target.files[0]"
                    />
                  </div>
                </div>
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-3">
              <ValidationProvider
                vid="banner_url"
                :name="$t('panel.productCategories.bannerUrl')"
                :rules="{ required: id ? false : true, image: true }"
                v-slot="{ validate, errors }"
              >
                <label for="banner_url" class="mb-5">{{
                  $t("panel.productCategories.bannerUrl")
                }}</label>
                <div class="row">
                  <div v-if="id && view_banner_url" class="col-4">
                    <img
                      :src="
                        $config.API_URL +
                        'uploads/productcategories/' +
                        view_banner_url
                      "
                      class="img-fluid"
                      alt="Logo"
                    />
                  </div>
                  <div :class="id && view_banner_url ? 'col-8' : 'col-12'">
                    <input
                      id="banner_url"
                      class="form-control form-control-sm rounded-0"
                      :placeholder="$t('panel.productCategories.bannerUrl')"
                      type="file"
                      name="banner_url"
                      @change="validate"
                      @input="formData.banner_url = $event.target.files[0]"
                    />
                  </div>
                </div>
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
        codes_id: null,
        img_url: null,
        banner_url: null,
      },
      view_img_url: null,
      view_banner_url: null,
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
    async saveProductCategory() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/productcategories/update/" + this.id
          : "v1/panel/productcategories/save/";
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
          this.$router.replace("/panel/product-categories/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getProductCategory(id) {
      try {
        let { data } = await this.$axios.get(
          "v1/panel/productcategories/" + id
        );
        if (data && data.productCategory) {
          this.formData = data.productCategory;
          this.view_img_url = data.productCategory.img_url
          this.view_banner_url = data.productCategory.banner_url
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getProductCategory(this.id);
    }
  },
};
</script>