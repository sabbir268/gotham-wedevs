<template>
  <div class="container m-auto">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Gotham</a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <router-link class="nav-link" to="/create-post">Create New Post</router-link>
          <li class="nav-item">
            <router-link class="nav-link" to="/all-post">All Post</router-link>
          </li>
        </ul>

        <div class="navbar-text float-right">
          <ul class="navbar-nav">
            <li :class="`nav-item ${authCheck() == false ? 'd-block' : 'd-none'}` ">
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>
            <li :class="`nav-item ${authCheck() == false ? 'd-block' : 'd-none'}`">
              <router-link class="nav-link" to="/sign-up">Sign Up</router-link>
            </li>

            <li :class="`nav-item ${authCheck() == false ? 'd-none' : 'd-block'}`">
              <button class="btn btn-link" @click.prevent="logOut">Log Out</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="col-md-12">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {
    authCheck() {
      return localStorage.token ? true : false;
    },
    logOut() {
      localStorage.clear();
      this.$router.push("/login");
    }
  },

  mounted() {
    this.authCheck();
  }
};
</script>

<style>
</style>