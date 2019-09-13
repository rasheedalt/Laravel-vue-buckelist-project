<template>
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <router-link :to="{ name: 'home' } " class="navbar-brand">Bucketlist</router-link>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav ml-md-auto">                 
                    <li v-if="$auth.check()" class="nav-item">
                        <router-link :to="{ name: 'dashboard' }" class="nav-link">Dashboard</router-link>
                    </li>
                    <li v-if="$auth.check()" class="nav-item">
                        <a href="#" @click.prevent="$auth.logout()" class="nav-link ">Logout</a>
                    </li>
                </ul>
  </div>
</nav>
<div class="container">
            <router-view></router-view>
  </div>

</div>
</template>
<script>

export default {
    
}
</script>