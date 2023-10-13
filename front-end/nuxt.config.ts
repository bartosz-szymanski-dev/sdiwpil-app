// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  typescript: {
    strict: true
  },
  css: [
    '~/assets/css/main.css'
  ],
  buildModules: [
    '@nuxtjs/style-resources'
  ],
    styleResources: {
    scss: [
        '~/assets/scss/variables.scss',
        '~/assets/scss/mixins.scss',
    },
})
