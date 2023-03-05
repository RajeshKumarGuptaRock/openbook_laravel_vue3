<template>
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-4"></div>
            <div class="col-2">
                <button type="button" class="btn btn-dark mt-2" @click="logout">Logout</button>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col order-last">
            </div>
        </div>
    </div>
</template>
<script>
import { useRouter } from "vue-router"
import { useStore } from 'vuex'

export default{
    setup(){
        const router = useRouter();
        const store = useStore();

        function logout(){
            store.dispatch('removeToken');
            router.push({name: 'Home'})
        }
        return {
            logout,
        }
    }
}
</script>