<template>
  <div>
    <div class="background" />
    <v-row
      row
    >
      <v-col cols="12">
        <h1 class="text-h3 text-center">
          Witaj
        </h1>
      </v-col>
      <v-col cols="12">
        <v-btn
          text
          color="accent"
        >
          Zacznij korzystać z systemu
        </v-btn>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  name: 'MainScreen',
};
</script>

<style scoped lang="scss">
.background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  background: linear-gradient(180deg, rgba(0,206,200,1) 0%, rgba(53,166,230,1) 100%);
  z-index: -1;
}
</style>
