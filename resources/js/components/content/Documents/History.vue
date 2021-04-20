<template>
    <div>
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
import ListItem from "../UI/ListItem";
export default {
    name: "History",
    components: {
        ListItem,
    },
    data() {
        return {
            list: [],
        }
    },
    mounted() {
        this.load();
    },
    methods: {
        load() {
            let req = axios.post('/docs/history');
            req.then(value => {this.list = value['data']})
            req.catch(() => {})
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
