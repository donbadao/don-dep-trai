<template>
  <div>
    <button class="btn btn-success" @click="chooseImage">
      Chọn <span v-if="countSelectedFile != 0">({{ countSelectedFile }})</span>
    </button>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a
          class="nav-link active"
          id="home-tab"
          data-toggle="tab"
          href="#home"
          role="tab"
          aria-controls="home"
          aria-selected="true"
        >
          Thư viện
        </a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="padding: 10px">
      <div
        class="tab-pane fade show active"
        id="home"
        role="tabpanel"
        aria-labelledby="home-tab"
      >
        <div class="wrap">
          <div id="loading" v-if="isLoading">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>

          <div v-if="files.length == 0 && !isLoading">Chưa có dữ liệu</div>
          <ul class="row">
            <li
              v-for="(file, index) in files"
              v-bind:key="file.file_create_date"
              @contextmenu.prevent="$refs.menu.open($event)"
              v-bind:data-type="file.file_ext"
              v-bind:data-size="file.file_size"
              v-bind:data-id="index + 1"
              class="col-2"
              style="padding: 0px"
            >
              <div
                v-bind:class="
                  'file-man-box currsor wrap-image-box-' + (index + 1)
                "
                v-bind:data-id="index + 1"
                @click="selectImage"
                v-bind:data-file="file.files"
              >
                <div class="file-img-box">
                  <img
                    v-lazy="'contents/thumbs/' + file.files"
                    v-bind:title="file.files"
                    v-bind:alt="file.files"
                    v-bind:class="'img-fluid img_' + (index + 1) + ' '"
                    v-bind:id="index + 1"
                  />
                </div>

                <div class="file-man-title">
                  <h5 class="mb-0 text-overflow">{{ file.files }}</h5>
                  <p class="mb-0"><small>{{bytesToSize(file.file_size)}}</small></p>
                </div>
              </div>

              <!-- <div
                v-bind:data-id="index + 1"
                @click="selectImage"
                class="wrap-thumb"
                v-bind:data-file="file.files"
              >
                <img
                  v-lazy="'contents/thumbs/' + file.files"
                  v-bind:title="file.files"
                  v-bind:alt="file.files"
                  v-bind:class="'img-fluid img_' + (index + 1) + ' '"
                  v-bind:id="index + 1"
                />
              </div> -->
            </li>
          </ul>

          <div class="clear"></div>
        </div>
      </div>
    </div>

    <vue-context ref="menu">
      <li>
        <a
          class="dropdown-item"
          @click.prevent="onClick($event.target.innerText)"
          ><i class="fas fa-eye"></i> Xem</a
        >
      </li>
      <li>
        <a
          class="dropdown-item"
          @click.prevent="onClick($event.target.innerText)"
          ><i class="fal fa-trash-alt"></i> Xóa</a
        >
      </li>
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li>
        <div>File type : {{ fileType }}</div>
      </li>
    </vue-context>
  </div>
</template>



<script>
import VueContext from "vue-context";
import VueLazyload from "vue-lazyload";
Vue.use(VueLazyload, {
  preLoad: 1.3,
});
export default {
  components: {
    VueContext,
    VueLazyload,
  },
  data() {
    return {
      folders: [],
      files: [],
      columSort: "file_create_date",
      typeSort: "desc",
      isLoading: true,
      fileSize: 0,
      fileType: 0,
      fileSeclted: [],
      countSelectedFile: 0,
    };
  },

  created() {
    this.getFiles();
    this.getFolders();
  },

  methods: {
    getFiles() {
      axios.get("/g5r_blog/public/api/media/fetch").then(
        (respone) => (
          (this.isLoading = true),
          (this.files = respone.data),
          (this.files = respone.data.files.sort((a, b) => {
            let modifier = 1;
            if (this.typeSort === "desc") modifier = -1;
            if (a[this.columSort] < b[this.columSort]) return -1 * modifier;
            if (a[this.columSort] > b[this.columSort]) return 1 * modifier;
            return this.posts;
          })),
          (this.isLoading = false)
        )
      );
    },

    getFolders() {
      axios
        .get("/g5r_blog/public/api/media/fetch")
        .then((respone) => (this.folders = respone.data.folders));
    },

    onClick(text, data) {
      // console.log("selected image "+data.target.getAttribute('src'));
    },

    selectImage(event) {
      let id = event.currentTarget.getAttribute("data-id");
      let file = event.currentTarget.getAttribute("data-file");
      let wrap = $(".wrap-image-box-" + id);
      let img = $(".img_" + id);
      //img.toggleClass("selected");
      wrap.toggleClass("selected");

      if (img.hasClass("selected")) {
        this.fileSeclted.push(file);
      } else {
        let index = this.fileSeclted.indexOf(file);
        this.fileSeclted.splice(index);
      }
      if (this.fileSeclted.length > 0)
        this.countSelectedFile = this.fileSeclted.length;
      else this.countSelectedFile = 0;
    },
    chooseImage() {
      if (this.fileSeclted.length > 0) {
        console.log("Danh sách file " + this.fileSeclted);
        this.countSelectedFile = 0;
        this.fileSeclted = [];
      } else {
        console.log("Bạn chưa chọn file nào");
      }
    },

    bytesToSize(bytes) {
      var sizes = ["Bytes", "KB", "MB", "GB", "TB"];
      if (bytes == 0) return "0 Byte";
      var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
      return Math.round(bytes / Math.pow(1024, i), 2) + " " + sizes[i];
    },

  },
};
</script>
<style>
@import "~vue-context/dist/css/vue-context.css";
</style>
