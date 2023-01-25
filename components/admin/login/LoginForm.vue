<template>
  <div>
    <ValidationObserver ref="form" v-slot="{ handleSubmit, invalid }">
      <form @submit.prevent="handleSubmit(login)">
        <h1 class="display-4 mb-10">Tekrar Hoşgeldiniz :)</h1>
        <p class="mb-30">Bilgilerinizle Panele Giriş Yapın.</p>
        <div class="form-group mb-3">
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
              placeholder="E-Mail Adresiniz"
              type="email"
              v-model="loginData.email"
              required
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
        <div class="form-group mb-3">
          <ValidationProvider
            vid="password"
            name="Şifreniz"
            rules="required|min:6"
            v-slot="{ errors }"
          >
            <label for="password" class="mb-5">Şifreniz</label>
            <input
              id="password"
              class="form-control form-control-sm rounded-0"
              placeholder="Şifreniz"
              type="password"
              v-model="loginData.password"
              required
            />
            <span class="mt-5 d-block text-danger">{{ errors[0] }}</span>
          </ValidationProvider>
        </div>
        <button
          class="btn btn-pink btn-block btn-sm rounded-0"
          type="submit"
          :disabled="invalid"
        >
          Giriş Yap
        </button>

        <p class="font-14 text-center mt-15">
          Oturum Açarken Problem Mi Yaşıyorsunuz?
        </p>
        <p class="text-center">
          <nuxt-link to="/panel/forgot-password">Şifremi Unuttum</nuxt-link>
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
      loginData: {
        email: null,
        password: null,
      },
    };
  },
  methods: {
    async login() {
      try {
        let { data } = await this.$auth.loginWith("admin", {
          data: this.loginData,
        });
        this.$router.replace("/panel").then(() => {
          this.$toast.success(
            data.message +
              " " +
              data.user.first_name +
              " " +
              data.user.last_name,
            this.$t("successfully")
          );
        });
      } catch (error) {
        console.log(error);
        if (error.response) {
          this.$refs.form.setErrors({
            email: [error.response.data.message],
            password: [error.response.data.message],
          });
        }
      }
    },
  },
};
</script>