<template>
	<div class="process-table-thead">
        <div class="process-table-tr" >
            <div class="process-table-th day"></div>
            <div class="process-table-th first">AM / PM</div>
            <draggable
                id="table-header"
                v-if="reset"
                style="display:flex" group="nameGroup"
                @end="dragEnd($event)"
                :disabled="tableHeaderEnable"
            >
                <div  v-for="(manager, index) in managers" :key="index" class="process-table-th name" style="cursor:pointer">
                    {{ manager.name.substr( 0, 8 ) }}
                </div>
            </draggable>
            <!-- <div v-for="(manager, index) in managers" :key="index" class="process-table-th name">{{ manager.name.substr( 0, 8 ) }}</div> -->
        </div>
	</div>
</template>

<script>
	import draggable from 'vuedraggable'

	export default {
		components: {
			draggable,
		},
        data: function () {
            return {
                reset: true
            }
        },
        filters: {},
        mounted: function() {
        },
        computed: {
            calendars: function() {
                return this.$store.getters.getcalendars;
            },
            managers: function() {
                return this.$store.getters.getManagerLists;
            },
            tableHeaderEnable: function() {
                return !this.$store.getters.getTableHeaderEnable
            }
        },
        methods: {
            dragEnd(event){
                this.$store.commit('setTableHeaderEnable',false);
                setTimeout(()=>{
                    const divElement = document.getElementsByClassName("process-table")[0] ;
                    this.$store.commit('setScrollHeight',divElement.scrollTop);
                    this.$store.commit('changeManagerList',event);
                    this.reset = false

                    this.$nextTick(()=>{
                        this.reset = true
                    })
                    this.$store.commit('setResetFlg',false);
                }, 3500);
            },
        },
        // @choose="chooseProcess(calendars[id], 'yetcolumns', lineNumber, target)"
        // @add="addProcess(id, 'yetcolumns', lineNumber, target)"
        // @remove="removeProcess(id, 'yetcolumns', lineNumber, target)"
	}
</script>
