<template>
    <div id="scada-svg" class="scada" ref="cnsvg"></div>
    {{ tags }}
</template>

<script>
export default {
    props: {
        //
    },
    data () {
        return {
            scadavis: null,
            tags: null,
            rotate: 1,
        }
    },
    async mounted () {
        await this.init()
        this.dataInit()
    },
    created() {
        window.addEventListener("resize", this.resize);
    },
    destroyed() {
        window.removeEventListener("resize", this.resize);
    },
    methods: {
        async init() { 
            this.scadavis = await scadavisInit({
                container: "scada-svg",
                svgurl: "/svg/sample.svg"
            })
            this.scadavis.enableTools(false, true);
            this.scadavis.hideWatermark()
            this.tags = this.scadavis.getTagsList().split(",")
             // set zero tags inital value
            this.tags.forEach(tag => {
                this.scadavis.setValue(tag, 0);
            });
            this.resize()
        },
        dataInit() {
            //set delay interval data
        let _this = this
        setInterval(function(){
            _this.tags.forEach(tag => {
                _this.scadavis.setValue(tag, Math.random() * 100);
            });
            _this.animate()
        }, 1000);
        },
        animate() {
            for(var j=1; j <=3; j++) {
                var ctr_01 = this.rotate
                var amp = 'amp_dig' + j;
                if(this.scadavis.getValue(amp) > 0) { 
                    if(ctr_01 < 4) {
                        ctr_01++;
                    }else{
                        ctr_01 = 1;
                    }
                    for(var i=1; i <= 4; i++) {
                        var val = (ctr_01 == i)? 1: 0;
                        var n = 'agitator_d'+j+'_'+i;
                        this.scadavis.setValue(n, val);
                    }
                }
                this.rotate = ctr_01
            }
        },
        resize(){
            this.scadavis.zoomToOriginal()
            let svelem = this.$refs.cnsvg
            this.scadavis.zoomTo(1.0 * ((svelem.clientWidth < svelem.clientHeight)? svelem.clientWidth/600 : svelem.clientHeight/600) );
        }
    }
}
</script>

<style>
.scada {
    height: calc(100vh - 160px);
    width: 100%;
}
iframe {
    border: 0;
    height: 100%;
    width: 100%;
}
</style>