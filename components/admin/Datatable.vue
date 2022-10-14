
<template>
  <div>
    <vue-good-table
      mode="remote"
      @on-page-change="onPageChange"
      @on-sort-change="onSortChange"
      @on-column-filter="onColumnFilter"
      @on-per-page-change="onPerPageChange"
      :totalRows="totalRecords"
      :isLoading.sync="isLoading"
      :pagination-options="{
        enabled: true,
      }"
      :columns="columns"
      :rows="rows"
      compactMode
      :fixed-header="true"
    />
  </div>
</template>

<script>
export default {
  name: "Datatable",
  props: ["columns", "dataurl", "token"],
  data() {
    return {
      isLoading: false,
      totalRecords: 0,
      serverParams: {
        columnFilters: {},
        sort: [
          {
            field: "",
            type: "",
          },
        ],
        length: -1,
        start: 1,
      },
      rows: [],
    };
  },
  methods: {
    updateParams(newProps) {
      this.serverParams = Object.assign({}, this.serverParams, newProps);
    },

    onPageChange(params) {
      this.updateParams({ page: params.currentPage });
      this.loadItems();
    },

    onPerPageChange(params) {
      this.updateParams({ perPage: params.currentPerPage });
      this.loadItems();
    },

    onSortChange(params) {
      this.updateParams({
        sort: [
          {
            type: params.sortType,
            field: this.columns[params.columnIndex].field,
          },
        ],
      });
      this.loadItems();
    },

    onColumnFilter(params) {
      this.updateParams(params);
      this.loadItems();
    },

    // load items is what brings back the rows from server
    loadItems() {
      this.getFromServer(this.serverParams).then((response) => {
        this.totalRecords = response.recordsTotal;
        this.rows = response.data;
      });
    },
    getFromServer(params) {
      console.log(params);
     
      const data = this.$axios.$post(this.dataurl, params);
      return data;
    },
  },
  mounted() {
    this.loadItems();
  },
};
</script>




