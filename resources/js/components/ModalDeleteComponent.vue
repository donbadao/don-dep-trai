<template>
  <div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <form v-bind:action="modal.url" method="post">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ modal.title }}
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            {{ modal.content }}
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Đóng
            </button>
            <input
              type="hidden"
              id="hd_id"
              name="hd_id"
              v-bind:value="modal.id"
            />
            <input type="hidden" name="_token" :value="csrf">
            <button type="submit" class="btn btn-danger">Thực hiện</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('value'),
    };
  },
  props: {
    modal: {
      type: Object,
      require: true,
    },
  },
};
</script>
