<template>
  <v-footer
    padless
  >
    <v-card
      flat
      tile
      width="100%"
      color="accent"
      class="text-center"
    >
      <v-card-text class="white--text">
        {{ year }} - <strong>SDIWPIL</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  name: 'AppFooter',
  computed: {
    year() {
      return new Date().getFullYear();
    },
  },
};
</script>

<style scoped>

</style>
