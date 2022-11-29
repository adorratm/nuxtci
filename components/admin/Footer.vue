<template>
  <client-only>
    <div>
      <!-- Footer -->
      <div class="hk-footer-wrap container">
        <footer class="footer">
          <div class="row text-center">
            <div class="col-md-6 col-sm-12 text-center">
              <p
                class="
                  d-flex
                  align-items-center align-self-center align-content-center
                  justify-content-center
                "
              >
                © 2023
                <a
                  href="https://mutfakyapim.com/"
                  rel="nofollow"
                  :title="$t('panel.mutfakYapim')"
                  class="text-dark d-inline-flex"
                  target="_blank"
                  ><img
                    src="https://mutfakyapim.com/images/mutfak/logo.png?v=1"
                    style="filter: drop-shadow(1px 1px 1px black)"
                    height="40"
                    class="lazyload mr-3"
                /></a>
              </p>
            </div>
            <div class="col-md-6 col-sm-12 text-center">
              <p class="d-inline-block">{{ $t("panel.followUs") }}</p>
              <a
                href="https://www.facebook.com/mutfakyapim/"
                class="
                  d-inline-block
                  btn btn-icon btn-icon-only btn-indigo btn-icon-style-4
                "
                rel="nofollow"
                title="Facebook"
                ><span class="btn-icon-wrap"
                  ><i class="fa fa-facebook"></i></span
              ></a>
              <a
                href="https://www.instagram.com/mutfak.yapim"
                class="
                  d-inline-block
                  btn btn-icon btn-icon-only btn-indigo btn-icon-style-4
                "
                target="_blank"
                rel="nofollow"
                title="Instagram"
                ><span class="btn-icon-wrap"
                  ><i class="fa fa-instagram"></i></span
              ></a>
              <a
                href="https://www.linkedin.com/company/mutfakyapim"
                class="
                  d-inline-block
                  btn btn-icon btn-icon-only btn-indigo btn-icon-style-4
                "
                rel="nofollow"
                title="Linkedin"
                ><span class="btn-icon-wrap"
                  ><i class="fa fa-linkedin"></i></span
              ></a>
              <a
                href="https://www.youtube.com/channel/UCsvvxiSRXbYPIXxHUuPe3vA"
                class="
                  d-inline-block
                  btn btn-icon btn-icon-only btn-indigo btn-icon-style-4
                "
                rel="nofollow"
                title="Youtube"
                ><span class="btn-icon-wrap"><i class="fa fa-youtube"></i></span
              ></a>
            </div>
          </div>
        </footer>
      </div>
      <!-- /Footer -->
    </div>
  </client-only>
</template>