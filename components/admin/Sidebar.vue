<template>
  <client-only>
    <div>
      <!-- Vertical Nav -->
      <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"
          ><i class="fa fa-times-circle"></i
        ></a>
        <div class="nicescroll-bar">
          <div class="navbar-nav-wrap">
            <ul class="navbar-nav flex-column">
              <nuxt-link
                tag="li"
                class="nav-item"
                to="/panel/"
                exact
                exact-active-class="active"
                custom
              >
                <a class="nav-link"
                  ><i class="fa fa-tachometer-alt"></i>
                  <span class="nav-link-text">{{
                    $t("panel.dashboard")
                  }}</span></a
                >
              </nuxt-link>
              <nuxt-link
                tag="li"
                class="nav-item"
                to="/panel/settings/"
                exact
                exact-active-class="active"
                custom
              >
                <a class="nav-link"
                  ><i class="fa fa-cogs"></i>
                  <span class="nav-link-text">{{
                    $t("panel.settings.settings")
                  }}</span></a
                >
              </nuxt-link>
              <nuxt-link
                tag="li"
                class="nav-item"
                to="/panel/email-settings/"
                exact
                exact-active-class="active"
                custom
              >
                <a class="nav-link"
                  ><i class="fa fa-mail-bulk"></i>
                  <span class="nav-link-text">{{
                    $t("panel.emailSettings.emailSettings")
                  }}</span></a
                >
              </nuxt-link>
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="javascript:void(0);"
                  data-toggle="collapse"
                  data-target="#usersnav"
                >
                  <i class="fa fa-users-gear"></i>
                  <span class="nav-link-text">{{
                    $t("panel.userActions")
                  }}</span>
                </a>
                <ul
                  id="usersnav"
                  class="nav flex-column collapse collapse-level-1"
                >
                  <li class="nav-item">
                    <ul class="nav flex-column">
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/user-roles/"
                        custom
                      >
                        <a class="nav-link">{{
                          $t("panel.userRoles.userRoles")
                        }}</a>
                      </nuxt-link>
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/users/"
                        custom
                      >
                        <a class="nav-link">{{ $t("panel.users.users") }}</a>
                      </nuxt-link>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a
                  class="nav-link"
                  href="javascript:void(0);"
                  data-toggle="collapse"
                  data-target="#productcategoriesnav"
                >
                  <i class="fa fa-dropbox"></i>
                  <span class="nav-link-text">{{
                    $t("panel.productActions")
                  }}</span>
                </a>
                <ul
                  id="productcategoriesnav"
                  class="nav flex-column collapse collapse-level-1"
                >
                  <li class="nav-item">
                    <ul class="nav flex-column">
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/product-categories/"
                        custom
                      >
                        <a class="nav-link">{{
                          $t("panel.productCategories.productCategories")
                        }}</a>
                      </nuxt-link>
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/products/"
                        custom
                      >
                        <a class="nav-link">{{
                          $t("panel.products.products")
                        }}</a>
                      </nuxt-link>
                    </ul>
                  </li>
                </ul>
              </li>
              <nuxt-link
                tag="li"
                class="nav-item"
                to="/panel/menus/"
                exact
                exact-active-class="active"
                custom
              >
                <a class="nav-link"
                  ><i class="fa fa-list"></i>
                  <span class="nav-link-text">{{
                    $t("panel.menus.menus")
                  }}</span></a
                >
              </nuxt-link>
            </ul>
            <hr class="nav-separator" />
            <div class="nav-header">
              <span>{{ $t("panel.viewOurSite") }}</span>
              <span>{{
                $t("panel.viewOurSite")
                  .split(" ")
                  .map(function (s) {
                    return s.charAt(0);
                  })
                  .join("")
              }}</span>
            </div>
            <ul class="navbar-nav flex-column">
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/">
                  <i class="fa fa-external-link"></i>
                  <span class="nav-link-text">{{ $t("panel.viewSite") }}</span>
                </nuxt-link>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
      <!-- /Vertical Nav -->
    </div>
  </client-only>
</template>