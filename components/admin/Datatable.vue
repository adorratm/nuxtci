<template>
  <div>
    <form id="filter_form" onsubmit="return false">
      <div class="d-flex flex-wrap">
        <label for="search" class="flex-fill mx-1">
          <input
            class="form-control form-control-sm rounded-0"
            placeholder="Arama Yapmak İçin Metin Girin."
            type="text"
            @keypress="runScript('settingsTable')"
            name="search"
          />
        </label>
        <label for="clear_button" class="mx-1">
          <button
            class="btn btn-sm btn-outline-danger rounded-0"
            @click="clearFilter('filter_form', 'settingsTable')"
            id="clear_button"
            data-toggle="tooltip"
            data-placement="top"
            data-title="Filtreyi Temizle"
          >
            <i class="fa fa-eraser"></i>
          </button>
        </label>
        <label for="search_button" class="mx-1">
          <button
            class="btn btn-sm btn-outline-success rounded-0"
            @click="reloadTable('settingsTable')"
            id="search_button"
            data-toggle="tooltip"
            data-placement="top"
            data-title="Tabloda Ara"
          >
            <i class="fa fa-search"></i>
          </button>
        </label>
      </div>
    </form>
    <table class="myDataTable table table-hover table-striped table-bordered">
      <thead v-if="columns">
        <th
          class="text-center"
          v-bind:key="index"
          v-for="(value, index) in columns"
          v-html="value"
        ></th>
      </thead>
      <tbody></tbody>
    </table>
  </div>
</template>

<script>
export default {
  head: {
    link: [
      {
        rel: "stylesheet",
        type: "text/css",
        href: "https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.css",
      },
    ],
    script: [
      {
        src: "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js",
        body: true,
      },
      {
        src: "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js",
        body: true,
      },
      {
        src: "https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js",
        body: true,
      },
    ],
  },
  props: ["columns", "dataurl", "rankurl", "token"],
  methods: {
    /** TableInitializerV2 */
    obj(d) {
      $.each($("#filter_form").serializeArray(), function () {
        d[this.name] = this.value;
      });
      console.log("d:",d);

      return d;
    },
    TableInitializerV2(
      gelentablo,
      gelendata,
      gelenurl,
      rankUrl,
      token,
      filterSearch = false,
      aocolumndefs = [
        {
          sClass: "text-center justify-content-center align-middle",
          aTargets: "_all",
        },
        {
          type: "turkish",
          targets: "_all",
        },
        {
          targets: ["nosort"],
          orderable: false,
        },
      ]
    ) {
      $("table." + gelentablo).on("draw.dt", function () {
        $("table." + gelentablo)
          .DataTable()
          .columns.adjust();
        $("table." + gelentablo)
          .DataTable()
          .responsive.recalc();
      });
      $("table." + gelentablo).DataTable({
        destroy: true,
        rowReorder: {
          selector: "td:nth-child(2)",
        },
        renderer: "bootstrap",
        deferRender: true,
        stateSave: true,
        bstateSave: true,
        responsive: true,
        dom:
          filterSearch === false
            ? "<'d-flex align-content-center flex-wrap justify-content-between' <'justify-content-start' l><'justify-content-center'r><'justify-content-end'f>>t<'d-flex flex-wrap justify-content-between' <'justify-content-start'i> <'justify-content-end'p>>"
            : "<'d-flex align-content-center justify-content-between' <'justify-content-start'><'justify-content-center text-center flex-grow-1'r><'justify-content-end'>>t<'d-flex flex-wrap align-content-center justify-content-between' <'justify-content-start text-center' <'pt-2'l>><'justify-content-end text-center'p>><i>",
        language: {
          sDecimal: ",",
          sEmptyTable: "Tabloda herhangi bir veri mevcut değil",
          sInfo:
            "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
          sInfoEmpty: "Kayıt yok",
          sInfoFiltered: "(_MAX_ kayıt içerisinden bulunan)",
          sInfoPostFix: "",
          sInfoThousands: ".",
          sLengthMenu: "Sayfada _MENU_ kayıt göster",
          sLoadingRecords: "Yükleniyor...",
          sProcessing: "İşleniyor...",
          sSearch: "Ara:",
          sZeroRecords: "Eşleşen kayıt bulunamadı",
          oPaginate: {
            sFirst: "İlk",
            sLast: "Son",
            sNext: "Sonraki",
            sPrevious: "Önceki",
          },
          oAria: {
            sSortAscending: ": artan sütun sıralamasını aktifleştir",
            sSortDescending: ": azalan sütun sıralamasını aktifleştir",
          },
          select: {
            rows: {
              0: "",
              1: "1 kayıt seçildi",
              _: "%d kayıt seçildi",
            },
          },
        },
        order: [],
        aaSorting: [],
        bSort: true,
        aoColumnDefs: aocolumndefs,
        columnDefs: [
          {
            sClass: "text-center justify-content-center align-middle",
            aTargets: "_all",
          },
          {
            type: "turkish",
            targets: "_all",
          },
          {
            targets: ["nosort"],
            orderable: false,
          },
        ],
        search: {
          caseInsensitive: false,
        },
        processing: true,
        serverSide: true,
        serverMethod: "post",
        pageLength: 25,
        iDisplayLength: 25,
        lengthMenu: [
          [25, 50, 100, 250],
          [25, 50, 100, 250],
        ],
        ajax: {
          url: gelenurl,
          data: gelendata,
          beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", token);
          },
        },
        //'columns': gelencolumn,
        rowCallback: function (row, data) {
          if (data.satirrengi !== "" && data.satirrengi !== null) {
            $(row).addClass(data.satirrengi);
          }
          if (
            data.sutunrengi !== "" &&
            data.sutunrengi !== null &&
            data.sutunindex !== "" &&
            data.sutunindex !== null
          ) {
            $.each(data.sutunrengi, function (key, value) {
              $(row)
                .find("td:eq(" + data.sutunindex + ")")
                .css("background-color", value);
            });
          }
        },
      });
      $("table." + gelentablo).on("responsive-display", function () {
        $("table." + gelentablo)
          .DataTable()
          .columns.adjust();
        $("table." + gelentablo)
          .DataTable()
          .responsive.recalc();
      });
      $("table." + gelentablo).on("responsive-resize", function () {
        $("table." + gelentablo)
          .DataTable()
          .columns.adjust();
        $("table." + gelentablo)
          .DataTable()
          .responsive.recalc();
      });
      $("table." + gelentablo)
        .DataTable()
        .on("row-reorder", function (e, details) {
          e.preventDefault();
          e.stopImmediatePropagation();
          if (details.length) {
            let rows = [];
            details.forEach((element) => {
              let elm = $("table." + gelentablo)
                .DataTable()
                .row(element.node)
                .data();
              rows.push({
                id: $(elm[1]).data("id"),
                position: element.newData,
              });
            });
            $.ajax({
              method: "POST",
              url: rankUrl,
              data: {
                rows,
              },
              beforeSend: function (xhr) {
                xhr.setRequestHeader("Authorization", "Bearer " + token);
              },
            }).done(function () {
              $("table." + gelentablo)
                .DataTable()
                .ajax.reload();
            });
          }
        });
    },

    reloadTable(table) {
      $("." + table)
        .DataTable()
        .ajax.reload(null, false);
    },

    clearFilter(form, table) {
      $("#" + form)[0].reset();
      this.reloadTable(table);
    },

    runScript(table) {
      //See notes about 'which' and 'key'
      this.reloadTable(table);
      return false;
    },
    /** TableInitializerV2 */
  },
  mounted() {
    setTimeout(() => {
      this.TableInitializerV2(
        "myDataTable",
        this.obj,
        this.dataurl,
        this.rankurl,
        this.token,
        true
      );
    }, 1000);
  },
};
</script>