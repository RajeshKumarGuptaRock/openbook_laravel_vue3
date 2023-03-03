<template>
      <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <router-link class="text-white ml-2" :to="{name :'Home' }">Home</router-link>
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="text-white ml-2" to="/login">Login</router-link>
          </li>
          <li class="nav-item">
            <router-link class="text-white ml-2" to="/register">Register</router-link>
          </li>
        </ul>        
      </nav>
      <router-view></router-view>
</template>