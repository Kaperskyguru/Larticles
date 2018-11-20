<template>
        <div class="card card-body mb-2">
            <h3>{{ article.title }}</h3>
            <article>{{ article.body }}</article>
            <hr>
            <br>
            
            <h3> Comments </h3>
            <form @submit.prevent="addComment(article.id)" action="#" method="post">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" v-model="comment.title" placeholder="Enter name">
                    <input class="form-control" type="hidden" v-bind:key="article.id" name="article_id">
                </div>
                    <br />
                <div class="form-group">
                    <textarea class="form-control" v-model="comment.body" name="body" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"  name="" id="">Comment</button>
                </div>
            </form>
 
            <div class="container">
                <div class="jumbotron" v-for="comment in comments" v-bind:key="comment.id">
                    <h3>{{ comment.title }}</h3>
                    <p>{{ comment.body }}</p>
                </div>
            </div>
        </div>
</template>

<script>
export default {

        data() {
        return {
            article_id: this.$route.params.id,
            comment:{
                article_id: this.article_id,
                title: '',
                body: '',
                id: ''
            },
            article: {},
            comments: {},
            
        }
    },
    created() {
        
        this.fetchArticle(this.article_id);
        this.fetchComments(this.article_id);
        
    },
    methods: {
        fetchArticle: function (id) {
            fetch(`/api/article/${id}`, {
                method: 'get',
            })
            .then((res) => res.json())
            .then(res1 => {
                this.article = res1.data
            })
                
        },
        fetchComments: function(id) {
             fetch(`/api/comments/${id}`, {
                    method: 'get'
                    
                })
                .then(res => res.json())
                .then(res => {
                    this.comments = res.data; 
                })
        },
        addComment: function(id) {
            this.comment.article_id = id
             fetch('/api/comment', {
                    method: 'post',
                    body: JSON.stringify(this.comment),
                    headers: {
                        'content-type': 'application/json'
                    }
                    
                })
                .then(res => res.text())
                .then(res => {
                    this.fetchComments(this.article_id)
                })
        }
    }
    
}
</script>

