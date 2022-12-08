<template>
  <div>
    <div class="alert alert-info" v-if="menus.length <= 0">
      <h3 class="my-0">
        {{ $t("panel.menus.noMenusFound") }}
      </h3>
    </div>
    <button
      v-if="checked_menus.length > 0"
      @click="checkAll()"
      class="btn btn-blue mb-25"
    >
      <i class="fa fa-check-double"></i>
      {{ $t("selectAll") }}
    </button>
    <button
      v-if="checked_menus.length > 0"
      @click="checked_menus = []"
      class="btn btn-pumpkin mb-25"
    >
      <i class="fa fa-check"></i>
      {{ $t("unSelectAll") }}
    </button>
    <button
      v-if="checked_menus.length > 0"
      class="btn btn-danger mb-25"
      @click="deleteSelected()"
    >
      <i class="fa fa-trash"></i> {{ $t("deleteSelected") }}
    </button>
    <Draggable
      :flatData="menus"
      textKey="title"
      idKey="id"
      parentIdKey="top_id"
      @drop="changeRank"
      v-if="menus.length > 0"
      ref="draggableTree"
    >
      <template v-slot="{ node, tree }">
        <div
          class="
            mb-1
            bg-gold-light-5
            d-flex
            align-items-center align-self-center align-content-center
            p-2
          "
        >
          <b
            class="btn btn-cyan btn-sm"
            @click="tree.toggleFold(node)"
            v-if="node.$children.length > 0"
            v-html="
              node.$folded
                ? '<i class=\'fa fa-plus\'></i>'
                : '<i class=\'fa fa-minus\'></i>'
            "
          ></b>
          <input
            type="checkbox"
            :value="node"
            v-model="checked_menus"
            class="mx-15"
          />
          <small class="font-weight-bold"
            >#ID : {{ node.id }}</small
          >

          <span> - {{ node.title }}</span>
          <span class="custom-control custom-switch ml-15">
            <input
              :id="'customSwitch' + node.id"
              type="checkbox"
              class="my-check custom-control-input"
              :checked="node.isActive == 1 ? true : false"
              @input.prevent="changeIsActive($event, node.id)"
            />
            <label
              class="custom-control-label"
              :for="'customSwitch' + node.id"
            ></label>
          </span>
          <nuxt-link
            :to="'/panel/menus/update/' + node.id"
            class="btn btn-pink btn-sm ml-15"
          >
            <i class="fa fa-edit"></i>
          </nuxt-link>
        </div>
      </template>
    </Draggable>
  </div>
</template>

<script>
import { ValidationProvider, ValidationObserver } from "vee-validate";
import "@he-tree/vue2/dist/he-tree-vue2.css";
import { Draggable } from "@he-tree/vue2";
export default {
  components: {
    ValidationProvider,
    ValidationObserver,
    Draggable,
  },
  props: ["id", "rankurl", "deleteurl", "isactiveurl"],
  data() {
    return {
      menus: [],
      checked_menus: [],
    };
  },
  methods: {
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
    checkAll() {
      this.menus.forEach((el) => {
        if (!this.checked_menus.includes(el))
          this.checked_menus.push(el);
      });
    },
    // Rank Change
    async changeRank(data) {
      try {
        let id = data?.draggingNode?.id;
        let rank = data?.targetPath?.index == 0 ? 1 : data?.targetPath?.index;
        let topId = data?.targetPath?.parent?.id
          ? data?.targetPath?.parent?.id
          : 0;
        let response = await this.$axios.$put(this.rankurl + id, {
          rank: rank,
          top_id: topId,
        });
        response.status
          ? this.$toast.success(response.message, this.$t("successfully"))
          : this.$toast.error(response.message, this.$t("unsuccessfully"));
      } catch (error) {
        console.log(error);
      }
    },
    async getMenus() {
      try {
        let { data } = await this.$axios.get("v1/panel/menus/");
        if (data && data.menu) {
          this.menus = data.menu;
        }
      } catch (error) {
        console.log(error);
      }
    },
    async saveMenu() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/menus/update/" + this.id
          : "v1/panel/menus/save/";
        let { data } = await this.$axios.post(url, formData, {
          headers: {
            "Content-Type":
              "multipart/form-data; boundary=" + formData._boundary,
          },
        });
        data.status
          ? this.$toast.success(data.message, this.$t("successfully"))
          : this.$toast.error(data.message, this.$t("unsuccessfully"));
        setTimeout(() => {
          this.$router.replace("/panel/menus/");
        }, 1000);
      } catch (error) {
        console.log(error);
      }
    },
    async deleteSelected() {
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
            let chkdMenus = [];
            this.checked_menus.forEach((elem, index) => {
              chkdMenus.push(elem.id);
              this.$refs.draggableTree.removeNode(elem);
            });
            if (chkdMenus.length) {
              let { data } = await this.$axios.post(this.deleteurl, {
                id: chkdMenus.join(","),
              });
              data.status
                ? this.$toast.success(data.message, this.$t("successfully"))
                : this.$toast.error(data.message, this.$t("unsuccessfully"));
            }

            chkdMenus = [];
            this.checked_menus = [];
          } catch (error) {
            console.log(error);
          }
        }
      });
    },
  },
  mounted() {
    this.getMenus();
  },
};
</script>