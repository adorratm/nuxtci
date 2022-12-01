
<template>
  <client-only>
    <vue-good-table
      mode="remote"
      @on-page-change="onPageChange"
      @on-sort-change="onSortChange"
      @on-column-filter="onColumnFilter"
      @on-per-page-change="onPerPageChange"
      :totalRows="totalRecords"
      :isLoading.sync="isLoading"
      compact-mode
      theme="polar-bear"
      :pagination-options="{
        enabled: true,
        mode: 'pages',
        perPage: 50,
        position: 'bottom',
        perPageDropdown: [50, 75, 100, 250, 500, 750, 1000],
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
    >
      <template slot="table-row" slot-scope="props">
        <span v-if="props.column.field === 'rank'">
          <input
            class="form-control form-control-sm rounded-0"
            @change="changeRank($event, props.row.id)"
            :value="props.formattedRow[props.column.field]"
          />
        </span>
        <span v-else-if="props.column.field === 'isActive'">
          <div class="custom-control custom-switch">
            <input
              :id="'customSwitch' + props.row.id"
              type="checkbox"
              class="my-check custom-control-input"
              :checked="props.row.isActive == 1 ? true : false"
              @input.prevent="changeIsActive($event, props.row.id)"
            />
            <label
              class="custom-control-label"
              :for="'customSwitch' + props.row.id"
            ></label>
          </div>
        </span>
        <span v-else-if="props.column.field === 'actions'">
          <div class="dropdown">
            <button
              class="btn btn-sm btn-outline-primary rounded-0 dropdown-toggle"
              type="button"
              id="dropdownMenuButton"
              data-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              {{ $t("panel.actions") }}
            </button>
            <div
              class="dropdown-menu rounded-0 dropdown-menu-right"
              aria-labelledby="dropdownMenuButton"
            >
              <nuxt-link class="dropdown-item" :to="editurl + props.row.id"
                ><i class="fa fa-pen mr-2"></i
                >{{ $t("panel.editRecord") }}</nuxt-link
              >
              <a
                href="javascript:void(0)"
                class="dropdown-item remove-btn"
                @click="deleteRecord(props.row.id)"
                ><i class="fa fa-trash mr-2"></i
                >{{ $t("panel.deleteRecord") }}</a
              >
            </div>
          </div>
        </span>
        <span v-else>
          {{ props.formattedRow[props.column.field] }}
        </span>
      </template>
    </vue-good-table>
  </client-only>
</template>

<script>
export default {
  name: "Datatable",
  props: [
    "columns",
    "dataurl",
    "token",
    "sort",
    "rankurl",
    "isactiveurl",
    "editurl",
    "deleteurl",
  ],
  data() {
    return {
      isLoading: true,
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
    async deleteRecord(id) {
      await this.$swal({
        title: this.$t("panel.areYouSure"),
        text: this.$t("panel.cannotTurnBack"),
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: this.$t("panel.yesDeleteIt"),
        cancelButtonText: this.$t("panel.no"),
      }).then(async (result) => {
        if (result.value) {
          try {
            let { data } = await this.$axios.delete(this.deleteurl + id);
            data.status
              ? this.$toast.success(data.message, this.$t("successfully"))
              : this.$toast.error(data.message, this.$t("unsuccessfully"));
            this.loadItems();
          } catch (error) {
            console.log(error);
          }
        }
      });
    },

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
      const data = this.$axios.$post(this.dataurl, params);
      return data;
    },

    // Rank Change
    async changeRank(e, id) {
      try {
        let response = await this.$axios.$put(this.rankurl + id, {
          rank: e.target.value,
        });
        response.status
          ? this.$toast.success(response.message, this.$t("successfully"))
          : this.$toast.error(response.message, this.$t("unsuccessfully"));
      } catch (error) {
        console.log(error);
      }
    },

    // Status Change
    async changeIsActive(e, id) {
      try {
        let response = await this.$axios.$put(this.isactiveurl + id, {
          isActive: e.target.checked,
        });
        response.status
          ? this.$toast.success(response.message, this.$t("successfully"))
          : this.$toast.error(response.message, this.$t("unsuccessfully"));
      } catch (error) {
        console.log(error);
      }
    },
  },
  mounted() {
    this.serverParams.sort = this.sort;
    this.loadItems();
  },
};
</script>




