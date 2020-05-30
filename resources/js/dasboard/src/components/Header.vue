<template>
  <div>
        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <h3 class="navbar-brand " href="javascript:void(0)">Ay-SOFT Software </h3>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              
           
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/aa/aab235cb15ac75b5ad3479623cb9c263c2c78ec9.jpg" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                     <a href="admin/Logout" ></a>
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                 
                  <li class="dropdown-divider"></li>
                  <li class="nav-link">
                    <a href="admin/Logout" class="nav-item dropdown-item">Çıkış Yap</a>
                  </li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
  </div>
</template>

<script>
export default {

}
</script>

<style>

</style>
