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
                vid="title"
                :name="$t('panel.userRoles.title')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="title" class="mb-5">{{
                  $t("panel.userRoles.title")
                }}</label>
                <input
                  id="title"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.userRoles.title')"
                  type="text"
                  required
                  name="title"
                  v-model="formData.title"
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
        title: null,
        permissions: []
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
    async saveUserRole() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/userroles/update/" + this.id
          : "v1/panel/userroles/save/";
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
          this.$router.replace("/panel/user-roles/");
        }, 1000);
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
    async getRole(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/userroles/" + id);
        if (data && data.user_roles) {
          this.formData = data.user_roles;
          this.formData.permissions = JSON.parse(this.formData.permissions);
        }
      } catch (error) {
        this.$toast.error(error.response.data.message, this.$t("error"));
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getRole(this.id);
    }
  },
};
</script>