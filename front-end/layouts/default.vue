<template>
  <v-app>
    <app-header :title="title" :items="items" />

    <v-main>
      <v-container class="pt-6">
        <Nuxt />
      </v-container>
    </v-main>

    <v-footer
      app
    >
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script lang="ts">
export default {
  name: 'DefaultLayout',
  data: () => ({
    items: [
      {
        icon: 'mdi-apps',
        title: 'Strona główna',
        to: '/'
      },
      {
        icon: 'mdi-chart-bubble',
        title: 'Lekarze',
        to: '/inspire'
      }
    ],
    title: 'System do internetowego wspomagania pacjenta i lekarza'
  })
}
</script>
