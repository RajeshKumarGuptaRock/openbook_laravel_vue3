<template>
    <div v-if="openclose"
    class="modal fade show"
   style="display:block"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Contact Details
          </h5>
          <button
            type="button"
            class="btn-close"
            @click="OpenCloseFun()"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body" >
          <slot></slot>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            @click="OpenCloseFun()"
            :class="'btn btn-'+variant"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
  <button
            type="button"
            @click="OpenCloseFun()"
            :class="'btn btn-success'"
          >
            Open Modal
          </button>
</template>
<script>
export default {
    name : 'Modelbox',
    props:{
        visible: Boolean,
        vaiant: String,
    },
    data(){
        return{
            OpenClose:this.visible
        }
    },
    methods:{
        OpenCloseFun(){
            this.OpenClose = !this.OpenClose
        }
    },
    watch:{
        visible: function(newVal, oldVal){
            this.OpenClose = newVal
            console.log('new' + newVal + '==' + oldVal)
        }
    }
}
</script>