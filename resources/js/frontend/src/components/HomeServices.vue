<template>
    <div class="service-cards">
        <div class="service-cards--container">
            <div class="service-cards--grid">
                <div class="service-card"  v-for="(service,serviceInd) in services" :key="serviceInd">
                    <div class="service-card--content">
                        <div class="service-card--icon icon">
                            <i class="ti" :class="[`ti-${service.icon}`]"></i>
                        </div>
                        <div class="service-card--title">
                            {{service.title}}
                        </div>
                        <div class="service-card--desc">
                            {{service.desc}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return {
            services:[
                {
                    title:'Kalite',
                    icon:'star',
                    desc:'Kalite Hizmet ve Ustalık anlayışı ile çıktığımız bu yolda, kalite ve hizmet presibimizden ödün vermeden ilerliyoruz. Adana’da kaliteli hizmet ve farklı lezzetlerin adresi…'
                },
                {
                    title:'Hizmet',
                    icon:'tag',
                    desc:'Modern açık ve kapalı salonu, ferah manzarası, çocuk oyun bölümü, internet hizmeti ve otoparkı ile kusursuz hizmet anlayışının ön planda olduğu özel bir mekan…'
                },
                {
                    title:'Ustalık',
                    icon:'user',
                    desc:'Kebabımızı ustalığımızla etin sinirlerini temizlenip özel el kıyma yapılarak içine hem ustalığımızı ve sevgimizi katarak lezzetli bir şekilde pişirip, size ve sevdiklerinize sunuyoruz.'
                },
                {
                    title:'Kendi kesim etlerimiz',
                    icon:'reload',
                    desc:'Adana kebabını diğer kebaplardan ayıran en belirgin özellik kullanılan ettir. Et, doğal ortamda ve kendine has bir bölgede yetiştirilmiş erkek koyunlardan elde edilmiş olmalıdır.'
                }
            ]
        }
    }
}
</script>
<style>
.service-cards{
    padding-top: 30px;
    padding-bottom: 60px;
}
.service-cards--container {
    width:85%;
    margin:0 auto;
}
.service-cards--grid{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    grid-gap:25px;
}
 @media only screen and (max-width:768px) {
    .service-cards--grid {
        grid-template-columns: 1fr 1fr;
    }
}
 @media only screen and (max-width:550px) {
    .service-cards--grid {
        grid-template-columns: 1fr;
    }
}
.service-card{
    padding: 25px 15px;
    border-radius: 6px;
    background-color: white;
}
.service-card.bg-primary{
    color:#fff;
}
.bg-purple--light{
    background-color: #f0f0f7;
}
.service-card--icon{
    display:flex;
    align-items: center;
    justify-content: center;
    width:100%;
    /* height:100%; */
}
.service-card--title{
    font-size: 22px;
    font-weight: 500;
    margin: 20px 0;
    text-align: center;
}
.service-card--desc{
    text-align: center;
    font-size: 15px;
}

</style>