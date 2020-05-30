<template>
    <div class="our-services">
        <div class="our-services--container">
            <div class="our-services--title">
                Neler Yapıyoruz ? 
            </div>
            <div class="our-services--container-grid">
                <div class="service-card"   v-for="(service,serviceInd) in services" :key="serviceInd">
                    <div class="service-card--icon icon ">
                        <i class="ti" :class="[`ti-${service.icon}`]"></i>
                    </div>
                    <div class="service-card--title text-primary">
                        {{service.title}}
                    </div>
                    <div class="service-card--desc">
                        {{service.desc}}
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
                    title:'Düğün, Nişan ve Sünnet Organizasyonları',
                    icon:'bolt',
                    desc:'Kaliteli ekipmanlarımız, güleryüzlü, eğitimli, disiplinli personelimizle Zeki Usta Kebap olarak profesyonel ve amaca yönelik çözüm odaklı hizmet anlayışımızla mükemmele ulaşmak ve düğün nişan ve sünnet yemeklerinizi unutulmaz kılmak hedefimizdir.'
                },
                {
                    title:'İş ve Toplantı Yemekleri',
                    icon:'briefcase',
                    desc:`2008 Yılından bu yana Adanalıların damak zevkine hitap eden Zeki Usta Kabap, tecrübesi ve deneyimli kadrosuyla sektörde önemli bir yere sahiptir. Sahip olduğu bu deneyimi, iş yemekleri, vip toplantılar ve özel organizasyonlar ile de sizlere en iyi şekilde sunmaktadır. `
                },
                {
                    title:'Yerinde Yemek Hizmeti',
                    desc:`Misafirlerimize verdiğimiz önem, bizi daima dikkatli ve titiz çalışmalar yapmaya yöneltmiştir. İnsan sağlığına verdiğimiz öncelik, ürünlerimizin hazırlanış aşamasından, taşıma ve sunuş aşamasına kadar hijyeni hep ön planda tutmamızı sağlamaktadır.`
                    ,icon:'location-pin'
                },
                {
                    title:'Özel Günlerinizde Yemek Hizmeti',
                    desc:`Türkmenbaşı bulvarı’nın en şık mevkiindeki özel günlerinize dışarda veya üst kat salonda otantik bir hava katabilirsiniz. Zeki Usta Kebap olarak misafirlerimize verdiğimiz önem, bizi daima dikkatli ve titiz çalışmalar yapmaya yöneltmiştir.`
                    ,icon:'comments-smiley'
                },
                {
                    title:'Paket siparişi',
                    desc:`Zeki Usta Kebap için %100 Müşteri memnuniyeti çok önemli. Sizlere konusunda uzman paket servis personellerimiz ile yemeklerinizi  hızlı bir şekilde ulaştırıyoruz.`,
                    icon:'car'
                }
            ]
        }
    }
}
</script>

<style>
.our-services{
    margin:20px 0;
}
.our-services--container{
    width:75%;
    margin:0 auto;
}
.our-services--container-grid{
    display:grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 25px;
}
@media only screen and (max-width:550px) {
    .our-services--container-grid {
        grid-template-columns: 1fr;
    }
}
.our-services--title{
    font-size: 27px;
    font-weight: 600;
    margin-bottom: 20px;
    
}
/* .our-services .service-card{
    margin: 12px 0;
} */
</style>