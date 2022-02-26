<template>
  <v-app>
    <app-navbar ref="navbar" />

    <v-container
      :style="{
        paddingTop: `${navbarHeight}px`,
        minHeight: `calc(100vh - ${footerHeight}px)`,
      }"
    >
      hello
    </v-container>

    <app-footer ref="footer" />
  </v-app>
</template>

<script>
import AppNavbar from '../../../../shared/components/AppNavbar';
import AppFooter from '../../../../shared/components/AppFooter';
import mainComponentHelper from '../../../../mixins/mainComponentHelper';

export default {
  name: 'PatientRegister',
  components: { AppNavbar, AppFooter },
  mixins: [mainComponentHelper],
};
</script>

<style scoped>

</style>
