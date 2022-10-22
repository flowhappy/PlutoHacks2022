<template>
  <div>
    <el-dialog
        title="Publish"
        :visible.sync="centerDialogVisible"
        width="30%"
        center>
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
        <el-form-item label="name" prop="name">
          <el-input v-model="ruleForm.name"></el-input>
        </el-form-item>
        <el-form-item label="type" prop="name">
          <el-input v-model="ruleForm.type"></el-input>
        </el-form-item>
        <el-button @click="centerDialogVisible = false" style="margin-left: 6rem">cancel</el-button>
        <el-button type="primary" @click="publishArticle">publish</el-button>
      </el-form>

    </el-dialog>

    <div :class="{animate__animated:true, animate__fadeIn:true}">
      <com-menu :publish="publish" :startEdit="startEdit" :welcomeFade="welcomeFade"/>
      <div id="editor" style="height: 90vh">
        <textarea id="md-area" @keyup=mdConverter() v-model="md"></textarea>
        <article style="overflow: scroll" id="view-area" v-html="content" class="markdown-body"></article>
      </div>

    </div>
  </div>
</template>

<script>
import showdown from 'showdown'
import table from 'showdown-table'
import comMenu from "@/components/ComMenu";
import axios from "axios";

export default {
  name: "CompilePush",
  components: {
    comMenu
  },
  data() {
    return {
      md: `# Text Here
       When you ready to publish your article, click the Publish`,
      content: "",
      centerDialogVisible: false,
      ruleForm: {
        name: '',
        type: '',
      },
      rules: {
        name: [
          { required: true, message: 'Please enter the article name.', trigger: 'blur' },
        ],
        type: [
          { required: true, message: 'Please enter article type', trigger: 'blur' },
        ],
      }
    }
  },
  props: [
    'startEdit',
    'welcomeFade'
  ],
  methods: {
    startEdit_() {
      this.startEdit(true)
      this.welcomeFade(true)
    },
    mdConverter() {
      let converter = new showdown.Converter({extensions: [table]});
      this.content = converter.makeHtml(this.md);
    },
    publish(){
      this.centerDialogVisible = true
    },
    publishArticle(){
      let {name,type} = {...this.ruleForm}
      let content = this.content.replace(/\s/g,'%20');
      console.log(this.content)
      if(name&&type){
        axios.get(
            `https://www.lloydyide.cn/stuhub/getNewArticle.php?name=${name}&type=${type}&content=${content}`).then(res=>{
          console.log(res)
          this.startEdit_();
        })
      }
    }
  },
  mounted() {
    this.mdConverter();
  }
}
</script>

<style scoped>
.el-drawer{

}
#md-area, #view-area {
  margin: 1rem;
}

#editor {
  display: flex;
  min-height: 80vh;
  width: 100%;
}

#md-area {
  width: 49vw;
  box-shadow: 0 0 30px 0 #eeeeee;
  border: 0;
  border-radius: 20px;
  padding: 20px;
}

#view-area {
  width: 49vw;
  box-shadow: 0 0 30px 0 #eeeeee;
  border-radius: 20px;
}

.markdown-body {
  box-sizing: border-box;
  min-width: 200px;
  max-width: 980px;
  margin: 0 auto;
  padding: 45px;
}

@media (max-width: 767px) {
  .markdown-body {
    padding: 15px;
  }
}
</style>