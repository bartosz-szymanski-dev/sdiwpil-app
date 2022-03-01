<template>
  <v-row row>
    <v-col md="4">
      <h1 class="text-h4 dashboard-white mb-2">
        Witaj w panelu pacjenta
      </h1>

      <p class="dashboard-white">
        Skorzystaj z usług oferowanych przez konto w systemie. Poniżej znajdują się odnośniki do poszczególnych sekcji.
      </p>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PatientDashboardScreen',
};
</script>

<style scoped lang="scss">
.dashboard {
  &-white {
    color: #fff;
  }
}

::v-deep .col {
  position: relative;
}
</style>
