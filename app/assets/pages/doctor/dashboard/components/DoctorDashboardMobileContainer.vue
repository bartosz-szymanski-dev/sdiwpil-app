<template>
  <v-container
    :style="{
      paddingTop: `${navbarHeight}px`,
      minHeight: `calc(100vh - ${footerHeight}px)`,
    }"
  >
    <app-background color-schema="doctor" />

    <route-screen
      header="Witaj w panelu lekarza"
      text="Skorzystaj z usług oferowanych przez konto lekarza poprzez kliknięcie w wybrany odnośnik."
    />

    <dashboard-functions :functions="functions" />
  </v-container>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import RouteScreen from '../../../../shared/components/RouteScreen';
import DashboardFunctions from '../../../../shared/components/DashboardFunctions';

export default {
  name: 'DoctorDashboardMobileContainer',
  components: { DashboardFunctions, RouteScreen, AppBackground },
  props: {
    navbarHeight: {
      type: Number,
      required: true,
    },
    footerHeight: {
      type: Number,
      required: true,
    },
  },
  computed: {
    functions() {
      return [];
    },
  },
};
</script>

<style scoped>
.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}
</style>
