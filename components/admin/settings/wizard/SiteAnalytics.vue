<template>
  <div class="row mb-3">
    <div class="col-sm-12">
      <div class="form-group my-3">
        <ValidationProvider
          vid="metrica"
          :name="$t('panel.settings.metrica')"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="metrica" class="mb-5">{{
            $t("panel.settings.metrica")
          }}</label>
          <textarea
            id="metrica"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.metrica')"
            type="text"
            name="metrica"
            :value="metrica"
            rows="10"
            @input="$emit('update:metrica', $event.target.value)"
          />
          <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group my-3">
        <ValidationProvider
          vid="analytics"
          :name="$t('panel.settings.analytics')"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="analytics" class="mb-5">{{
            $t("panel.settings.analytics")
          }}</label>
          <textarea
            id="analytics"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.analytics')"
            type="text"
            name="analytics"
            :value="analytics"
            rows="10"
            @input="$emit('update:analytics', $event.target.value)"
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
  props: ["metrica", "analytics"],
};
</script>