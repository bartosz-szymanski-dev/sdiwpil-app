<template>
  <v-stepper v-model="step">
    <v-stepper-items>
      <v-stepper-content step="1">
        <patient-appointment-form @change="handleFormChange" />

        <v-btn
          v-show="showSearchButton"
          block
          x-large
          @click="step += 1"
        >
          Szukaj
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <patient-appointment-results
          class="mb-4"
          @change="isDoctorChosen = true"
        />

        <v-row>
          <v-col cols="auto">
            <v-btn
              text
              @click="step -= 1"
            >
              Wstecz
            </v-btn>
          </v-col>

          <v-spacer />

          <v-col cols="auto">
            <v-btn
              color="primary"
              :disabled="!isDoctorChosen"
              @click="step += 1"
            >
              Dalej
            </v-btn>
          </v-col>
        </v-row>
      </v-stepper-content>

      <v-stepper-content step="3">
        <patient-appointment-rest-info-form />

        <v-btn
          text
          @click="step -= 1"
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
import PatientAppointmentRestInfoForm from './PatientAppointmentRestInfoForm';

export default {
  name: 'PatientAppointmentStepper',
  components: { PatientAppointmentForm, PatientAppointmentResults, PatientAppointmentRestInfoForm },
  data: () => ({
    step: 1,
    showSearchButton: false,
    isDoctorChosen: false,
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
