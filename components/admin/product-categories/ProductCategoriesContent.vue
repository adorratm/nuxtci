<template>
  <div>
    <Draggable
      :flatData="product_categories"
      textKey="title"
      idKey="id"
      parentIdKey="top_id"
      @drop="changeRank"
      :virtualization="false"
    >
      <template v-slot="{ node,tree }">
        <div class="mb-1">
          <b
            v-if="parent_categories.includes(node.id)"
            class="btn btn-pink btn-sm"
            @click="tree.toggleFold(node)"
            v-html="
              node.$folded
                ? '<i class=\'fa fa-plus\'></i>'
                : '<i class=\'fa fa-minus\'></i>'
            "
          ></b>
          <input
            type="checkbox"
            name="categories[]"
            v-model="checked_categories[node.id]"
          />
          <span
            >#{{ node.rank }} - <cite class="font-weight-bold">ID</cite> :
            {{ node.id }} -
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
  props: ["id", "rankurl"],
  data() {
    return {
      product_categories: [],
      parent_categories: [],
      checked_categories:[]
    };
  },
  methods: {
    log(node){
      console.log(node);
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

        this.parent_categories = [];
        this.product_categories = data.targetTree.outputFlatData();
        this.product_categories.forEach((item, index) => {
            if (
              item.top_id != 0 &&
              !this.parent_categories.includes(item.top_id)
            ) {
              this.parent_categories.push(item.top_id);
            }
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

          this.product_categories.forEach((item, index) => {
            if (
              item.top_id != 0 &&
              !this.parent_categories.includes(item.top_id)
            ) {
              this.parent_categories.push(item.top_id);
            }
          });
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
  },
  mounted() {
    this.getProductCategories();
  },
};
</script>