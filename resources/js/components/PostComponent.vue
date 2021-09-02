<template>
  <div id="posts">
    <div id="page-title" class="page-title">
      <div class="left">
        <h1>Danh sách bài viết</h1>
      </div>
      <div class="right">
        <a href="admin/post/create" class="btn btn-primary mt-2"
          ><i class="fad fa-plus-circle"></i> Tạo bài viết</a
        >
      </div>
    </div>
    <div class="search">
      <input
        @change="searchTitle"
        type="text"
        class="form-control"
        placeholder="Nhập từ khóa để tìm kiếm..."
      />
    </div>

    <div id="post_wrapper">
      <div id="loading" v-if="isLoading">
        <div class="spinner-border" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div
        class="text-danger text-center mt-5"
        v-if="posts.length == 0 && !isLoading"
      >
        <div
          class="
            row
            no-gutters
            align-items-center
            justify-content-center
            min-height-300px
          "
        >
          <div class="col flex-column text-center">
            <svg
              class="svg-next-icon mb-5 color-heather svg-next-icon-size-100"
              width="100"
              height="100"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 100 100"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  clip-rule="evenodd"
                  d="M66.1625 81.2487L83.0813 98.1672C85.525 100.611 89.475 100.611 91.9187 98.1672L98.1687 91.9173C99.3875 90.6986 100 89.0986 100 87.4986C100 85.8987 99.3875 84.2987 98.1687 83.08L81.25 66.1615C85.1937 59.5991 87.5 51.9492 87.5 43.7493C87.5 19.6309 67.875 7.62939e-06 43.75 7.62939e-06C19.625 7.62939e-06 0 19.6309 0 43.7493C0 67.8677 19.625 87.4986 43.75 87.4986C51.9437 87.4986 59.6 85.1862 66.1625 81.2487ZM43.75 12.4984C61.0062 12.4984 75 26.4919 75 43.7479C75 61.0039 61.0062 74.9974 43.75 74.9974C26.4937 74.9974 12.5 61.0039 12.5 43.7479C12.5 26.4919 26.4937 12.4984 43.75 12.4984Z"
                  fill="#CCE4F4"
                ></path>
              </svg>
            </svg>
            <div class="text-center font-size-20px mb-3 text-no--data">
              Không tìm thấy bất kỳ Bài viết nào
            </div>
            <div class="text-center text-secondary">
              Hãy thay đổi bộ lọc hoặc điều kiện tìm kiếm
            </div>
          </div>
        </div>
      </div>
      <table class="table" v-if="posts.length > 0">
        <thead>
          <tr>
            <th>#</th>
            <th width="40%">Tiêu đề</th>
            <th @click="sort('post_date_create')" class="cursor">
              <i class="fas fa-sort"></i> Ngày đăng
            </th>
            <th>Danh mục</th>
            <th>Tác giả</th>
            <th @click="sort('post_views')" class="cursor">
              <i class="fas fa-sort"></i> Lượt xem
            </th>
            <th @click="sort('post_feature')" class="cursor">
              <i class="fas fa-sort"></i> Nổi bật
            </th>
            <th colspan="2"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, index) in posts" v-bind:key="post.post_id">
            <td>{{ index + 1 }}</td>
            <td>
              <a
              data-bs-toggle="tooltip"
               data-bs-placement="bottom" 
               class="title"
                v-bind:href="'admin/post/edit/' + post.post_id"
                v-bind:title="post.post_title"
                >{{ post.post_title }}</a
              >
            </td>
            <td>{{ post.post_date_create }}</td>
            <td class="text-center">{{ post.cat_name }}</td>
            <td class="text-center">{{ post.user_name }}</td>
            <td class="text-center">{{ post.post_views }}</td>
            <td class="text-center">
              <input
                type="checkbox"
                class="form-check-input"
                v-bind:checked="post.post_feature == 1 ? true : false"
                v-bind:id="post.post_id"
                v-bind:data-id="post.post_id"
                v-on:change="activePost"
              />
            </td>
            <td width="100">
              <a
                v-bind:href="'admin/post/edit/' + post.post_id"
                class="btn btn-secondary btn-sm"
                ><i class="fal fa-pencil-alt"></i
              ></a>
              <button
                v-on:click="getPostID(post.post_id)"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                class="btn btn-danger btn-sm"
              >
                <i class="fal fa-trash-alt"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
      <paginations
        v-if="posts.length > 0"
        v-bind:pagination="pagination"
        v-on:click.native="getPaginatePost(pagination.current_page)"
        :offset="4"
      ></paginations>

      <modaldelete v-bind:modal="modal"></modaldelete>
    </div>
  </div>
</template>

<script>
import Paginations from "./Paginations";
import ModalDelete from "./ModalDeleteComponent";

export default {
  name:'postcomponent',
  components: {
    paginations: Paginations,
    modaldelete: ModalDelete,
  },
  data() {
    return {
      roots: [],
      posts: [],
      txtFilter: "",
      isLoading: false,
      modal: {
        title: "Xác nhận xóa bài viết?",
        content: "Bạn có muốn xóa bài viết này không?",
        url: "admin/post/delete",
        id: 10,
      },
      pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1,
      },
      offset: 4,
      columSort: "post_date_create",
      typeSort: "desc",
      csrf: document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("value"),
    };
  },
  mounted() {},
  created() {
    this.getPaginatePost(this.pagination.current_page);
    this.getAllPosts();
  },
  computed: {},
  methods: {
    getPaginatePost(page) {
      this.isLoading = true;
      axios
        .get("/g5r_blog/public/api/post/fetch?page=" + page)
        .then(
          (respone) => (
            (this.posts = respone.data.data),
            (this.isLoading = false),
            (this.pagination = respone.data)
          )
        );
    },
    getAllPosts() {
      this.isLoading = true;
      axios
        .get("/g5r_blog/public/api/post/fetchall")
        .then(
          (respone) => ((this.roots = respone.data), (this.isLoading = false))
        );
    },
    searchTitle(event) {
      let vm = this;
      this.isLoading = true;
      let keyword = event.target.value;
      if (keyword.length > 0) {
        this.posts = this.roots.data.filter(function (post) {
          return (
            post.post_title.toLowerCase().indexOf(keyword.toLowerCase()) > -1
          );
        });
        this.isLoading = false;
        return this.posts;
      } else {
        this.isLoading = false;
        this.getPaginatePost(this.pagination.current_page);
      }
    },
    getPostID(id) {
      this.modal.id = id;
    },
    sort(key) {
      if (key === this.columSort) {
        this.typeSort = this.typeSort === "asc" ? "desc" : "asc";
      }
      this.columSort = key;

      this.sortedCats();
    },

    sortedCats: function () {
      this.isLoading = true;
      this.posts = this.roots.data
        .sort((a, b) => {
          let modifier = 1;
          if (this.typeSort === "desc") modifier = -1;
          if (a[this.columSort] < b[this.columSort]) return -1 * modifier;
          if (a[this.columSort] > b[this.columSort]) return 1 * modifier;
          return this.posts;
        })
        .filter((row, index) => {
          let start =
            (this.pagination.current_page - 1) * this.pagination.per_page;
          let end = this.pagination.current_page * this.pagination.per_page;
          if (index >= start && index < end) return true;
        });
      this.isLoading = false;
      return this.posts;
    },

    activePost(event) {
      let data = {
        id: event.target.getAttribute("data-id"),
        _token: this.csrf,
      };
      axios.post("/g5r_blog/public/admin/post/updatestatus", data)
      .then(respone=>(console.log(respone)));

      // console.log(data);
      // this.$http
      //   .post("/g5r_blog/public/admin/post/updatestatus", data)
      //   .then((respone) => {
      //     console.log(data);
      //   });
    },
  },
};
</script>

<style lang="css" scoped>
</style>