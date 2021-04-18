<template>
    <div class="document-container">
        <Loading v-if="!isLoaded"/>
        <div class="not-found" v-if="!found && isLoaded">Документ не найден</div>
        <div class="document-body" :style="{display: isLoaded && found ? 'flex' : 'none'}">
            <DocumentOnlineViewing :file="file" />
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
            file: null,
        }
    },
    mounted() {
        let req = axios.post('/docs', {
            id: this.$route.params.id,
        });
        req.then(value => {
            value = value['data'];
            fetch(`/file/${value['id_avt']}`)
                .then(res => res.blob()) // Gets the response and returns it as a blob
                .then(blob => {
                    this.file = new File([blob], `file.${value['extension']}`,  { type: blob.type });
                    console.log(this.file);
                    this.found = true
                });
        });
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
