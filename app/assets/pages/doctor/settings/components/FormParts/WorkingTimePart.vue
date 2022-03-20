<template>
  <v-row>
    <v-col>
      <strong>Poniedziałek:</strong>
      <v-text-field
        v-model="workingTime.monday.start"
        label="Czas rozpoczęcia pracy"
      />
      <v-text-field
        v-model="workingTime.monday.end"
        label="Czas zakończenia pracy"
      />
    </v-col>
    <v-col>
      <strong>Wtorek:</strong>
      <v-text-field
        v-model="workingTime.tuesday.start"
        label="Czas rozpoczęcia pracy"
      />
      <v-text-field
        v-model="workingTime.tuesday.end"
        label="Czas zakończenia pracy"
      />
    </v-col>
    <v-col>
      <strong>Środa:</strong>
      <v-text-field
        v-model="workingTime.wednesday.start"
        label="Czas rozpoczęcia pracy"
      />
      <v-text-field
        v-model="workingTime.wednesday.end"
        label="Czas zakończenia pracy"
      />
    </v-col>
    <v-col>
      <strong>Czwartek:</strong>
      <v-text-field
        v-model="workingTime.thursday.start"
        label="Czas rozpoczęcia pracy"
      />
      <v-text-field
        v-model="workingTime.thursday.end"
        label="Czas zakończenia pracy"
      />
    </v-col>
    <v-col>
      <strong>Piątek:</strong>
      <v-text-field
        v-model="workingTime.friday.start"
        label="Czas rozpoczęcia pracy"
      />
      <v-text-field
        v-model="workingTime.friday.end"
        label="Czas zakończenia pracy"
      />
    </v-col>
    <v-col>
      <strong>Urlop:</strong>
      <v-text-field
        v-model="workingTime.vacation.start"
        label="Czas rozpoczęcia urlopu"
      />
      <v-text-field
        v-model="workingTime.vacation.end"
        label="Czas zakończenia urlopu"
      />
    </v-col>
  </v-row>
</template>

<script>
import { validationMixin } from 'vuelidate';
import vuelidateErrors from '../../../../../mixins/vuelidateErrors';

export default {
  name: 'WorkingTimePart',
  mixins: [validationMixin, vuelidateErrors],
  data: () => ({
    workingTime: {
      monday: {
        start: '',
        end: '',
      },
      tuesday: {
        start: '',
        end: '',
      },
      wednesday: {
        start: '',
        end: '',
      },
      thursday: {
        start: '',
        end: '',
      },
      friday: {
        start: '',
        end: '',
      },
      vacation: {
        start: '',
        end: '',
      },
    },
  }),
  validation() {
    // TODO: finish validation for working time
    return {
      workingTime: {

      },
    };
  },
};
</script>

<style scoped>

</style>
