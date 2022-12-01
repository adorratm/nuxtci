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
                vid="first_name"
                :name="$t('panel.users.firstName')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="first_name" class="mb-5">{{
                  $t("panel.users.firstName")
                }}</label>
                <input
                  id="first_name"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.firstName')"
                  type="text"
                  required
                  name="first_name"
                  v-model="formData.first_name"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="last_name"
                :name="$t('panel.users.lastName')"
                rules="required|min:2"
                v-slot="{ errors }"
              >
                <label for="last_name" class="mb-5">{{
                  $t("panel.users.lastName")
                }}</label>
                <input
                  id="last_name"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.lastName')"
                  type="text"
                  required
                  name="last_name"
                  v-model="formData.last_name"
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
                rules="required|min:2|email"
                v-slot="{ errors }"
              >
                <label for="email" class="mb-5">{{
                  $t("panel.users.email")
                }}</label>
                <input
                  id="email"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.email')"
                  type="email"
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
                vid="phone"
                :name="$t('panel.users.phone')"
                rules="required|min:11|max:20"
                v-slot="{ errors }"
              >
                <label for="phone" class="mb-5">{{
                  $t("panel.users.phone")
                }}</label>
                <input
                  id="phone"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.phone')"
                  type="tel"
                  required
                  name="phone"
                  v-model="formData.phone"
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
                vid="password"
                :name="$t('panel.users.password')"
                :rules="{ required: id ? false : true, min: 2 }"
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
                  name="password"
                  v-model="formData.password"
                />
                <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
              </ValidationProvider>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group my-1">
              <ValidationProvider
                vid="password_repeat"
                :name="$t('panel.users.passwordRepeat')"
                :rules="{ required: id ? false : true, min: 2 }"
                v-slot="{ errors }"
              >
                <label for="password_repeat" class="mb-5">{{
                  $t("panel.users.passwordRepeat")
                }}</label>
                <input
                  id="password_repeat"
                  class="form-control form-control-sm rounded-0"
                  :placeholder="$t('panel.users.passwordRepeat')"
                  type="password"
                  name="password_repeat"
                  v-model="formData.password_repeat"
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
                vid="role_id"
                :name="$t('panel.users.role')"
                rules="required"
                v-slot="{ errors }"
              >
                <label for="role_id" class="mb-5">{{
                  $t("panel.users.role")
                }}</label>
                <select
                  name="role_id"
                  id="role_id"
                  class="form-control form-control-sm rounded-0"
                  required
                  v-model="formData.role_id"
                  v-if="user_roles"
                >
                  <option
                    v-for="(item, index) in user_roles"
                    :key="index"
                    :value="item.id"
                    :selected="formData.role_id === item.id"
                  >
                    {{ item.title }}
                  </option>
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
      user_roles: [],
      formData: {
        first_name: null,
        last_name: null,
        email: null,
        phone: null,
        password: null,
        password_repeat: null,
        role_id: 3,
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
    async getRoles() {
      try {
        let { data } = await this.$axios.get("v1/panel/userroles/");
        if (data && data.user_roles) {
          this.user_roles = data.user_roles;
        }
      } catch (error) {
        console.log(error);
      }
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
          this.$router.replace("/panel/users/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async getUser(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/users/" + id);
        if (data && data.user) {
          this.formData = data.user;
          this.formData.password = null;
          this.formData.password_repeat = null;
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    if (this.id) {
      this.getUser(this.id);
    }
    this.getRoles();
  },
};
</script>