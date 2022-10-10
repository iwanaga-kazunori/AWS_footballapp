import Vue from'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)
import NewsList from './components/NewsComponent'
const store = new Vuex.Store({
    state: {
        count: 0,
        news: [],
    },
    
    getters: {
        
    },
    
    mutations: {
        setNews : function(state,news) {
            state.news = news
        },
    },
    
    actions: {
        getNews: function({commit}){
            return axios.get('news/api')
            .then(response => {
            commit('setNews',response.data)
            })
            .catch(function (error) {
                    console.log(error)
            })
        }
    },
    
    
})
export default store