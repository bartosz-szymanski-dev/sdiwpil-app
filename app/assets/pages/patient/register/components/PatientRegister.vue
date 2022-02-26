<template>
  <v-app class="register--bg">
    <app-navbar ref="navbar" />

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      <app-background />

      <patient-register-screen />
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

export default {
  name: 'PatientRegister',
  components: {
    AppBackground, AppNavbar, AppFooter, PatientRegisterScreen,
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
