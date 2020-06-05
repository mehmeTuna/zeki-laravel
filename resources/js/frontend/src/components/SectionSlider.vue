<template>
    <section>
        <div
            id="carouselExampleIndicators"
            class="carousel slide"
            data-ride="carousel"
        >
            <ol class="carousel-indicators">
                <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="0"
                    class="active"
                ></li>
                <li
                    data-target="#carouselExampleIndicators"
                    data-slide-to="1"
                ></li>
            </ol>
            <div class="carousel-inner">
                <router-link class="carousel-item active" to="/urunler" tag="a">
                    <img
                        class="d-block w-100"
                        src="assets/img/photos/Slider-3-min.png"
                        alt="Kampanya 3"
                    />
                </router-link>
                <router-link class="carousel-item " to="/urunler?7" tag="a">
                    <img
                        class="d-block w-100"
                        src="assets/img/photos/Slider-2-min.jpg"
                        alt="Kampanya 1"
                    />
                </router-link>

                <router-link class="carousel-item" to="/urunler?7" tag="a">
                    <img
                        class="d-block w-100"
                        src="assets/img/photos/Slider-1-min.jpg"
                        alt="Kampanya 2"
                    />
                </router-link>
                <!-- <div class="carousel-item ">
     <img class="d-block w-100 " src="assets/img/photos/kampanya3.jpg" alt="Kampanya 3">
        </div>-->
            </div>
            <a
                class="carousel-control-prev"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="prev"
            >
                <span class="sr-only">Previous</span>
            </a>
            <a
                class="carousel-control-next"
                href="#carouselExampleIndicators"
                role="button"
                data-slide="next"
            >
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
</template>

<script>
export default {};
</script>

<style>
.carousel-control-prev-icon,
.carousel-control-next-icon {
    visibility: visible !important;
    opacity: unset;
}

.carousel-control-next,
.carousel-control-prev {
    height: 30px;
    width: 50px;

    padding: 20px 40px;
    cursor: pointer;

    opacity: 1;

    top: 50%;

    border: none;
    outline: none;
    z-index: 2;
}

.carousel-item .title {
    font-size: 22px !important;
    margin-top: 10px !important;
    font-weight: 400;
}
@media only screen and (max-width: 350px) {
    .carousel-item img {
        max-height: 150px !important;
    }
}

@media only screen and (max-width: 450px) {
    .carousel-item img {
        max-height: 150px !important;
    }
}

@media only screen and (max-width: 720px) {
    .carousel-control-prev,
    .carousel-control-next {
        display: none !important;
    }
    .slider-container {
        width: 90% !important;

        margin: 10px auto !important;
    }

    .carousel-item .title {
        font-size: 19px !important;
    }
}

.carousel-control-prev:before {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 15px;
    content: "<";
    font-size: 30px;
    transform: translateX(-40px);
    box-shadow: 5px 5px 3px 0 rgba(0, 0, 0, 0.1);
    background-color: #ddae71;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    z-index: 99;
    opacity: unset;
}
.carousel-control-next:before {
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 15px;
    content: ">";
    font-size: 30px;
    transform: translateX(40px);
    box-shadow: -5px 5px 3px 0 rgba(0, 0, 0, 0.1);
    background-color: #ddae71;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    z-index: 99;
    opacity: unset;
}
.slide img {
    width: 100%;
}
</style>
