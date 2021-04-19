<template>
    <div class="document-container">
        <Loading v-if="!(found && isLoaded) || (found && !fileLoaded)"/>
        <div class="not-found" v-if="!found && isLoaded">Документ не найден</div>
        <div class="document-body" :style="{display: fileLoaded ? 'flex' : 'none'}">
            <DocumentOnlineViewing :file="file"/>
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
            fileLoaded: false,
            found: false,
            file: null,
        }
    },
    mounted() {
        let req = axios.post('/docs', {
            id: this.$route.params.id,
        });
        req.then(value => {
            if (value['data']['status']['code'] == 0) {
                value = value['data']['document'];
                this.found = true;
                fetch(`/file/${value['id_avt']}`)
                    .then(res => res.blob()) // Gets the response and returns it as a blob
                    .then(blob => {
                        this.file = new File([blob], `file.${value['extension']}`,  { type: blob.type });
                        this.fileLoaded = true;
                    });
            } else {
                /* TODO Error */
            }
        });
        req.catch(reason => {});
        req.finally(() => {
            this.isLoaded = true;
        })
    }
}
</script>

<style scoped>
    .document-container {
        flex: auto;
    }
</style>
