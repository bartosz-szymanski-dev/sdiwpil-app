<template>
  <v-app>
    <app-navbar />
    <v-card class="overflow-hidden">
      <v-sheet
        id="scrolling-techniques-7"
        class="overflow-y-auto"
        :max-height="windowHeight"
      >
        <v-container style="height: 1500px;" />
      </v-sheet>
    </v-card>
  </v-app>
</template>

<script>
import AppNavbar from '../../../shared/components/AppNavbar';

export default {
  name: 'HomePage',
  components: { AppNavbar },
  data: () => ({
    windowHeight: window.innerHeight,
  }),
};
</script>

<style scoped>

</style>
