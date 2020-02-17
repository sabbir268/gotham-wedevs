<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h3 class="card-title">Edit Post</h3>
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
            <button type="submit" class="btn btn-primary" @click.prevent="update">Update</button>
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
      id: "",
      title: "",
      body: ""
    };
  },
  methods: {
    update() {
      axios
        .patch(
          `/api/post/${this.id}`,
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
          if (res.data.msg == "updated") {
            alert("Post Updated");
            this.$router.push("/all-post");
          }
        })
        .catch(err => {
          console.log(res);
        });
    },

    getPost(id) {
      axios
        .get(`/api/post/${id}`)
        .then(res => {
          this.id = res.data.id;
          this.title = res.data.title;
          this.body = res.data.body;
        })
        .catch(err => {
          console.log(err);
        });
    }
  },

  created() {
    this.getPost(this.$route.params.id);
  }
};
</script>
