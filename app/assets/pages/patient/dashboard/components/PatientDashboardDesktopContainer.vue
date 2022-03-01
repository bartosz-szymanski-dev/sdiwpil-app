<template>
  <div>
    <v-container fluid>
      <app-background />
    </v-container>

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <patient-dashboard-screen />

      <patient-dashboard-functions />
    </v-container>
  </div>
</template>

<script>
import AppBackground from '../../../../shared/components/AppBackground';
import PatientDashboardScreen from './PatientDashboardScreen';
import PatientDashboardFunctions from './PatientDashboardFunctions';

export default {
  name: 'PatientDashboardDesktopContainer',
  components: { PatientDashboardFunctions, PatientDashboardScreen, AppBackground },
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

<style scoped lang="scss">
::v-deep {
  .background {
    z-index: 0;
  }
}
</style>
