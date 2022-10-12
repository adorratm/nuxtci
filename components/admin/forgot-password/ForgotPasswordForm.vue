<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form @submit.prevent="handleSubmit(fortgotPassword)">
        <h1 class="display-4 mb-10">Şifrenizi mi unuttunuz ?</h1>
        <p class="mb-30">Bilgilerinizle Şifrenizi Sıfırlayın.</p>
        <div class="form-group">
          <ValidationProvider
            vid="email"
            name="E-Mail Adresiniz"
            rules="required|min:2|email"
            v-slot="{ errors }"
          >
            <label for="email" class="mb-5">E-Mail Adresiniz</label>
            <input
              id="email"
              class="form-control form-control-sm rounded-0"
              placeholder="Email Adresiniz"
              type="email"
              v-model="email"
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
        <button class="btn btn-pink btn-block btn-sm rounded-0" type="submit" :disabled="invalid">
          Şifremi Sıfırla
        </button>
        <p class="font-14 text-center mt-15">Şifrenizi Hatırladınız Mı?</p>
        <p class="text-center">
          <nuxt-link to="/panel/login">Giriş Yapın</nuxt-link>
        </p>
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
  data() {
    return {
      email: null,
    };
  },
  methods: {
    async login() {
      try {
        let response = await this.$axios.post();
        //this.$router.replace("/panel");
      } catch (error) {
        console.log(error);
        this.$refs.form.setErrors({
          email: [error.response.data.message],
        });
      }
    },
  },
};
</script>