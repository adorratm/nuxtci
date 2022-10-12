<template>
  <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">
    <div
      class="fadeOut item auth-cover-img overlay-wrap"
      style="
        background-image: url(/vendor/img/background.webp);
        background-size: cover;
      "
    >
      <div class="auth-cover-info py-xl-0 pt-100 pb-50">
        <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
          <h1 class="display-3 text-white mb-20">
            Websitenizi Daha İyi Yönetin.
          </h1>
          <p class="text-white">
            Yönetim panelinize hoşgeldiniz. Websitenizin ihtiyacını
            karşılayabileceğiniz tüm özellikleri sunuyoruz...
          </p>
        </div>
      </div>
      <div class="bg-overlay bg-trans-dark-75"></div>
    </div>
    <div
      class="fadeOut item auth-cover-img overlay-wrap"
      style="
        background-image: url(/vendor/img/background.webp);
        background-size: cover;
      "
    >
      <div class="auth-cover-info py-xl-0 pt-100 pb-50">
        <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
          <h1 class="display-3 text-white mb-20">
            Websitenizi Daha İyi Yönetin.
          </h1>
          <p class="text-white">
            Yönetim panelinize hoşgeldiniz. Websitenizin ihtiyacını
            karşılayabileceğiniz tüm özellikleri sunuyoruz...
          </p>
        </div>
      </div>
      <div class="bg-overlay bg-trans-dark-75"></div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.$nextTick(() => {
      setTimeout(() => {
        let $owl = $("#owl_demo_1").owlCarousel({
          items: 1,
          autoplay: true,
          lazyLoad: true,
          rewind: true,
        });

        $owl.trigger("refresh.owl.carousel");
      }, 1000);
    });
  },
};
</script>