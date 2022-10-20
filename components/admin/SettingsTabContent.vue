<template>
  <div class="tab-content" id="myTabContent">
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form @submit.prevent="handleSubmit(saveSettings)">
        <div
          class="tab-pane fade show active"
          id="tab-tab-0"
          role="tabpanel"
          aria-labelledby="tab-tab-0"
        >
          <div class="row mb-3">
            <div class="col-sm-6"></div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-1"
          role="tabpanel"
          aria-labelledby="tab-tab-1"
        >
          <div class="row mb-3">
            <div class="col-sm-6">adres</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-2"
          role="tabpanel"
          aria-labelledby="tab-tab-2"
        >
          <div class="row mb-3">
            <div class="col-sm-6">sosyal</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-3"
          role="tabpanel"
          aria-labelledby="tab-tab-3"
        >
          <div class="row mb-3">
            <div class="col-sm-6">logo</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-4"
          role="tabpanel"
          aria-labelledby="tab-tab-4"
        >
          <div class="row mb-3">
            <div class="col-sm-6">meta</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-5"
          role="tabpanel"
          aria-labelledby="tab-tab-5"
        >
          <div class="row mb-3">
            <div class="col-sm-6">analiz</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div
          class="tab-pane fade"
          id="tab-tab-6"
          role="tabpanel"
          aria-labelledby="tab-tab-6"
        >
          <div class="row mb-3">
            <div class="col-sm-6">live sup</div>
            <div class="col-sm-6"></div>
          </div>
        </div>
        <div class="form-group">
          <button
            class="btn btn-pink btn-block btn-sm rounded-0"
            type="submit"
            :disabled="invalid"
          >
            Kaydet
          </button>
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
  methods: {
    async saveSettings() {
      try {
        let response = await this.$axios.post("admin", {});
        this.$router.replace("/panel");
      } catch (error) {
        this.$refs.form.setErrors({
          email: [error.response.data.message],
          password: [error.response.data.message],
        });
      }
    },
  },
};
</script>