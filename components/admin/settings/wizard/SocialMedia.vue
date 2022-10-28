<template>
  <div>
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="email"
            :name="$t('panel.settings.email')"
            rules="required|min:2|email"
            v-slot="{ errors }"
          >
            <label for="email" class="mb-5">{{
              $t("panel.settings.email")
            }}</label>
            <input
              id="email"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.email')"
              type="text"
              required
              :value="email"
              @input="$emit('update:email', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="facebook"
            :name="$t('panel.settings.facebook')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="facebook" class="mb-5">{{
              $t("panel.settings.facebook")
            }}</label>
            <input
              id="facebook"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.facebook')"
              type="text"
              :value="facebook"
              @input="$emit('update:facebook', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="instagram"
            :name="$t('panel.settings.instagram')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="instagram" class="mb-5">{{
              $t("panel.settings.instagram")
            }}</label>
            <input
              id="instagram"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.instagram')"
              type="text"
              :value="instagram"
              @input="$emit('update:instagram', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="twitter"
            :name="$t('panel.settings.twitter')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="twitter" class="mb-5">{{
              $t("panel.settings.twitter")
            }}</label>
            <input
              id="twitter"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.twitter')"
              type="text"
              :value="twitter"
              @input="$emit('update:twitter', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="linkedin"
            :name="$t('panel.settings.linkedin')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="linkedin" class="mb-5">{{
              $t("panel.settings.linkedin")
            }}</label>
            <input
              id="linkedin"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.linkedin')"
              type="text"
              :value="linkedin"
              @input="$emit('update:linkedin', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="youtube"
            :name="$t('panel.settings.youtube')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="youtube" class="mb-5">{{
              $t("panel.settings.youtube")
            }}</label>
            <input
              id="youtube"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.youtube')"
              type="text"
              :value="youtube"
              @input="$emit('update:youtube', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="medium"
            :name="$t('panel.settings.medium')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="medium" class="mb-5">{{
              $t("panel.settings.medium")
            }}</label>
            <input
              id="medium"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.medium')"
              type="text"
              :value="medium"
              @input="$emit('update:medium', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="pinterest"
            :name="$t('panel.settings.pinterest')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="pinterest" class="mb-5">{{
              $t("panel.settings.pinterest")
            }}</label>
            <input
              id="pinterest"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.pinterest')"
              type="text"
              :value="pinterest"
              @input="$emit('update:pinterest', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="appstore"
            :name="$t('panel.settings.appstore')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="appstore" class="mb-5">{{
              $t("panel.settings.appstore")
            }}</label>
            <input
              id="appstore"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.appstore')"
              type="text"
              :value="appstore"
              @input="$emit('update:appstore', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group my-3">
          <ValidationProvider
            vid="playstore"
            :name="$t('panel.settings.playstore')"
            rules="min:2"
            v-slot="{ errors }"
          >
            <label for="playstore" class="mb-5">{{
              $t("panel.settings.playstore")
            }}</label>
            <input
              id="playstore"
              class="form-control form-control-sm rounded-0"
              :placeholder="$t('panel.settings.playstore')"
              type="text"
              :value="playstore"
              @input="$emit('update:playstore', $event.target.value)"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
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
  props: [
    "email",
    "facebook",
    "instagram",
    "twitter",
    "youtube",
    "linkedin",
    "medium",
    "pinterest",
    "appstore",
    "playstore",
  ],
};
</script>