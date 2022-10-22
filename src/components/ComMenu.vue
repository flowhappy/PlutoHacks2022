<template>
  <el-menu class="el-menu-demo" mode="horizontal">
    <el-menu-item style="cursor: pointer;width: 5vw;font-size: 2rem;padding: 0;text-align: center" @click="startEdit_">Quit</el-menu-item>
    <el-menu-item disabled style="cursor: inherit;width:45vw;padding-left: 5rem;font-size: 4.6rem">MarkDown Editor</el-menu-item>
    <el-menu-item style="cursor: pointer;width: 50vw;font-size: 4.6rem;text-align: center" @click="publish_">Publish</el-menu-item>
  </el-menu>
</template>

<script>
export default {
  name: "ComMenu",
  data() {
    return {

    };
  },
  methods: {
    publish_() {
      this.publish()
    },
    startEdit_() {
      this.startEdit(true)
      this.welcomeFade(false)
    },
  },
  props:[
    'publish',
    'startEdit',
    'welcomeFade'
  ]
}
</script>

<style scoped>

</style>