<template>
  <div class="row mb-3">
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="company_name"
          :name="$t('panel.settings.company_name')"
          rules="required|min:2"
          v-slot="{ errors }"
        >
          <label for="company_name" class="mb-5">{{
            $t("panel.settings.company_name")
          }}</label>
          <input
            id="company_name"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.company_name')"
            type="text"
            required
            name="company_name"
            v-model="company_name"
          />
          <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="slogan"
          :name="$t('panel.settings.slogan')"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="slogan" class="mb-5">{{
            $t("panel.settings.slogan")
          }}</label>
          <input
            id="slogan"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.slogan')"
            type="text"
            name="slogan"
            v-model="slogan"
          />
          <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </div>
  </div>
</template>

<script>
import { ValidationProvider } from "vee-validate";
export default {
  components: {
    ValidationProvider,
  },
  data() {
    return {
      company_name: null,
      slogan: null,
    };
  },
};
</script>