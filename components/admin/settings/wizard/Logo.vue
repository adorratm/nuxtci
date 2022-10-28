<template>
  <div class="row mb-3">
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="logo"
          :name="$t('panel.settings.logo')"
          rules="required|image"
          v-slot="{ validate, errors }"
        >
          <label for="logo" class="mb-5">{{ $t("panel.settings.logo") }}</label>
          <input
            id="logo"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.logo')"
            type="file"
            required
            name="logo"
            @change="validate"
            @input="$emit('update:logo', $event.target.files[0])"
          />
          <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="mobile_logo"
          :name="$t('panel.settings.mobile_logo')"
          rules="required|image"
          v-slot="{ validate, errors }"
        >
          <label for="mobile_logo" class="mb-5">{{
            $t("panel.settings.mobile_logo")
          }}</label>
          <input
            id="mobile_logo"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.mobile_logo')"
            type="file"
            required
            name="mobile_logo"
            @change="validate"
            @input="$emit('update:mobile_logo', $event.target.files[0])"
          />
          <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
        </ValidationProvider>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group my-3">
        <ValidationProvider
          vid="favicon"
          :name="$t('panel.settings.favicon')"
          rules="required|image"
          v-slot="{ validate, errors }"
        >
          <label for="favicon" class="mb-5">{{
            $t("panel.settings.favicon")
          }}</label>
          <input
            id="favicon"
            class="form-control form-control-sm rounded-0"
            :placeholder="$t('panel.settings.favicon')"
            type="file"
            required
            name="favicon"
            @change="validate"
            @input="$emit('update:favicon', $event.target.files[0])"
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
  props: ["logo", "mobile_logo", "favicon"],
};
</script>