<template>
  <div class="row mb-3">
    <div class="col-sm-12">
      <div class="form-group my-3">
        <ValidationProvider
          vid="live_support"
          :name="$t('panel.settings.live_support')"
          rules="min:2"
          v-slot="{ errors }"
        >
          <label for="live_support" class="mb-5">{{
            $t("panel.settings.live_support")
          }}</label>
          <textarea
            id="live_support"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.live_support')"
            type="text"
            name="live_support"
            :value="live_support"
            rows="10"
            @input="$emit('update:live_support', $event.target.value)"
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
  props: ["live_support"],
};
</script>