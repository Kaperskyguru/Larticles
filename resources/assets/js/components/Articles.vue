<template>
    <div>
        <h1>Articles</h1>
        <form @submit.prevent="addArticle" class="mb-3">
            <div class="form-group">
                <input class="form-control" placeholder="Title" type="text" v-model="article.title">
            </div>

             <div class="form-group">
                <textarea class="form-control" cols="30" rows="10" v-model="article.body"></textarea>
            </div>

            <button class="btn btn-light btn-block" type="submit">Save</button>

        </form>

        <div class="card card-body mb-2" v-for="article in articles" v-bind:key="article.id">
            <h3><router-link v-bind:to="'/blog/' + article.id">{{ article.title }}</router-link></h3>
            <p>{{ article.body }}</p>
            <hr>
            <button class="btn btn-info mb-2" @click="editArticle(article)">Edit</button>
            <button class="btn btn-danger mb-2" @click="deleteArticle(article.id)">Delete</button>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" v-bind:class="[{disabled: !pagination.previous_page_url}]"><a class="page-link" @click="fetchArticles(pagination.previous_page_url)" href="#">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{pagination.last_page}}</a></li>
                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]"><a class="page-link" href="#" @click="fetchArticles(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    data() {
        return {
            
            articles: [],
            article: {
                id: '',
                title: '',
                body: ''
            },
            article_id: '',
            pagination: {},
            edit: false,
            single: "single/",
        }
    },
    created() {
        this.fetchArticles();
    },
    methods: {
        fetchArticles: function (page_url) {
            let vm = this;
            page_url = page_url || '/api/articles'
           fetch(page_url)
           .then(res => res.json())
           .then(res => {
               this.articles = res.data;
               vm.makePagination(res.meta, res.links);
           })
           .catch(err => console.log(err));
        },
        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                previous_page_url: links.prev
            }
            this.pagination = pagination;
        },

        deleteArticle(id) {
            if(confirm('Are you sure?')) {
                fetch(`/api/article/${id}`, {
                    method: 'delete'
                    
                })
                .then(res => res.json())
                .then(data => {
                    alert('Article deleted');
                    this.fetchArticles(); 
                })
                .catch(err => console.log(err));
            }
        },
        addArticle( ) {
            if(this.edit === false){
                fetch('/api/article', {
                    method: 'post',
                    body: JSON.stringify(this.article),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.article.title = "";
                    this.article.body = "";
                    alert('Article Added');
                    this.fetchArticles();
                })
                .catch(err => console.log(err));
            } else {
                fetch('/api/article', {
                    method: 'put',
                    body: JSON.stringify(this.article),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    this.article.title = "";
                    this.article.body = "";
                    alert('Article Updated');
                    this.fetchArticles();
                })
                .catch(err => console.log(err));
            }
        },

        editArticle:  function(article) {
            this.edit = true;
            this.article.article_id = article.id;
            this.article.title = article.title;
            this.article.body = article.body
        }
    }
}
</script>
<style scoped>

</style>


