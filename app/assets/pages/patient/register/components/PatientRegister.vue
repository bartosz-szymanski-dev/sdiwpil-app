<template>
  <v-app class="register--bg">
    <vue-snotify />

    <app-navbar ref="navbar" />

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <app-background />

      <patient-register-screen />

      <patient-register-form />
    </v-container>

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../../shared/components/AppNavbar';
import AppFooter from '../../../../shared/components/AppFooter';
import mainComponentHelper from '../../../../mixins/mainComponentHelper';
import AppBackground from '../../../../shared/components/AppBackground';
import PatientRegisterScreen from './PatientRegisterScreen';
import PatientRegisterForm from './PatientRegisterForm';

export default {
  name: 'PatientRegister',
  components: {
    PatientRegisterForm,
    AppBackground,
    AppNavbar,
    AppFooter,
    PatientRegisterScreen,
  },
  mixins: [mainComponentHelper],
};
</script>

<style scoped lang="scss">
@import 'assets/styles/colors';

.container {
  position: relative;
  z-index: 2;
  overflow-x: hidden;
}

.register {
  &--bg {
    background-color: rgba($primary, 0.2);
  }
}
</style>
