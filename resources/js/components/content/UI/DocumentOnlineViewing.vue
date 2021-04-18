<template>
    <div>
        <h2>Предпросмотр: </h2>
        <div>{{error.join(', ')}}</div>
        <div class="pages" ref="pages">

        </div>
    </div>
</template>

<script>
export default {
    name: "DocumentOnlineViewing",
    data() {
        return {
            error: [],
        }
    },
    props: {
        file: {
            required: true,
        }
    },
    watch: {
        file() {
            this.fileCheck();
        }
    },
    destroyed() {
        document.removeEventListener('click', this.canvasShow);
    },
    mounted() {
        document.addEventListener('click', this.canvasShow);
        this.fileCheck();
    },
    methods: {
        canvasShow(event) {
            let target = event.target;
            let modal;

            if (document.getElementsByClassName('modal').length === 0 &&
                ['CANVAS', 'IMG'].includes(target.tagName)
            ) {
                modal = document.createElement('div');
                modal.classList.add('modal');
                document.getElementsByTagName('body')[0].append(modal);
            }

            let newCanvas;
            let context;

            switch (target.tagName) {
                case 'CANVAS':
                    newCanvas = document.createElement('canvas');
                    context = newCanvas.getContext('2d');

                    newCanvas.width = target.width;
                    newCanvas.height = target.height;

                    context.drawImage(target, 0, 0);

                    modal.append(newCanvas);
                    document.body.classList.add('modal-show');
                    break;
                case 'IMG':
                    modal.append(target.cloneNode());
                    document.body.classList.add('modal-show');
                    break;
                case 'DIV':
                    if (target.classList.contains('modal')) {
                        let modal = document.getElementsByClassName('modal')[0];
                        document.body.removeChild(modal);
                        document.body.classList.remove('modal-show');
                        break;
                    }
            }
        },
        fileCheck() {
            if (this.file == null) {
                this.error.push(
                    `Просмотр файла недоступен.`);
                return;
            }

            let $this = this;
            this.error = [];

            if (this.file.type.search(/pdf/) > -1)
            {

                setTimeout(() => {
                    this.$refs['pages'].innerHTML = ''

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
                    fileReader.readAsArrayBuffer(this.file);


                }, 1);


            } else if (this.file.type.search(/image/) > -1) {


                setTimeout(() => {
                    this.$refs['pages'].innerHTML = '';

                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let dom = document.createElement('img');
                        dom.setAttribute('src', e.target.result);
                        $this.$refs.pages.append(dom);
                    }
                    reader.readAsDataURL(this.file);

                }, 1)


            } else {
                this.error.push(
                    `Просмотр файла, формата "${this.file.name.split('.').pop()}", не поддерживается`);
            }
        }
    }
}
</script>

<style scoped>

</style>
<style lang="sass">

$modalPadding: 10px


.modal
    left: 0
    top: 0
    z-index: 100
    padding: $modalPadding
    box-sizing: border-box
    display: flex
    align-items: center
    justify-content: center
    position: fixed
    width: 100vw
    height: 100vh
    background-color: #00000050
    & > *
        max-width: calc(100% - #{$modalPadding * 2})
        max-height: calc(100% - #{$modalPadding * 2})
        box-shadow: 0 0 6px 2px #89E8C0
        background-color: white
        pointer-events: none

</style>
