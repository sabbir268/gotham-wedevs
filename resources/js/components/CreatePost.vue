<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h3 class="card-title">Create New Post</h3>
          <hr />
          <form>
            <div class="form-group">
              <label>Title</label>
              <input
                type="email"
                v-model="title"
                class="form-control"
                placeholder="Enter post title"
              />
            </div>
            <div class="form-group">
              <label>Post</label>
              <textarea class="form-control" v-model="body" cols="30" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="publish">Publish</button>
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
      title: "",
      body: ""
    };
  },
  methods: {
    publish() {
      axios
        .post(
          "api/post",
          {
            title: this.title,
            body: this.body
          },
          {
            headers: {
              "Content-Type": "application/json",
              Authorization: "Bearer " + localStorage.getItem("token")
            }
          }
        )
        .then(res => {
          if (res.data.msg == "created") {
            alert("Post Published");
            this.$router.push("/all-post");
          }
        })
        .catch(err => {
          console.log(res);
        });
    }
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
