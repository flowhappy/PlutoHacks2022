<template>
  <div id="app">
    <content-page :class="{animate__animated:true, animate__fadeIn:true}" v-if="isFade&&noEdit" :welcomeFade="welcomeFade"/>
    <compile-push v-if="isFade&&!noEdit" :startEdit="startEdit" :welcomeFade="welcomeFade"/>
    <welcome-stu-hub v-show="!isFade" :startEdit="startEdit" :noEdit="noEdit" :isFade="isFade" :welcomeFade="welcomeFade"/>
  </div>
</template>

<script>
import 'animate.css';
import WelcomeStuHub from "@/components/WelcomeStuHub";
import ContentPage from "@/components/ContentPage";
import CompilePush from "@/components/CompilePush";

export default {
  name: 'App',
  components: {
    WelcomeStuHub,
    ContentPage,
    CompilePush
  },
  data(){
    return{
      isFade:false,
      noEdit:true,
    }
  },
  methods:{
    welcomeFade(code){
      this.isFade=code
    },
    startEdit(code){
      this.noEdit=code
    }
  }

}
</script>

<style>
@import "github-markdown-css";
.el-dialog{
  background-color: rgba(255,255,255,0.9);
  border-radius: 20px;
}
body{
  background-color: #FFECE9;
  transition: 300ms !important;
}
</style>
