<template>
    <div class="card col-md-6 container mt-5">
        <div class="card-body text-center btn-block"><h4 >Login</h4></div> 
        <div class="alert alert-danger" v-if="error">
            <p>There was an error, unable to sign in with those credentials.</p>
        </div>
        <form autocomplete="off" @submit.prevent="login" method="post" class="card-body">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" v-model="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        <div>
          <router-link :to="{ name: 'register' }" class="nav-link mb-3">Register</router-link>
        </div>
    </div>
</template>

<script>
  export default {
    data(){
      return {
        email: null,
        password: null,
        error: false
      }
    },
    methods: {
     login(){
        var app = this
        this.$auth.login({
            params: {
              email: app.email,
              password: app.password
            }, 
            success: function () { console.log('yes')},
            error: function () { this.error = true},
            rememberMe: true,
            redirect: '/dashboard',
            fetchUser: true,
        });       
    }
    }
  }
</script>