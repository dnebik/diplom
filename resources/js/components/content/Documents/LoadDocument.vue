<template>
    <div class="load-doc">

        <h1>Загрузка документа</h1>
        <form @submit.prevent="send">
            <InputFile @change="fileInput"></InputFile>
            <button type="submit" class="btn primary">Загрузить</button>
        </form>


        <div class="preview" v-if="file && error.length === 0">
            <DocumentOnlineViewing :file="file"/>
        </div>

        <div v-if="error.length > 0">
            <p v-for="item in error">{{item}}</p>
        </div>

    </div>
</template>

<script>
import InputFile from "../UI/InputFile";
import DocumentOnlineViewing from "../UI/DocumentOnlineViewing";
export default {
    components: {
        InputFile,
        DocumentOnlineViewing,
    },
    name: "LoadDocument",
    data() {
        return {
            currPage: 1,
            numPages: 0,
            thePDF: null,

            file: null,
            error: []
        }
    },
    methods: {
        send(event) {
            let file = new FormData();
            file.append('file', this.file);
            let req = axios.post('/docs/upload', file, {
                onUploadProgress: progressEvent => {console.log(progressEvent)}
            });
            req.then(value => {});
            req.catch(reason => {})
        },
        fileInput(file) {
            this.file = file;
        }
    }
}
</script>


<style scoped lang="sass">
$modalPadding: 10px

.pages
    max-width: 500px

.preview
    margin-top: 60px

</style>

<style lang="sass">

.pages
    canvas, img
        border: 1px solid #028F91
        max-width: 500px
        width: 100%
        margin-bottom: 5px
        cursor: pointer
        &:hover
            box-shadow: 0 0 5px 5px #89E8C0

</style>
