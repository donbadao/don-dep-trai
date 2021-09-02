<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item" v-if="pagination.current_page > 1">
        <a  class="page-link"
          href="#"
          aria-label="Previous"
          v-on:click.prevent="changePage(pagination.current_page - 1)"
        >
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li class="page-item"
        v-for="page in pagesNumber"
        :class="{ active: page == pagination.current_page }"
        v-bind:key="page"
      >
        <a  class="page-link" href="#" v-on:click.prevent="changePage(page)">{{ page }}</a>
      </li>
      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
        <a class="page-link"
          href="#"
          aria-label="Next"
          v-on:click.prevent="changePage(pagination.current_page + 1)"
        >
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    pagination: {
      type: Object,
      require: true,
    },
    offset: {
      type: Number,
      default: 4,
    },
  },
  computed: {
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }
      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      var pagesArray = [];
      for (from = 1; from <= to; from++) {
        pagesArray.push(from);
      }
      return pagesArray;
    },
  },
  methods: {
    changePage: function (page) {
      this.pagination.current_page = page;
    },
  },
};
</script>
