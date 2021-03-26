<template>
    <div class="load-doc">

        <h1>Загрузка документа</h1>
        <InputFile @change="fileInput"></InputFile>
        <button type="submit" class="btn primary">Загрузить</button>


        <div class="preview" v-if="file && error.length === 0">
            <h2>Предпросмотр: </h2>
            <div class="pages" ref="pages">

            </div>
        </div>

        <div v-if="error.length > 0">
            <p v-for="item in error">{{item}}</p>
        </div>


        <div class="modal" ref="modal">

        </div>

    </div>
</template>

<script>
import InputFile from "../UI/InputFile";
export default {
    components: {
        InputFile
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
    mounted() {
        document.addEventListener('click', this.canvasShow)
    },
    methods: {
        canvasShow(event) {
            let target = event.target;
            switch (target.tagName) {
                case 'CANVAS':
                    let modal = this.$refs.modal;
                    modal.innerHTML = '';
                    modal.classList.add('show');

                    let newCanvas = document.createElement('canvas');
                    let context = newCanvas.getContext('2d');

                    newCanvas.width = target.width;
                    newCanvas.height = target.height;

                    context.drawImage(target, 0, 0);

                    modal.append(newCanvas);
                    document.body.classList.add('modal-show');
                    break
                case 'DIV':
                    if (target.classList.contains('modal')) {
                        let modal = this.$refs.modal;
                        modal.innerHTML = '';
                        modal.classList.remove('show');
                        document.body.classList.remove('modal-show');
                        break
                    }
            }
        },
        fileInput(file) {
            let $this = this;
            this.file = file;
            this.error = [];


            if (file.type.search(/pdf/) > -1)
            {

                setTimeout(() => {
                    $this.$refs.pages.innerHTML = ''

                    let fileReader = new FileReader();
                    fileReader.onload = function() {
                        let typedarray = new Uint8Array(this.result);
                        let loadingTask = pdfjsLib.getDocument(typedarray);
                        loadingTask.promise.then(function(pdf) {

                            let pageCount = pdf.numPages;
                            let pageNumber = 1;

                            pdf.getPage(pageNumber).then(handlePages);

                            function handlePages(page) {

                                let scale = 1.5;
                                let viewport = page.getViewport({scale: scale});

                                let canvas = document.createElement('canvas');
                                let context = canvas.getContext('2d');
                                $this.$refs.pages.append(canvas);
                                canvas.height = viewport.height;
                                canvas.width = viewport.width;

                                let renderContext = {
                                    canvasContext: context,
                                    viewport: viewport
                                };
                                page.render(renderContext);

                                if (++pageNumber <= pageCount)
                                {
                                    pdf.getPage(pageNumber).then(handlePages);
                                }
                            }
                        }, function (reason) {
                            $this.error.push(reason.message);
                        });


                    };
                    //Step 3:Read the file as ArrayBuffer
                    fileReader.readAsArrayBuffer(file);


                }, 1);


            } else if (file.type.search(/image/) > -1) {

            } else {
                this.error.push('Неподдерживаемый формат');
            }
        }
    }
}
</script>


<style scoped lang="sass">
$modalPadding: 10px

.pages
    max-width: 500px

.modal
    display: none
    left: 0
    top: 0
    z-index: 100
    padding: $modalPadding
    box-sizing: border-box
    &.show
        display: flex
        align-items: center
        justify-content: center
        position: fixed
        width: 100vw
        height: 100vh
        background-color: #00000050

.preview
    margin-top: 60px

</style>

<style lang="sass">
$modalPadding: 10px

.pages
    canvas
        border: 1px solid #028F91
        max-width: 500px
        width: 100%
        margin-bottom: 5px
        cursor: pointer
        &:hover
            box-shadow: 0 0 5px 5px #89E8C0
.modal
    & > *
        max-width: calc(100% - #{$modalPadding * 2})
        max-height: calc(100% - #{$modalPadding * 2})
        box-shadow: 0 0 6px 2px #89E8C0
        pointer-events: none

</style>
