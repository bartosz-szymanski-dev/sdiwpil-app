<template>
  <v-stepper v-model="step">
    <v-stepper-items>
      <v-stepper-content step="1">
        <patient-appointment-form @change="handleFormChange" />
        <v-btn
          v-show="showSearchButton"
          block
          x-large
          @click="step = 2"
        >
          Szukaj
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <patient-appointment-results class="mb-4" />

        <v-btn
          color="primary"
          @click="step = 3"
        >
          Dalej
        </v-btn>

        <v-btn
          text
          @click="step = 2"
        >
          Wstecz
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <v-card
          class="mb-12"
          color="grey lighten-1"
          height="200px"
        />

        <v-btn
          text
          @click="step = 2"
        >
          Wstecz
        </v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script>
import PatientAppointmentForm from './PatientAppointmentForm';
import PatientAppointmentResults from './PatientAppointmentResults';

export default {
  name: 'PatientAppointmentStepper',
  components: { PatientAppointmentForm, PatientAppointmentResults },
  data: () => ({
    step: 1,
    showSearchButton: false,
  }),
  methods: {
    handleFormChange(search) {
      const { medicalSpecialty, city, name } = search;
      this.showSearchButton = !!(medicalSpecialty || city || name);
    },
  },
};
</script>

<style scoped>

</style>
