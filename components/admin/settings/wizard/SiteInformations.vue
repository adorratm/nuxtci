<template>
  <div class="row mb-3">
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="company_name"
          name="Şirket Adı"
          rules="required|min:2"
          v-slot="{ errors }"
        >
          <label for="company_name" class="mb-5">Şirket Adı</label>
          <input
            id="company_name"
            class="form-control form-control-sm rounded-0"
            placeholder="Şirket Adı"
            type="text"
            required
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
          name="Slogan"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="slogan" class="mb-5">Slogan</label>
          <input
            id="slogan"
            class="form-control form-control-sm rounded-0"
            placeholder="Slogan"
            type="text"
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