<template>
  <client-only>
    <div>
      <!-- Vertical Nav -->
      <nav class="hk-nav hk-nav-light">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"
          ><i class="fa fa-times-circle"></i></a>
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
                  ><i class="fa fa-tachometer-alt"></i> <span class="nav-link-text">Dashboard</span></a
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
                <a class="nav-link"><i class="fa fa-cogs"></i> <span class="nav-link-text">Ayarlar</span></a>
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
                  ><i class="fa fa-mail-bulk"></i> <span class="nav-link-text">E-Mail Ayarları</span></a
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
                  <span class="nav-link-text">Kullanıcı İşlemleri</span>
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
                        <a class="nav-link">Kullanıcı Yetkileri</a>
                      </nuxt-link>
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/users/"
                        custom
                      >
                        <a class="nav-link">Kullanıcılar</a>
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
                  data-target="#instagramnav"
                >
                  <i class="fa fa-instagram"></i>
                  <span class="nav-link-text">Instagram İşlemleri</span>
                </a>
                <ul
                  id="instagramnav"
                  class="nav flex-column collapse collapse-level-1"
                >
                  <li class="nav-item">
                    <ul class="nav flex-column">
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/members/"
                        custom
                      >
                        <a class="nav-link">Hesaplar</a>
                      </nuxt-link>
                      <nuxt-link
                        tag="li"
                        class="nav-item"
                        exact
                        exact-active-class="active"
                        to="/panel/posts/"
                        custom
                      >
                        <a class="nav-link">Postlar ve Storyler</a>
                      </nuxt-link>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
            <hr class="nav-separator" />
            <div class="nav-header">
              <span>SİTEYİ GÖRÜNTÜLEYİN</span>
              <span>SG</span>
            </div>
            <ul class="navbar-nav flex-column">
              <li class="nav-item">
                <nuxt-link class="nav-link" to="/">
                  <i class="fa fa-external-link"></i>
                  <span class="nav-link-text">Siteyi Görüntüle</span>
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