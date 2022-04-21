<template>
  <v-row>
    <v-col
      v-for="({ route, name }, key) in menuItems"
      :key="key"
      cols="auto"
    >
      <v-btn
        text
        color="white"
        :href="$fosGenerate(route)"
      >
        {{ name }}
      </v-btn>
    </v-col>
  </v-row>
</template>

<script>
import { get } from 'lodash';

export default {
  name: 'MenuItems',
  computed: {
    menuItems() {
      return get(window, 'state.menu', []);
    },
  },
};
</script>

<style scoped>

</style>
