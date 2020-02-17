<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h3 class="card-title">Create New Post</h3>
          <hr />
          <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" v-model="email" class="form-control" placeholder="Enter email" />
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" v-model="password" class="form-control" placeholder="Password" />
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="login">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: ""
    };
  },

  methods: {
    login() {
      axios
        .post("/api/login", {
          email: this.email,
          password: this.password
        })
        .then(res => {
          if (res.data.message == "success") {
            let user = res.data.user;
            let token = res.data.access_token;

            localStorage.setItem("user", JSON.stringify(user));
            localStorage.setItem("token", token);

            this.$router.push("/all-post");
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
