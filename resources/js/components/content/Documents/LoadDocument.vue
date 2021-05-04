<template>
    <div class="load-doc">

        <h1>Загрузка документа</h1>
        <form @submit.prevent="send">
            <InputFile @change="fileInput"/>
            <TextAreaBox v-model="comment" label="Комментарий" :max="100" />
            <button type="submit" :disabled="waiting" class="btn primary">Загрузить</button>
        </form>

        <div class="preview" v-if="file && error.length === 0">
            <DocumentOnlineViewing :file="file" title="Предпросмотр:"/>
        </div>

        <div v-if="error.length > 0">
            <p v-for="item in error">{{item}}</p>
        </div>

    </div>
</template>

<script>
import InputFile from "../UI/InputFile";
import DocumentOnlineViewing from "../UI/DocumentOnlineViewing";
import TextAreaBox from "../UI/TextAreaBox";
export default {
    components: {
        InputFile,
        DocumentOnlineViewing,
        TextAreaBox,
    },
    name: "LoadDocument",
    data() {
        return {
            currPage: 1,
            numPages: 0,
            thePDF: null,

            waiting: false,

            file: null,
            error: [],
            comment: '',
        }
    },
    methods: {
        send(event) {
            this.waiting = true;


            let data = new FormData();
            data.append('file', this.file);
            data.append('comment', this.comment);


            let req = axios.post('/file/upload', data, {
                onUploadProgress: progressEvent => {console.log(progressEvent)}
            });

            req.then(value => {
                if (value['data']['status']['code'] == 0) {
                    this.$router.push({name: 'view', params: {id: value['data']['id']}});
                } else {
                    /* TODO Error */
                }
            });

            req.catch(reason => {});

            req.finally(() => {this.waiting = false});
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
.load-doc
    form
        max-width: 380px
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
