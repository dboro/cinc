<template>
  <v-card width="350">
    <v-card-title class="d-flex justify-center">
      {{ t('Authorization') }}
    </v-card-title>
    <v-form @submit.prevent="submit">
      <v-card-text>
        <c-text-field v-model="model.email" :error="errors.email" prepend-inner-icon="mdi-account" :placeholder="t('Username')"></c-text-field>
        <c-text-field v-model="model.password" :error="errors.password" type="password" prepend-inner-icon="mdi-lock" :placeholder="t('Password')"></c-text-field>
      </v-card-text>
      <v-card-actions class="pt-0">
        <v-spacer></v-spacer>
        <v-col class="pt-0">
          <v-btn type="submit" :loading="loading" block outlined small rounded depressed color="primary">{{ t('Sign in') }}</v-btn>
        </v-col>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>

import langs from "@/mixins/langs";

export default {
  mixins: [langs],
  layout: 'auth',
  name: "login",
  data() {
    return {
      loading: false,
      model: {}
    }
  },
  methods: {
    submit() {
      this.$store.dispatch('auth/login', this.model)
    },
  },
  computed: {
    errors() {
      return this.$store.state.auth.errors
    },
  },
  created() {
    this.$axios.$get('api/test')
  }
}
</script>

<style scoped>

</style>
