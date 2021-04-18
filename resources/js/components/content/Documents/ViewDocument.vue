<template>
    <div class="document-container">
        <Loading v-if="!isLoaded"/>
        <div class="not-found" v-if="!found && isLoaded">Документ не найден</div>
        <div class="document-body" :style="{display: isLoaded && found ? 'flex' : 'none'}">
            <h1>sadasd</h1>
        </div>
    </div>
</template>

<script>
import Loading from "../UI/Loading";
import DocumentOnlineViewing from "../UI/DocumentOnlineViewing";
export default {
    name: "ViewDocument",
    components: {
        DocumentOnlineViewing,
        Loading,
    },
    data() {
        return {
            isLoaded: false,
            found: false,
        }
    },
    mounted() {
        let req = axios.post('/docs', {
            id: this.$route.params.id,
        });
        req.then(value => {this.found = true});
        req.catch(reason => {});
        req.finally(() => {this.isLoaded = true})
    }
}
</script>

<style scoped>
    .document-container {
        flex: auto;
    }
</style>
