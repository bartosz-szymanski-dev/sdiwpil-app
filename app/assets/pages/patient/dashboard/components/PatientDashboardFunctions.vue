<template>
  <v-row>
    <v-col
      v-for="({name, url}, i) in functions"
      :key="i"
      cols="12"
    >
      <v-btn
        block
        x-large
        color="accent"
        :href="url"
      >
        {{ name }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
export default {
  name: 'PatientDashboardFunctions',
  data: () => ({
    functions: [
      {
        name: 'Skierowania',
        url: this.$fosGenerate('front.patient.referral'),
      },
      {
        name: 'Wizyty',
        url: '',
      },
      {
        name: 'Czat z lekarzem',
        url: '',
      },
      {
        name: 'Ustawienia',
        url: '',
      },
    ],
  }),
};
</script>

<style scoped>

</style>
