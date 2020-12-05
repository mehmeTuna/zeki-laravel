<template>
    <nav
        class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
    >
        <!-- Sidebar Toggle (Topbar) -->
        <button
            id="sidebarToggleTop"
            class="btn btn-link d-md-none rounded-circle mr-3"
        >
            <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <a href="rapor/zrapor" target="_blank">
            <button type="button" class="btn btn-success">
                Gunluk Z-raporu
            </button>
        </a>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="searchDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div
                    class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown"
                >
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control bg-light border-0 small"
                                placeholder="Ara"
                                aria-label="Search"
                                aria-describedby="basic-addon2"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item dropdown no-arrow d-flex align-items-center">
                <h4>Sube: {{ workerData.store.name }}</h4>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    id="userDropdown"
                    role="button"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <span class="mr-2 d-none d-lg-inline  small"></span>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
                </a>
                <!-- Dropdown - User Information -->
                <div
                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown"
                >
                    <a class="dropdown-item" href="/calisan/cikis-yap">
                        <i
                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                        ></i>
                        Çıkış Yap
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: "Topbar",
    props: {
        workerData: {
            required: true
        }
    },
    mounted() {}
};
</script>

<style scoped></style>
