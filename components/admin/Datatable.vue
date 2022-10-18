
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
      compact-mode
      :pagination-options="{
        enabled: true,
        mode: 'pages',
        perPage: 10,
        position: 'bottom',
        perPageDropdown: [10, 20, 30, 40, 50, 75, 100, 1000],
        dropdownAllowAll: false,
        setCurrentPage: 1,
        jumpFirstOrLast: true,
        firstLabel: 'İlk Sayfa',
        lastLabel: 'Son Sayfa',
        nextLabel: 'Sonraki',
        prevLabel: 'Önceki',
        rowsPerPageLabel: 'Sayfadaki Satır Sayısı',
        ofLabel: '/',
        pageLabel: 'Sayfa', // for 'pages' mode
        allLabel: 'Tümü',
      }"
      :columns="columns"
      :rows="rows"
      :globalSearch="true"
      :search-options="{
        enabled: true,
        skipDiacritics: true,
        placeholder: 'Tabloda Ara',
        trigger: 'enter',
      }"
      @on-search="onSearch"
      :sort-options="{
        enabled: true,
        multipleColumns: true,
      }"
    />
  </div>
</template>

<script>
export default {
  name: "Datatable",
  props: ["columns", "dataurl", "token", "sort"],
  data() {
    return {
      isLoading: false,
      totalRecords: 0,
      serverParams: {
        columnFilters: {},
        start: 0,
        perPage: 10,
        page: 0,
        sort: [],
      },
      rows: [],
    };
  },
  methods: {
    updateParams(newProps) {
      this.serverParams = Object.assign({}, this.serverParams, newProps);
    },

    onPageChange(params) {
      this.updateParams({
        page: params.currentPage - 1,
        start: (params.currentPage - 1) * params.currentPerPage,
      });
      this.loadItems();
    },

    onPerPageChange(params) {
      this.updateParams({ perPage: params.currentPerPage });
      this.loadItems();
    },

    onSortChange(params) {
      console.log(params);
      let objIndex = this.sort.findIndex((obj) => obj.field == params[0].field);
      let newSort = this.sort;
      newSort[objIndex].type = params[0].type;
      this.updateParams({
        sort: newSort,
      });
      this.loadItems();
    },

    onColumnFilter(params) {
      this.updateParams(params);
      this.loadItems();
    },

    onSearch(params) {
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
    this.serverParams.sort = this.sort;
    this.loadItems();
  },
};
</script>




