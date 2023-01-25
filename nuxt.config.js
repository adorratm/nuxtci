export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    htmlAttrs: {
      lang: 'tr'
    },
    title: 'Excellence Halı',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: 'Mutfak Yapım Dijital Reklam Ajansı Yönetim Platformu' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  server: {
    port: 3000, // default: 3000
    host: 'localhost', // default: localhost,
    timing: false
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    { src: "~/plugins/axios" },
    { src: "~/plugins/vee-validate" },
    { src: '~/plugins/vue-good-table', ssr: false },
    { src: '~/plugins/vue-izitoast', ssr: false },
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    '@nuxtjs/axios',
    // https://go.nuxtjs.dev/pwa
    '@nuxtjs/pwa',
    '@nuxtjs/auth-next',
    '@nuxtjs/i18n',
    'vue-sweetalert2/nuxt',
    '@nuxtjs/sitemap'
  ],

  i18n: {
    baseURL: '/',
    locales: [
      {
        name: 'Turkish',
        code: 'tr',
        iso: 'tr-TR',
        file: 'tr.js'
      },
      {
        name: 'English',
        code: 'en',
        iso: 'en-US',
        file: 'en.js'
      },
    ],
    langDir: 'locales/',
    defaultLocale: 'tr',
    lazy: true,
  },

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {
    // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
    baseURL: process.env.API_URL,
  },

  // PWA module configuration: https://go.nuxtjs.dev/pwa
  pwa: {
    manifest: {
      lang: 'tr'
    }
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    // Add exception
    transpile: [
      "vee-validate/dist/rules"
    ],
    /*
      ** You can extend webpack config here
      */
    extend(config, ctx) {
      // ...
    }
  },

  loading: '~/components/admin/LoadingBar.vue',

  publicRuntimeConfig: {
    API_URL: process.env.API_URL
  },

  auth: {
    redirect: false,
    strategies: {
      admin: {
        //scheme: "refresh",
        scheme: 'local',
        token: {
          property: "user.token",
          global: true,
          required: true,
          type: "Bearer",
          maxAge: 7200
        },
        user: {
          property: "user",
          autoFetch: true
        },
        /*refreshToken:{
          property: "refresh_token",
          data: "refresh_token"
        },*/
        endpoints: {
          login: {
            url: "/v1/panel/login", method: "post",
            propertyName: "user.token"
          },
          /*refresh: {
            url: "/v1/panel/refresh-token", method: "post"
          },*/
          logout: false,
          user: {
            url: "/v1/panel/current-user", method: "get",
            propertyName: "user"
          }
        },
        autoLogout: true
      },
      user: {
        //scheme: "refresh",
        scheme: 'local',
        token: {
          property: "user.token",
          global: true,
          required: true,
          type: "Bearer"
        },
        user: {
          property: "user",
          autoFetch: true
        },
        /*refreshToken:{
          property: "refresh_token",
          data: "refresh_token"
        },*/
        endpoints: {
          login: {
            url: "/v1/login", method: "post",
            propertyName: "user.token"
          },
          /*refresh: {
            url: "/v1/refresh-token", method: "post"
          },*/
          logout: false,
          user: {
            url: "/v1/current-user", method: "get",
            propertyName: "user"
          }
        },
        autoLogout: true
      },
    }
  }
}
