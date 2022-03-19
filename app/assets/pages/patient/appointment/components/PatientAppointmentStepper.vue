<template>
  <v-stepper v-model="step">
    <v-stepper-items>
      <v-stepper-content step="1">
        <patient-appointment-form @change="handleFormChange" />

        <v-btn
          v-show="showSearchButton"
          block
          x-large
          @click="findDoctor"
        >
          Szukaj
        </v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <patient-appointment-results
          class="mb-4"
          :doctors="doctors"
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
import axios from 'axios';
import PatientAppointmentForm from './PatientAppointmentForm';
import PatientAppointmentResults from './PatientAppointmentResults';
import PatientAppointmentRestInfoForm from './PatientAppointmentRestInfoForm';
import AppointmentSearchModel from '../models/AppointmentSearchModel';

export default {
  name: 'PatientAppointmentStepper',
  components: { PatientAppointmentForm, PatientAppointmentResults, PatientAppointmentRestInfoForm },
  data: () => ({
    step: 1,
    showSearchButton: false,
    isDoctorChosen: false,
    search: new AppointmentSearchModel(),
    doctors: [],
  }),
  methods: {
    handleFormChange(search) {
      const { medicalSpecialty, city, lastName } = search;
      this.showSearchButton = !!(medicalSpecialty || city || lastName);
      this.search = search;
    },
    handleResponseErrors(errors) {
      errors.forEach(({ message }) => this.$snotify.error(message));
    },
    handleAxiosError(error, action) {
      console.error(`${action} error: ${error}`);
      this.$snotify.error('Przepraszamy, coś poszło nie tak');
    },
    async findDoctor() {
      try {
        const { data } = await axios.post(this.$fosGenerate('front.patient.find_doctor'), { ...this.search });
        if (data.success) {
          this.doctors = data.doctors;
          this.step += 1;
        } else {
          this.handleResponseErrors(data.errors);
        }
      } catch (e) {
        this.handleAxiosError(e, 'Find doctor');
      }
    },
  },
};
</script>

<style scoped>

</style>
