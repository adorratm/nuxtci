<template>
  <ul class="nav nav-pills nav-fill border" id="myTab" role="tablist">
    <li
      class="nav-item"
      role="presentation"
      v-for="(item, key) in tabs"
      :key="key"
    >
      <button
        :class="'nav-link w-100 rounded-0 ' + (key == 0 ? 'active' : '')"
        :id="'tab-' + key"
        data-toggle="tab"
        :data-target="'#tab-tab-' + key"
        type="button"
        role="tab"
        :aria-controls="'tab-tab-' + key"
        aria-selected="true"
      >
        {{ item }}
      </button>
    </li>
  </ul>
</template>
<script>
export default {
  props: ["tabs"],
};
</script>
