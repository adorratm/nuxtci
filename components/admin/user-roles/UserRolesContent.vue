<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form
        @submit.prevent="handleSubmit(saveUserRole)"
        enctype="multipart/form-data"
        method="POST"
        ref="formv"
      >
        <div class="row no-gutters mb-1">
          <div class="col-sm-4">
            <div class="form-group">
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
        <div v-if="controllers">
          <div class="row no-gutters mb-1">
            <div class="col-sm-4 text-center">
              <div class="form-group border font-weight-bold p-3">
                {{ $t("panel.userRoles.module") }}
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border font-weight-bold p-3">
                {{ $t("panel.userRoles.read") }}
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border font-weight-bold p-3">
                {{ $t("panel.userRoles.write") }}
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border font-weight-bold p-3">
                {{ $t("panel.userRoles.update") }}
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border font-weight-bold p-3">
                {{ $t("panel.userRoles.delete") }}
              </div>
            </div>
          </div>
          <div
            class="row mb-1 no-gutters"
            v-for="(item, index) in controllers"
            :key="index"
          >
            <div class="col-sm-4 text-center">
              <div class="form-group border font-weight-500 p-3">
                {{ item }}
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border p-3">
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :id="'customSwitch' + index + 'read'"
                    :name="'permissions[' + item + '][read]'"
                    :checked="
                      id &&
                      formData.permissions &&
                      formData.permissions[item].read
                        ? true
                        : false
                    "
                    v-model="formData.permissions[item].read"
                  />
                  <label
                    class="custom-control-label"
                    :for="'customSwitch' + index + 'read'"
                  ></label>
                </div>
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border p-3">
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :id="'customSwitch' + index + 'write'"
                    :name="'permissions[' + item + '][write]'"
                    :checked="
                      id &&
                      formData.permissions &&
                      formData.permissions[item].write
                        ? true
                        : false
                    "
                    v-model="formData.permissions[item].write"
                  />
                  <label
                    class="custom-control-label"
                    :for="'customSwitch' + index + 'write'"
                  ></label>
                </div>
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border p-3">
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :id="'customSwitch' + index + 'update'"
                    :name="'permissions[' + item + '][update]'"
                    :checked="
                      id &&
                      formData.permissions &&
                      formData.permissions[item].update
                        ? true
                        : false
                    "
                    v-model="formData.permissions[item].update"
                  />
                  <label
                    class="custom-control-label"
                    :for="'customSwitch' + index + 'update'"
                  ></label>
                </div>
              </div>
            </div>
            <div class="col-sm-2 text-center">
              <div class="form-group border p-3">
                <div class="custom-control custom-switch">
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    :id="'customSwitch' + index + 'delete'"
                    :name="'permissions[' + item + '][delete]'"
                    :checked="
                      id &&
                      formData.permissions &&
                      formData.permissions[item].delete
                        ? true
                        : false
                    "
                    v-model="formData.permissions[item].delete"
                  />
                  <label
                    class="custom-control-label"
                    :for="'customSwitch' + index + 'delete'"
                  ></label>
                </div>
              </div>
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
        permissions: [],
      },
      controllers: [],
    };
  },
  methods: {
    async saveUserRole() {
      try {
        const formData = new FormData(this.$refs.formv);
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
        console.log(error);
      }
    },
    async getRole(id) {
      try {
        let { data } = await this.$axios.get("v1/panel/userroles/" + id);
        if (data) {
          this.controllers = data.controllers;
          if (this.id) {
            this.formData = data.user_roles;
            this.formData.permissions = JSON.parse(this.formData.permissions);
          }
          if(this.formData.permissions === null){
            this.formData.permissions = [];
          }
          if (this.formData.permissions.length <= 0) {
            this.controllers.forEach((item, index) => {
              this.formData.permissions[item] = {
                read: null,
                write: null,
                update: null,
                delete: null,
              };
            });
          }
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.getRole(this.id ? this.id : "");
  },
};
</script>