<template>
  <div class="row mb-3">
    <div class="col-sm-12">
      <div class="form-group my-3">
        <ValidationProvider
          vid="meta_description"
          :name="$t('panel.settings.meta_description')"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="meta_description" class="mb-5">{{
            $t("panel.settings.meta_description")
          }}</label>
          <textarea
            id="meta_description"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.meta_description')"
            type="text"
            name="meta_description"
            :value="meta_description"
            rows="10"
            @input="$emit('update:meta_description', $event.target.value)"
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
  props: ["meta_description"],
};
</script>