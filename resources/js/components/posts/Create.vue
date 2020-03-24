<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card-header">
                    Add Post
                </div>
                <div class="card-body">
                    <form @submit.prevent="PostStore">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" v-model="post.title" placeholder="Input Title">
                            <div v-if="validation.title">
                                <div class="alert alert-danger mt-1" role="alert">
                                    {{ validation.title[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Content</label>
                            <input type="text" class="form-control" v-model="post.content" rows="5" placeholder="Input Content">
                            <div v-if="validation.content">
                                <div class="alert alert-danger mt-1" role="alert">
                                    {{ validation.content[0] }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-success">Save</button>
                            <button type="reset" class="btn btn-md btn-danger">Reset</button>
                        </div>
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
                post: {},
                validation: []
            }
        },
        methods: {
            PostStore() {
                let uri = 'http://localhost:8000/api/posts/store';
                this.axios.post(uri, this.post)
                    .then((response) => {
                        this.$router.push({
                            name: 'posts'
                        });
                    }).catch(error => {
                        this.validation = error.response.data.data;
                });
            }
        }
    }
</script>
