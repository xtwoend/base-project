<template>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ svg.name }}</h3>
        </div>
        <div class="box-body row">
            <div class="col-md-4">
                <div class="form-group" v-for="(val, tag) in tags">
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
                <div id="scada-svg" class="scada" ref="cnsvg"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        svg: Object
    },
    data () {
        return {
            scadavis: null,
            tags: {}
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
        }
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