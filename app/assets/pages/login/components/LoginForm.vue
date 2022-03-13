<template>
  <v-card max-width="350px">
    <v-card-text>
      <v-form>
        <v-text-field
          v-model="username"
          label="Wpisz e-mail"
          type="email"
        />

        <v-text-field
          v-model="password"
          label="Wpisz hasło"
          type="password"
        />
      </v-form>
    </v-card-text>

    <v-card-actions>
      <v-btn
        color="primary"
        @click.prevent="login"
      >
        Zaloguj się
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
import axios from 'axios';

export default {
  name: 'LoginForm',
  data: () => ({
    username: '',
    password: '',
  }),
  methods: {
    handleSuccessfulLogin(response) {
      this.$snotify.success(response.message);
      window.location.href = response.route;
    },
    handleLoginError(error) {
      this.$snotify.error(error);
    },
    handleAxiosError(error) {
      this.$snotify.error('Przepraszamy. Coś poszło nie tak');
      console.error(`Login error: ${error}`);
    },
    async login() {
      const url = this.$fosGenerate('front.login.check');
      const { username, password } = this;
      try {
        const { data } = await axios.post(url, { username, password });
        if (data.success) {
          this.handleSuccessfulLogin(data);
        } else {
          this.handleLoginError(data.message);
        }
      } catch (e) {
        this.handleAxiosError(e);
      }
    },
  },
};
</script>

<style scoped>

</style>
