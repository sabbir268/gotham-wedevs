<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="card col-md-8 offset-md-2">
        <div class="card-body">
          <h3 class="card-title">All post</h3>
          <hr />
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12" v-for="post in posts " :key="post.id">
                  <div class="row">
                    <div class="col-md-8">
                      <h4>{{post.title}}</h4>
                    </div>
                    <div
                      :class="`col-md-4 ${checkOwnership(post.user_id) == true ? 'd-block' : 'd-none'}`"
                    >
                      <router-link class="btn btn-sm btn-primary" :to="`/edit-post/${post.id}`">Edit</router-link>
                      <button class="btn btn-sm btn-danger" @click="deletePost(post.id)">Delete</button>
                    </div>
                  </div>
                  <p>{{post.body}}</p>
                </div>
                <hr />
              </div>
            </div>
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
      posts: []
    };
  },
  methods: {
    async getPosts() {
      axios
        .get(`/api/post`)
        .then(res => {
          this.posts = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    checkOwnership(user_id) {
      let user = JSON.parse(localStorage.getItem("user"));
      return user_id == user.id ? true : false;
    },

    deletePost(id) {
      axios
        .delete(`/api/post/${id}`, {
          headers: {
            "Content-Type": "application/json",
            Authorization: "Bearer " + localStorage.getItem("token")
          }
        })
        .then(res => {
          if (res.data.msg == "deleted") {
            let arr = this.posts;
            let post = this.posts.find(arr => arr.id == id);
            this.posts.splice(this.posts.indexOf(post), 1);
          }
        })
        .catch(err => {
          console.log(err);
        });
    }
  },

  created() {
    this.getPosts();
  },

  mounted() {
    console.log("Component mounted.");
  }
};
</script>
