<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ svg.name }}</h3>
        </div>
        <div class="box-body row">
            <div class="col-md-4">
                <div class="form-group" v-for="(val, tag) in tags" :key="tag">
                    <label class="col-sm-5 control-label">{{ tag }}</label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="text" class="form-control" v-model="tags[tag]">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat" @click="preview(tag, tags[tag])">Preview</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="setting">
                    <div class="form-group">
                        <label for="icon">MQTT Server</label>
                       
                            <v-select 
                                label="name" 
                                v-model="server"
                                :options="servers">
                                <template #open-indicator="{ attributes }">
                                    <span v-bind="attributes">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </template>
                                <template #option="{name, host, port}">
                                    {{ name }} ({{ host }}:{{ port }})
                                </template>
                                <template #selected-option="{name, host, port}">
                                    {{ name }} ({{ host }}:{{ port }})
                                </template>
                            </v-select>
                        
                    </div>
                    <div class="form-group">
                        <label for="icon">Topic</label>
                        <div class="input-group">
                            <input type="text" v-model="topic" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success" @click="connect">Connect</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="scada-svg" class="scada" ref="cnsvg"></div>
            </div>
        </div>
    </div>
</template>

<script>
import * as Mqtt from 'mqtt/dist/mqtt.min';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
export default {
    components: {vSelect},
    props: {
        svg: Object,
        servers: Array
    },
    data () {
        return {
            scadavis: null,
            tags: {},
            server: null,
            options: {},
            topic: null,
            connection: null
        }
    },
    created() {
        window.addEventListener("resize", this.resize);
    },
    destroyed() {
        window.removeEventListener("resize", this.resize);
    },
    mounted() {
        this.init()
    },
    methods: {
        async init() {
            this.scadavis = await scadavisInit({
                container: "scada-svg",
                svgurl: '/' + this.svg.path
            })
            this.scadavis.enableTools(false, true);
            this.scadavis.hideWatermark()
            let tags = this.scadavis.getTagsList().split(",")
            tags.forEach(tag => {
                this.scadavis.setValue(tag, 0);
                this.tags[tag] = 0
            });
            this.resize()
        },
        resize(){
            this.scadavis.zoomToOriginal()
            let svelem = this.$refs.cnsvg
            this.scadavis.zoomTo(1.0 * ((svelem.clientWidth < svelem.clientHeight)? svelem.clientWidth/600 : svelem.clientHeight/600) );
        },
        preview(tag, val) {
            this.scadavis.setValue(tag, val);
        },
        async connect() {
            let url = `${this.server.host}:${this.server.port}`
            this.connection = await Mqtt.connect(url, this.options) 
            let _that = this
            this.connection.on('connect', function () {
                _that.connection.subscribe(_that.topic, function (err) {
                    if (!err) {
                        console.log('connected')
                    }
                })
            })
            this.connection.on('message', this.received)
        },
        received(topic, message) {
            let data = JSON.parse(message.toString());
            for (const tag in data) {
                this.preview(tag, data[tag]);
            }
        },
    }
}
</script>

<style>
.scada {
    /* height: calc(100vh - 160px); */
    width: 100%;
}
iframe {
    border: 0;
    /* height: 100%; */
    width: 100%;
}
.mb-1{
    margin-bottom: 1rem;
}
</style>