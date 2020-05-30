<template>
    <div>
           <!-- Page Title -->
        <div class="page-title">
            <div style="text-align:center;">
                <h1 class="mb-0">Hakkımızda</h1>
                <h4 class="text-muted mb-0">Restorantımız hakkında bazı bilgiler</h4>
            </div>
        </div>

        <!-- Section -->
        <section class="section section-bg-edge">
            <div class="aboutus-section--container">
                <div class="aboutus-section--left">
                    <div class="" style="position:relative">
                        <div class="image left bottom" style="width:75%;z-index:-1">
                            <div class="bg-image"><img src="assets/img/photos/bg-chef.jpg" alt=""></div>
                        </div>
                        <div style="width:65%;margin-left:auto;">
                            <div class="rate mb-5 rate-lg"><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i><i class="fa fa-star active"></i></div>
                            <h2>Adana'nın Gözde Mekanı</h2>
                         
                            <p class="lead"> 2008 yılından bu yana Adanalıya ve diğer illerden Adana Kebap Lezzetini tatmaya gelen lezzet düşkünlerine hizmet veren Zeki Usta Kebap, salatasından ayranına, kuzu etinden kıymasına kadar her ürününü taze ve doğal ortamdan temin etmektedir.

İlk yerini 2008 yılında Kenan Evren Bulvarında açan Zeki Usta Kebap, kısa sürede bir marka olmuştur. Adanalıların tercih ettiği bir lezzet mekanı olmanın verdiği yoğunluğa cevap verebilmek için,

İkinci Şubesini Türkmenbaşı Bulvarında yeni yerini açarak hizmete başlamıştır.
</p>
<p class="lead">
    Zeki Usta Kebap Birbirinden farklı lezzetleri sunabilmek için alanında deneyimli ustalar ve güleryüzlü personelle, hizmet kalitesini en üst düzeye çıkararak sizlerin memnuniyetini en üst seviyede tutmak, firmamızın en büyük hedefidir

Zeki Usta Kebap firmasının diğer kebapçılardan ayıran özelliklerinden biri de; kebaplarında sadece erkek kuzu eti kullanması, salatanın önceden yapılıp beklemiş salata değil de, müşteri siparişini verdiği anda yapılan taze salata olmasıdır.

Kebap çeşitlerinin dışında, Ali Nazik, Kazbaşı ve Pirzola çeşitlerini de müşterilerine sunmaktadır. 750 kişilik 2 katlı yeni yerin de modern dekoru ile hizmet veren firmamız, sabah 09:00 – gece 01:00 saatleri arasında hizmet vermektedir.
</p>

<p class="lead">
Yılın 363 Günü Açığız      

Zeki Usta Kebap markası, çocukluktan günümüze dek kebapçılık yapan Zekeriye Öztaş, Abdullah Öztaş ve M. Emin Bilecek Ustaların birlikteliği ile meydana gelmiştir. 1 yıl içerisinde sadece kurban bayramının 1. ve 2 günü kapalı olan mekan yılın 363 günü siz değerli misafirlerini ağırlamaktan memnuniyet duymaktadır.

Zeki Usta Kebap olarak kaliteden ödün vermeyi aklımıza dahi getirmemiş olmamız, “kalite” kelimesinin bizler için içi boş bir tabir olmaktan çok, temel prensibimiz olduğunu kanıtladığımızı söylemek isteriz.

“Zamanda kalite”, “gıdada kalite”, “personelde kalite”, “hijyende kalite” ve “mekanda kalite” kavramlarına ayrı ayrı değer verdiğimizi belirtmek ve hizmet kalitesine ulaşırken bu kavramların tamamını gerçekleştirmek için azami gayret sarfettiğimizi bilmenizi isteriz.

Sağlıklı ve helal gıda maddelerini, birbirinden meziyetli personelimizin usta ellerinden geçirdikten sonra sizlerin beğenisine sunmak, bizler için büyük bir heyecan ve büyük bir haz ortaya çıkarmakta.

Zeki Usta Kebap olarak sizlere hizmet etmekten büyük onur duyacağımızı belirtmekle birlikte, sizleri eşşiz lezzetlerimizi tatmaya ve Zeki Usta Kebap kalitesiyle tanışmaya bekliyoruz.!</p>
                            <h6>Zeki Öztaş, Şef</h6>
                            <img src="assets/img/svg/sign.svg" alt="" class="mb-5">
                        </div>
                    </div>
                </div>
                <div class="aboutus-section--right">
                    <div class="aboutus-employees">
                        <div id="employee-rectange--1">
                            <h4>Zeki Öztaş</h4>
                        </div>
                        <div id="employee-rectange--2" >
                            <h4>Abdullah Öztaş</h4>
                        </div>
                        <div id="employee-rectange--3" class="mt-2">
                         <h4> Mehmet Emin Bilecek</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<style>
    .aboutus-section--container {
        display: flex;
        align-items: center;
        margin:20px 0;
    }
    .aboutus-section--left{
        width:60%;
        /* padding-right: 30px; */
    }
    .aboutus-section--right{
        width:40%;
    }
    @media only screen and (max-width:750px) {
        .aboutus-section--container{
            flex-direction: column;
        }
        .aboutus-section--left, .aboutus-section--right{
            width:100%;
        }
    }
    .aboutus-employees{
        display: flex;
        flex-direction: column;
        position: relative;
        width:75%;
        margin:0 auto;
    }
    .aboutus-employees--rectange{
        width:180px;
        height:180px;
        border:4px solid #ddae71;
    }
    .aboutus-employees--rectange img{
        width:100%;
        height: 100%;
    }    
    #employee-rectange--1{
        /* align-self:center; */
    }
    #employee-rectange--2{
        align-self: center;
        z-index: 10;
        transform: scale(1.2);
        background-color: #fff;
    }
    #employee-rectange--3{
        /* align-self: center; */
    }
</style>