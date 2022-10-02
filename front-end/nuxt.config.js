import colors from 'vuetify/es5/util/colors'

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    titleTemplate: '%s - Pomost w kontakcie pacjent-lekarz',
    title: 'SDIWPIL',
    htmlAttrs: {
      lang: 'pl-Pl'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    '~/assets/main.scss'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
  ],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
    // https://go.nuxtjs.dev/typescript
    '@nuxt/typescript-build',
    // https://go.nuxtjs.dev/vuetify
    '@nuxtjs/vuetify'
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
  ],

  // Vuetify module configuration: https://go.nuxtjs.dev/config-vuetify
  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    theme: {
      themes: {
        dark: {
          primary: '#A6033F',
          accent: '#056CF2',
          secondary: '#0540F2',
          info: '#05AFF2',
          warning: '#BF2604',
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        },
        light: {
          primary: '#A6033F',
          accent: '#056CF2',
          secondary: '#0540F2',
          info: '#05AFF2',
          warning: '#BF2604',
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        }
      }
    },
    treeShake: true
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  }
}
