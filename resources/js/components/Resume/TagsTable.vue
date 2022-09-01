<template>
  <div ref="root" id="tags-table" class="tags-table" >
    <div class="row gy-2">
      <div v-for="(tag,index) in tags" class="col-4">
          <div class="tag" :key="index" :ref="`tag_${tag.id}`"
               :class="{selected: isHovered(index) || selected.includes(index) }"
               @mouseover="hoverTag(index)"
               @mouseout="hoverTag(-1)"
               @mousedown="selectTag(index)">
            {{ tag.name }}
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data: function ()  {
    return{
      tags: {},
      selectedTag: -1,
      selected: [],
    }
  },
  mounted() {
    this.loadtags();
  },

  methods: {
    loadtags() {
      axios.get('/api/tags')
          .then((response) => {
            this.tags = response.data;
            console.log(this.tags);
          })
          .catch(function (error) {
            console.log(error)
          })
    },
    hoverTag(index) {
      this.selectedTag=index
    },

    isHovered(tagIndex) {
      return this.selectedTag === tagIndex
    },

    selectTag(tagIndex){
      this.selected.push(tagIndex)
    }
  }
}


</script>

