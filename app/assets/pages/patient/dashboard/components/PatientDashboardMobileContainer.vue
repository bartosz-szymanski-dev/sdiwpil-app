<template>
  <v-container
    :style="{
      paddingTop: `${navbarHeight}px`,
      minHeight: `calc(100vh - ${footerHeight}px)`,
    }"
  >
    <app-background />

    <patient-dashboard-screen />

    <patient-dashboard-functions />
  </v-container>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import PatientDashboardScreen from './PatientDashboardScreen';
import PatientDashboardFunctions from './PatientDashboardFunctions';

export default {
  name: 'PatientDashboardMobileContainer',
  components: { AppBackground, PatientDashboardScreen, PatientDashboardFunctions },
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
};
</script>

<style scoped>
.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}
</style>
