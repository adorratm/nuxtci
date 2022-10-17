
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
        mode: 'records',
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
    />
  </div>
</template>

<script>
export default {
  name: "Datatable",
  props: ["columns", "dataurl", "token"],
  computed: {
    pagesNumber() {
      if (!this.pagination.to) {
        return [];
      }
      let from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }
      let to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }
      let pagesArray = [];
      for (let page = from; page <= to; page++) {
        pagesArray.push(page);
      }
      return pagesArray;
    },
  },
  data() {
    return {
      pagination:{},
      offset:4,
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
        perPage: 10,
        page: 0,
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
        page: params.currentPage,
        perPage: params.currentPerPage + params.currentPage,
      });
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
    this.loadItems();
  },
};
</script>




