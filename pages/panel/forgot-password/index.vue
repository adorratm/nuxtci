<template>
  <client-only>
    <div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-5 pa-0">
            <LoginCarousel />
          </div>
          <div class="col-xl-7 pa-0">
            <div class="auth-form-wrap py-xl-0 py-50">
              <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                <ForgotPasswordForm />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </client-only>
</template>

<script>
import LoginCarousel from "~/components/admin/login/LoginCarousel.vue";
import ForgotPasswordForm from "~/components/admin/forgot-password/ForgotPasswordForm.vue";
export default {
  layout: "adminLogin",
  components: {
    LoginCarousel,
    ForgotPasswordForm,
  },
  mounted(){
    this.$nextTick(() => {
      this.$nuxt.$loading.start()
      $(".preloader-it").delay(500).fadeOut("slow");
      setTimeout(() => {this.$nuxt.$loading.finish();$(".hk-wrapper").removeClass("d-none")}, 1000)
    })
  }
};
</script>