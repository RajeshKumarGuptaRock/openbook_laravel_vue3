<template>

  <div id="wrapper">
    <div class="overlay"></div>
    <!-- Navigation -->
    <Navigation @open-side-menu="isSideMenuOpen = !isSideMenuOpen" />
    <!-- /#Navigation-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="container">
        <div class="row">
          <div class="border col-lg-2 col-lg-offset-2" style="margin: auto; background: #fff">
          <!-- Sidebar Here -->
          </div>
          <div class="col-lg-10 col-lg-offset-2" style="margin: auto; background: #fff">
            <RouterView />
          </div>
        </div>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
  <!-- /#wrapper -->
</template>
<script setup>
import { ref } from "vue";
import { RouterView } from "vue-router";
import Navigation from "../components/Navigation.vue";
import Sidebar from "../components/Sidebar.vue";
const isSideMenuOpen = ref(false);
</script>