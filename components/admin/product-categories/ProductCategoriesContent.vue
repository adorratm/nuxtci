<template>
  <div>
    <Draggable
      :flatData="product_categories"
      textKey="title"
      idKey="id"
      parentIdKey="top_id"
      @drop="changeRank"
      v-if="product_categories.length > 0"
    >
      <template v-slot="{ node, tree }">
        <div class="mb-1 bg-gold-light-5 p-2">
          <b
            class="btn btn-pink btn-sm"
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
            :value="node.id"
            v-model="checked_categories"
          />
          <span
            >#<cite class="font-weight-bold">ID</cite> : {{ node.id }} -
            <cite class="font-weight-bold">{{ node.title }}</cite></span
          >
          <nuxt-link
            :to="'/panel/product-categories/update/' + node.id"
            class="btn btn-pink btn-sm"
          >
            <i class="fa fa-edit"></i>
          </nuxt-link>
        </div>
      </template>
    </Draggable>
    <div class="alert alert-info" v-if="product_categories.length <= 0">
      <h3 class="my-0">
        {{ $t("panel.productCategories.noProductCategoriesFound") }}
      </h3>
    </div>
    <button
      v-if="checked_categories.length > 0"
      @click="checkAll()"
      class="btn btn-blue mt-50"
    >
      <i class="fa fa-check-double"></i>
      {{ $t("selectAll") }}
    </button>
    <button
      v-if="checked_categories.length > 0"
      @click="checked_categories = []"
      class="btn btn-pumpkin mt-50"
    >
      <i class="fa fa-check"></i>
      {{ $t("unSelectAll") }}
    </button>
    <button
      v-if="checked_categories.length > 0"
      class="btn btn-danger mt-50"
      @click="deleteSelected()"
    >
      <i class="fa fa-trash"></i> {{ $t("deleteSelected") }}
    </button>
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
  props: ["id", "rankurl", "deleteurl"],
  data() {
    return {
      product_categories: [],
      checked_categories: [],
    };
  },
  methods: {
    checkAll() {
      this.product_categories.forEach((el) => {
        if (!this.checked_categories.includes(el.id))
          this.checked_categories.push(el.id);
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
    async getProductCategories() {
      try {
        let { data } = await this.$axios.get("v1/panel/productcategories/");
        if (data && data.productCategory) {
          this.product_categories = data.productCategory;
        }
      } catch (error) {
        console.log(error);
      }
    },
    async saveProductCategory() {
      try {
        const formData = this.getFormData(this.formData);
        let url = this.id
          ? "v1/panel/productcategories/update/" + this.id
          : "v1/panel/productcategories/save/";
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
          this.$router.replace("/panel/product-categories/");
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
            let { data } = await this.$axios.delete(
              this.deleteurl + this.checked_categories.join(",")
            );
            data.status
              ? this.$toast.success(data.message, this.$t("successfully"))
              : this.$toast.error(data.message, this.$t("unsuccessfully"));
            this.checked_categories.forEach((elem, index) => {
              let indexOfObject = this.product_categories.findIndex(
                (object) => {
                  return object.id === index;
                }
              );
              this.product_categories.splice(indexOfObject, 1);
            });
            this.checked_categories = [];
          } catch (error) {
            console.log(error);
          }
        }
      });
    },
  },
  mounted() {
    this.getProductCategories();
  },
};
</script>