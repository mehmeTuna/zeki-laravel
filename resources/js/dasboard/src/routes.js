import Home from "./Views/Home.vue";
import Kurye from "./components/Kurye.vue";
import AddProduct from "./components/ÜrünEkle.vue";
import Rezervasyon from "./components/Rezervasyon.vue";
import Kullanici from "./components/KullanıcıEkle.vue";
import SatisTakip from "./components/SatisTakip.vue";
import KategoriEkle from "./components/KategoriEkle";
import KuryeTakip from "./components/KuryeTakip";
import UyeTakip from "./components/UyeTakip.vue";
export const routes = [
    {
        path: "*",
        component: Home
    },
    {
        path: "/admin",
        name: "Home",
        component: Home
    },
    {
        path: "/admin/kurye",
        name: "Kurye",
        component: Kurye
    },
    {
        path: "/admin/addproduct",
        name: "Ürün Ekle",
        component: AddProduct
    },
    {
        path: "/admin/addcategory",
        name: "Kategori Ekle",
        component: KategoriEkle
    },
    {
        path: "/admin/rezervasyon",
        name: "Rezervasyon",
        component: Rezervasyon
    },
    {
        path: "/admin/adduser",
        name: "Kullanici Ekle",
        component: Kullanici
    },
    {
        path: "/admin/satistakip",
        name: "Satis Takip ",
        component: SatisTakip
    },
    {
        path: "/admin/kuryetakip",
        name: "Kurye Takip ",
        component: KuryeTakip
    },
    {
        path: "/admin/uyetakip",
        name: "Uye Takip ",
        component: UyeTakip
    }
];
