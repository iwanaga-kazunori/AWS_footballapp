<template>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    
                    <div class="card-body">
                        I'm an example component.
                    </div>
                    
                    <h1>ユーザ一覧</h1>
                    <div v-for="(news, index) in news" :key=news.id>
                      {{ news.news_id }}
                      {{ news.title }}
                    
                    </div>
                    <button v-on:click="show" class="button">show!</button>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VModal from 'vue-js-modal'
    export default {
        name: "NewsList",
        computed: {
            news: function(){
                return this.$store.state.news
            },
        },
        mounted() {
            console.log('Component mounted.')
            this.$store.dispatch('getNews')
        },
        methods: {
  	        show : function(i) {
  	            console.log("show")
                console.log(i)
                this.$modal.show('hello-world');
            },
            hide : function () {
                this.$modal.hide('hello-world');
            },
        }, 
    }
</script>
