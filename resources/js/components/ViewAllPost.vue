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
                  <h4>{{post.title}}</h4>
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
        .get("/api/post")
        .then(res => {
          this.posts = res.data;
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
