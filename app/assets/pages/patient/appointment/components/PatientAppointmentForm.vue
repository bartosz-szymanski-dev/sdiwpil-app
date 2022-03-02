<template>
  <v-form>
    <v-select
      v-model="search.medicalSpecialty"
      :items="medicalSpecialties"
      label="Wybierz specjalizację"
      clearable
    />
    <v-select
      v-model="search.city"
      :items="cities"
      label="Wybierz miasto"
      clearable
    />
    <v-text-field
      v-model="search.name"
      label="Wpisz nazwisko"
      clearable
    />
  </v-form>
</template>

<script>
import AppointmentSearchModel from '../models/AppointmentSearchModel';

export default {
  name: 'PatientAppointmentForm',
  data: () => ({
    medicalSpecialties: ['Chirurg', 'Neurolog', 'Kardiolog', 'Psycholog', 'Stomatolog', 'Ortopeda', 'Dermatolog'],
    cities: ['Kraków', 'Warszawa', 'Poznań', 'Wrocław', 'Katowice', 'Gdańsk', 'Rzeszów'],
    search: new AppointmentSearchModel(),
  }),
  watch: {
    search: {
      deep: true,
      handler() {
        this.$emit('change', this.search);
      },
    },
  },
};
</script>

<style scoped>

</style>
