<template>
    <div>
        <InfoBox v-if="list.length < 1 && !waiting" type="danger" text="Ничего не нашлось"/>
        <Loading v-if="waiting"/>
        <ListItem v-for="(item, index) in list"
                  :key="index"
                  :id="item['id']"
                  :fio="item['sfio']"
                  :date="dateParse(item['date'])"
                  :comment="item['comment'] == null || item['comment'] == '' ? '-' : item['comment']"
                  :status="item['essence'] == null || item['essence'] == '' ? '-' : item['essence']"
        />
    </div>
</template>

<script>
import Loading from "../UI/Loading";
import InfoBox from "../UI/InfoBox";
import ListItem from "../UI/ListItem";
export default {
    name: "History",
    components: {
        ListItem,
        InfoBox,
        Loading,
    },
    props: {
        filter: {
            type: Object,
            default: {
                like: null,
                range: null
            }
        },
    },
    data() {
        return {
            list: [],
            waiting: false,
        }
    },
    watch: {
        filter() {
            console.log('load')
            this.load();
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        load() {
            this.waiting = true;
            let req = axios.post('/docs/history', this.filter);
            req.then(value => {this.list = value['data']})
            req.catch(() => {})
            req.finally(() => {this.waiting = false});
        },
        dateParse(date) {
            date = new Date(Date.parse(date));
            return ('' + date.getDate()).padStart(2, '0') + '.' + ('' + date.getMonth()).padStart(2, '0') + '.' + date.getFullYear();
        }
    }
}
</script>

<style scoped>

</style>
