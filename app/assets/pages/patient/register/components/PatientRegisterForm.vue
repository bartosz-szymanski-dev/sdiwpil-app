<template>
  <v-card>
    <v-card-title>Zarejestruj się</v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field
          v-model="value.firstName"
          label="Imię"
          required
          :error-messages="getError($v.value.firstName)"
          @touch="$v.value.firstName.$touch()"
          @input="$v.value.firstName.$touch()"
        />
        <v-text-field
          v-model="value.secondName"
          label="Drugie imię"
          :error-messages="getError($v.value.secondName)"
          @touch="$v.value.secondName.$touch()"
          @input="$v.value.secondName.$touch()"
        />
        <v-text-field
          v-model="value.lastName"
          label="Nazwisko"
          required
          :error-messages="getError($v.value.lastName)"
          @touch="$v.value.lastName.$touch()"
          @input="$v.value.lastName.$touch()"
        />
        <v-text-field
          v-model="value.pesel"
          label="Numer PESEL"
          type="number"
          required
          :error-messages="getError($v.value.pesel)"
          @touch="$v.value.pesel.$touch()"
          @input="$v.value.pesel.$touch()"
        />
        <v-text-field
          v-model="value.email"
          label="Adres e-mail"
          type="email"
          required
          :error-messages="getError($v.value.email)"
          @touch="$v.value.email.$touch()"
          @input="$v.value.email.$touch()"
        />
        <v-text-field
          v-model="value.password"
          label="Hasło"
          type="password"
          required
          :error-messages="getError($v.value.password)"
          @touch="$v.value.password.$touch()"
          @input="$v.value.password.$touch()"
        />
        <v-text-field
          v-model="value.passwordRepeat"
          label="Powtórz hasło"
          type="password"
          required
          :error-messages="getError($v.value.passwordRepeat)"
          @touch="$v.value.passwordRepeat.$touch()"
          @input="$v.value.passwordRepeat.$touch()"
        />
        <v-checkbox
          v-model="value.agreeTerms"
          label="Zaakceptuj warunki"
        />
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-btn
        block
        color="secondary"
        @click.prevent="onSubmit"
      >
        Zarejestruj się
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import { validationMixin } from 'vuelidate';
import {
  maxLength, minLength, required, email, sameAs,
} from 'vuelidate/lib/validators';
import { has } from 'lodash';
import PatientModel from '../models/PatientModel';

export default {
  name: 'PatientRegisterForm',
  mixins: [validationMixin],
  data: () => ({
    value: new PatientModel(),
  }),
  validations() {
    return {
      value: {
        firstName: {
          required,
          minLength: minLength(3),
          maxLength: maxLength(50),
        },
        secondName: {
          minLength: minLength(3),
          maxLength: maxLength(50),
        },
        lastName: {
          required,
          minLength: minLength(3),
          maxLength: maxLength(75),
        },
        email: {
          required,
          email,
        },
        pesel: {
          required,
          minLength: minLength(11),
          maxLength: maxLength(11),
        },
        password: {
          required,
          minLength: minLength(6),
          maxLength: maxLength(255),
          sameAs: sameAs('passwordRepeat'),
        },
        passwordRepeat: {
          required,
          minLength: minLength(6),
          maxLength: maxLength(255),
          sameAs: sameAs('password'),
        },
      },
    };
  },
  methods: {
    getError(vField) {
      const errors = [];
      if (!vField || (vField && !vField.$dirty)) {
        return errors;
      }
      if (has(vField, 'required') && !vField.required) {
        errors.push('To pole jest wymagane');
      }
      if (has(vField, 'minLength') && !vField.minLength) {
        errors.push(`Minimalna ilość znaków to: ${vField.$params.minLength.min}`);
      }
      if (has(vField, 'maxLength') && !vField.maxLength) {
        errors.push(`Maksymalna ilość znaków to: ${vField.$params.maxLength.max}`);
      }
      if (has(vField, 'email') && !vField.email) {
        errors.push('Nieprawidłowy adres e-mail');
      }
      if (has(vField, 'sameAs') && !vField.sameAs) {
        errors.push('Wprowadzone hasła muszą być takie same');
      }

      return errors;
    },
    onSubmit() {
      this.$v.$touch();
      if (this.$v.$invalid) {
        this.$snotify.error('Formularz nie został poprawnie wypełniony');

        return;
      }

      window.location.href = this.$fosGenerate('front.patient.dashboard');
    },
  },
};
</script>

<style scoped>

</style>
