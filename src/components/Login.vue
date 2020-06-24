<template>
  <div class="login">
    <h1>{{ $t('login.welcome') }}</h1>
    <img src="img/logo.svg" alt="Bugs">
    <form action="" method="post" autocomplete="off">
      <input type="text" name="user-mail" v-bind:placeholder="$t('login.mail')">
      <input type="password" name="user-pass" v-bind:placeholder="$t('login.password')">
      <div class="remember">
        <label for="user-remember">{{ $t('login.remember') }}</label>
        <input type="checkbox" name="user-remember" id="user-remember">
      </div>
      <input type="button" v-bind:value="$t('login.submit')" class="btn">
    </form>
  </div>
</template>

<script>
export default {
  name: 'Login',
  components: {

  }
}
</script>
