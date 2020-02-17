<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h5 class="card-title">Sign Up</h5>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Full Name</label>
                <input
                  type="name"
                  v-model="fullname"
                  class="form-control"
                  placeholder="Enter Full Name"
                />
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" v-model="email" class="form-control" placeholder="Enter email" />
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input
                  type="password"
                  v-model="password"
                  class="form-control"
                  placeholder="Password"
                />
              </div>
              <button type="submit" class="btn btn-primary" @click.prevent="signup">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fullname: "",
      email: "",
      password: ""
    };
  },

  methods: {
    signup: function() {
      axios
        .post("api/register", {
          name: this.fullname,
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
