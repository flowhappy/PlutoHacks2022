<template>
  <el-row>
    <el-col :span="3" style="position: sticky;top: 0">
      <el-radio-group v-model="isCollapse" style="margin-bottom: 20px;">
        <el-radio-button :label="false">open</el-radio-button>
        <el-radio-button :label="true">close</el-radio-button>
      </el-radio-group>
      <el-menu default-active="1-4-1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose"
               :collapse="isCollapse">
        <el-submenu v-for="(item_type,index) of type" :index="item_type+index" :key="item_type+index">
          <template slot="title">
            <i class="el-icon-location"></i>
            <span slot="title">{{ item_type.name }}</span>
          </template>
          <el-menu-item-group>
            <el-menu-item @click="changeArticle" v-for="(item_title,index) of title" v-show="item_title.type===item_type.name" :index="item_title" :key="item_title+index">{{ item_title.title }}</el-menu-item>
          </el-menu-item-group>
        </el-submenu>
        <el-submenu index="item_type+index" key="item_type+index" @click.native ="welcomeFade_">
          <template slot="title">
            <i class="el-icon-s-home"></i>
            <span>Quit the document</span>
          </template>
        </el-submenu>
      </el-menu>
    </el-col>
    <el-col :span="20">
      <article class="markdown-body" v-html="content" v-loading="loading"></article>
    </el-col>
  </el-row>
</template>

<script>
import axios from 'axios'
export default {
  name: "ContentPage",
  data() {
    return {
      timer:60,
      ctrl_timer:'',
      loading:false,
      type:[],
      title:[],
      isCollapse: false,
      /* eslint-disable */
      content:`<!doctype html>
<html>
<head>
<meta charset='UTF-8'><meta name='viewport' content='width=device-width initial-scale=1'>
<title>Welcome to StuHub, an introductory article</title>
</head>
<body><h1 id='welcome-to-stuhub-an-introductory-article'>Welcome to StuHub, an introductory article. </h1>
<p><strong>It will teach you how to use the website.</strong> </p>
<p><strong>At present, the content of this site is relatively simple, but with the continuous development of this site, the content and types will become more and more abundant.</strong> </p>
<h3 id='on-the-left-side-of-your-screen-is-the-title-of-the-article-click-on-what-you-want-to-know-about-it'>On the left side of your screen is the title of the article, click on what you want to know about it!</h3>
<pre><code class='language-c' lang='c'>int i =1;
</code></pre>
</body>
</html>`
      /* eslint-disable */
    }
  },
  methods: {
    notifyMsg_loaded(title) {
      this.$notify({
        title: 'Successfully Loaded!',
        message: 'Hope you can find what you are looking for in \''+title+'\'',
        type: 'success'
      });
    },
    notifyMsg_normal(title) {
      this.$notify.info({
        title: 'Loading...',
        message: 'Requesting from the server \''+title+'\'',
      });
    },
    handleOpen(key, keyPath) {
      console.log(key, keyPath);
    },
    handleClose(key, keyPath) {
      console.log(key, keyPath);
    },
    welcomeFade_() {
      clearInterval(this.ctrl_timer)
      this.welcomeFade(false)
    },
    changeArticle(e){
      this.loading = true
      this.notifyMsg_normal(e.index.title)
      axios.get(`https://www.lloydyide.cn/stuhub/getContent.php?title='${e.index.title}'`).then(
          response=> {
            this.notifyMsg_loaded(e.index.title)
            this.content = response.data[0].content
            this.loading = false
          }
      )
    }
  },
  props: [
    'welcomeFade'
  ],
  mounted() {
    axios.get(`https://www.lloydyide.cn/stuhub/getArticleType.php`).then(
        response=> {
          this.type = response.data
        }
    )
    axios.get(`https://www.lloydyide.cn/stuhub/getArticleTitle.php`).then(
        response=> {
          this.title = response.data
        }
    )
  }
}
</script>

<style scoped>
@import "github-markdown-css";
.el-menu-vertical-demo:not(.el-menu--collapse) {
  width: 16rem;
  min-height: 0;
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